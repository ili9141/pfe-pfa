<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'phone_number',
        'date_of_birth',
        'cin',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date',
    ];

    /**
     * Get the associated admin profile for the user.
     */
    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class);
    }

    /**
     * Get the associated professor profile for the user.
     */
    public function professor(): HasOne
    {
        return $this->hasOne(Professor::class);
    }

    /**
     * Get the associated student profile for the user.
     */
    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    /**
     * Set the user's password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
