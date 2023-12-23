<?php

namespace FormProtector\Models;
use Illuminate\Database\Eloquent\Model;

class FormProtectorModel extends Model
{
    protected $table = 'form_protector';
    /**
     * @var string $code
     * @var string $hash
     */

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setCode($code): self
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }


    /**
     * @param $hash
     * @return $this
     */
    public function setHash($hash): self
    {
        $this->hash = $hash;
        return $this;
    }


}
