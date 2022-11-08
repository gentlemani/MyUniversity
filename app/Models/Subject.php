<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['name', 'section', 'schedule', 'coordinator_id', 'clave'];


    //Relación Polimorfica Muchos a Muchos
    public function teachers()
    {
        return $this->morphedByMany(Teacher::class, 'subjectable');
    }
    public function students()
    {
        return $this->morphedByMany(Student::class, 'subjectable');
    }
    //relacion uno a muchos
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
