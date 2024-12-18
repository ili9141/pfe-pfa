<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students'; // Optional if the table name matches the plural form of the model

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password_hash',
        'date_of_birth',
        'phone_number',
        'profile_picture_url',
        'cin',
        'student_id',
        'department',
        'year',
        'major',
        'assigned_professor_id',
        'internship_status',
        'company_name',
        'start_date',
        'end_date',
        'resume_url',
        'portfolio_url',
    ];

    // Accessor for password generation
    public static function generateStudentPass($length = 12)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
        return substr(str_shuffle($characters), 0, $length);
    }
}
