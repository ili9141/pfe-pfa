<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';

    // Specify the fillable properties for mass assignment
    protected $fillable = [
        'lastname',
        'firstname',
        'phone_number',
        'date_of_birth',
        'cin',
        'email',
        'profile_picture_url',
        'password_hash',
    ];

    // Hide sensitive attributes from serialization
    protected $hidden = [
        'password_hash',
    ];

    // Define casts for attributes
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Generate a random admin password
    public static function generateAdminPass($length = 12)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
        $characters = str_shuffle($characters);
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $password;
    }
}
