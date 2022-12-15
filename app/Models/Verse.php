<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verse extends Model
{
    use HasFactory;

    protected $fillable =['path' , 'year']; 
 
    public function users(){
        return $this->belongsToMany(user::class)->as('users');
    }
}
