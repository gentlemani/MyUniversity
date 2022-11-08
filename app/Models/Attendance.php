<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'date',
        'teacher_id',
        'subject_id',
    ];
    // Uno a muchos
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    //muchos a muchos
    public function students()
    {
        return $this->belongsToMany(Student::class)->withPivot('status');
    }
}
