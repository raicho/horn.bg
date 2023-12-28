<?php

namespace User\Models;

use Illuminate\Database\Eloquent\Model;

class UserVerificationModel extends  Model
{
    public $timestamps = false;
    protected $table = 'user_verification';
}
