<?php

namespace App\Models;

use App\Traits\MustVerifyPhone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Interfaces\MustVerifyPhone as IMustVerifyPhone;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements IMustVerifyPhone
{
    use HasApiTokens, HasFactory, Notifiable;
    use MustVerifyPhone;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guard_name = 'web';

    protected $table = 'users';

    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'phone_verified_at',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
