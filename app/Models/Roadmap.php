<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function courses(){
        return $this->hasMany(Course::class,'roadmap_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'User_id');
    }
}
