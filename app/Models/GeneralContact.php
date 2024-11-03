<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralContact extends Model
{
    use HasFactory;

    protected $table = "general_contact_us";
    protected $fillable = ['full_name','email','subject','details'];
}

