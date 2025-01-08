<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $table = 'professors';

    protected $fillable = [
        'lastname',
        'firstname',
        'phone_number',
        'date_of_birth',
        'cin',
        'email',
        'profile_picture_url',
        'password',
        'speciality',
        'major_id',  // Assuming you have 'major_id' as the foreign key
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
