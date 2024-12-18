<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $table = 'majors';

    // Fillable properties for mass assignment
    protected $fillable = ['majorName'];

    // Disable timestamps if not used
    public $timestamps = false;
}
