<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'avatar', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the avatar from gravatar.
     *
     * @return string
     */
    private function getAvatarFromGravatar()
    {
        return 'http://www.gravatar.com/avatar/'.md5(strtolower(trim($this->email))).'?d=mm&s=500';
    }

    /**
     * Get avatar from the model.
     *
     * @return string
     */
    public function getAvatar()
    {
        if (!is_null($this->avatar)) { 
            return $this->avatar;
        } else {
            return $this->getAvatarFromGravatar();
        }
    }

    /**
     * Update user avatar
     *
     * return void
     */
    public function updateAvatar($url)
    {
        $this->avatar = $url;
        $this->save();
    }

    /**
     * Report belongs to one patient.
     *
     * @return Object
     */
    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    /**
     * Report belongs to one patient.
     *
     * @return Object
     */
    public function patients()
    {
        return $this->hasMany('App\Patient');
    }
}
