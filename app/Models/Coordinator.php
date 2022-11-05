<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'degree', 'gender', 'user_id'];
    public $timestamps = false;
    // One to One relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
