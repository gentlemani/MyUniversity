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
    //Relacion uno a uno
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
    //Uno a muchos
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
