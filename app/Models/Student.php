<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['name', 'semester', 'degree', 'coordinator_id'];


    //Relación Polimorfica
    public function subjects()
    {
        return $this->morphToMany(Subject::class, 'subjectable');
    }

    //Relacion uno a uno
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
