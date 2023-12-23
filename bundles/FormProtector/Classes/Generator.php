<?php

namespace FormProtector\Classes;

class Generator
{
    /**
     * @param $length
     * @return string
     */
    public static function generateRandomString($length, $onlyLowSymbols = false): string
    {

        if($onlyLowSymbols == true) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        } else {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
