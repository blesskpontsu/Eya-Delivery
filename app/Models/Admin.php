<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $guard_name = 'admin';
    protected $table = 'admins';

    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email',
        'password'
    ];
}
