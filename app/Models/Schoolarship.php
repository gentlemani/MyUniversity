<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schoolarship extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'amount', 'capacity', 'endDate'];
    //Uno a muchos
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
