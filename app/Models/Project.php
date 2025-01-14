<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name','desc','status','client_id'];
    protected $table = 'projects';

   public function client()
   {
        return $this->belongsTo(Client::class); 
   }

}