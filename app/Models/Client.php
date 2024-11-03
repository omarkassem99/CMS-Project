<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name','email',"country_code",'phone','image','date_of_purchase','status','client_budget'];  

    protected $table = 'clients';
    
    public function projects()
    {
       return $this->hasMany(Project::class);
    }
}

