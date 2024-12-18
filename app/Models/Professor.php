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
        'password_hash',
        'major',
        'speciality',
    ];
}
