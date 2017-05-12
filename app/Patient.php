<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Patient extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id', 'date_of_birth', 'email', 'phone_number', 'case_number', 'patient_id'
    ];

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
     * A patient belongs to one user.
     *
     * @return Object
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
