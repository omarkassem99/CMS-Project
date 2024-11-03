<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestContact extends Model
{
    use HasFactory;

    protected $table = "request_contact_us";
    protected $fillable = ['full_name','company','email','country_code','phone','country','project_budget','service','details'];
}