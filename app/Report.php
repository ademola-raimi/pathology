<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Report extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'patient_id', 'description', 'statement'
    ];

    /**
     * A report belongs to one user.
     *
     * @return Object
     */
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    /**
     * A report belongs to one user.
     *
     * @return Object
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
