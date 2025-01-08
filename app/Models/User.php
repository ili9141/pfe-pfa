<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'phone_number',
        'date_of_birth',
        'cin',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date',
    ];

    // Relationship to the Admin model
    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class);
    }

    // Relationship to the Professor model
    public function professor(): HasOne
    {
        return $this->hasOne(Professor::class);
    }

    // Relationship to the Student model
    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    // Encrypt the password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
