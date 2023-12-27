<?php

namespace User\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetModel extends  Model
{
    protected $table = 'password_resets';
    public $timestamps = false;
}
