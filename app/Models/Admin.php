<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Admin extends User
{
    use Notifiable;
    protected $guard = 'admin';
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $fillable = [
        'username',
    ];
    protected $hidden = [
        'password', 'remember_token'
    ];

    const STATUS_NORMAL = 0;
    const STATUS_FORBIDDEN = -1;
}
