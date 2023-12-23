<?php

namespace FormProtector\Classes;

use App\Http\Controllers\Controller;
use FormProtector\Models\FormProtectorModel;
use Illuminate\Http\JsonResponse;

class FormProtector extends Controller
{
    /**
     * @param $hash
     * @param $code
     * @return JsonResponse
     */
    public function isValidCode($hash, $code): \Illuminate\Http\JsonResponse
    {
        $code = strtolower($code);
        $result = FormProtectorModel::where(['hash' => $hash, 'code' => $code])->first();
        $jsonResult = [];
        if($result) {
            $jsonResult['isValid'] = true;
            // auto delete row  //
            if(config('protector.autoDeleteAfterChecking')) {
                $result->delete();
            }
        } else {
            $jsonResult['isValid'] = false;
        }
        return response()->json($jsonResult);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     * @throws \Random\RandomException
     */
    public function generateFormFields(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $formProtectorModel = new FormProtectorModel();
        $code = Generator::generateRandomString(config('protector.randomStringLength'), true);
        $randomBytes = random_bytes(config('protector.randomBytes'));
        $data['image'] = $this->generateImage($code);
        $data['hash'] = bin2hex($randomBytes);
        $formProtectorModel
            ->setCode($code)
            ->setHash($data['hash']);
        $formProtectorModel->save();
        return view('protector::form', $data);
    }

    private function generateImage(string $text)
    {
        $fonts = [
            'beauty.ttf',
            'brenza.ttf'
        ];
        $fontNumber = rand(0, count($fonts) -1);
        $width = 500;
        $height = 200;
        $im = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($im, 255, 255, 255);
        $textColor = imagecolorallocate($im, rand(0, 100), rand(0, 100), rand(0, 100));
        imagefilledrectangle($im, 0, 0, $width, $height, $white);
        $font =  FORM_PROTECTOR_BASE_PATH.'/Resources/fonts/'.$fonts[$fontNumber];
        $fontsize = 60;
        $angle = mt_rand(-20, 20);
        $posX = 150;
        $posY = 100;

        imagettftext($im, $fontsize, $angle, $posX, $posY, $textColor, $font, $text);
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                if (mt_rand(0, 2) == 2) {
                    imagesetpixel($im, $x, $y, imagecolorallocate($im, 0, 0, 0));
                }
            }
        }

        $textColor = imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255));
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                if (mt_rand(0, 20) == 7) {
                    imagesetpixel($im, $x, $y, $white);
                }
            }
        }

        for ($i = 0; $i < 10; $i++) {
            $lineColor = imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255));
            imageline($im, 0, rand() % $height, $width, rand() % $height, $lineColor);
        }

        for ($i = 0; $i < 10; $i++) {
            imagesetpixel($im, rand() % $width, rand() % $height, $textColor);
        }
        return $im;
    }
}
