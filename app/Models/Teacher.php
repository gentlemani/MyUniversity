<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['name', 'gender', 'coordinator_id'];

    //Relación Polimorfica
    public function subjects()
    {
        return $this->morphToMany(Subject::class, 'subjectable');
    }
}
