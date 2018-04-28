<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class User extends Authenticatable
{

    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'created_at',
        'updated_at',
        'lastlogin_at',
        'iplastlogin',
        'img',
        'whoarewe',
        'password'
    ];
    protected $table = 'users';
    protected $hidden = [
        'password', 'remember_token',
    ];

    static private $lastlogin_at;
    static private $iplastlogin;

    public function __construct()
    {
        $this->setUpdatedAt(date('Y-m-d H:i:s'));
        $this->setCreatedAt(date('Y-m-d H:i:s'));
        $this->setLastLoginAt(date('Y-m-d H:i:s'));
        $this->setIpLastLogin($_SERVER["REMOTE_ADDR"]);
    }

    public function validation(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'confirm_password' => 'required|same:password'
        ]);
    }
    
    public static function getName(){
        return Auth::user()->name;
    }
    public static function getEmail(){
        return Auth::user()->email;
    }

    static function getIpLastLogin()
    {
        return self::$iplastlogin;
    }

    static function setIpLastLogin($p)
    {
        self::$iplastlogin = $p;
    }

    static function getLastLoginAt()
    {
        return self::$lastlogin_at;
    }

    static function setLastLoginAt($p)
    {
        self::$lastlogin_at = $p;
    }

    public static function saveLastLogin()
    {

        User::first()
            ->update([
                'lastlogin_at' => User::getLastLoginAt(),
                'iplastlogin' => User::getIpLastLogin(),
            ]);
    }

}
