<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['name', 'date', 'teacher_id', 'description', 'subject_id'];
    // Uno a muchos
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    //Relación muchos a muchos
    public function students()
    {
        return $this->belongsToMany(Student::class)->withPivot('delivered');
    }
}
