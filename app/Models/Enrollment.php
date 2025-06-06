<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    //use HasFactory;
    protected $table = 'enrollments';
    protected $guarded = ['id'];
    protected $fillable = ['course_id', 'user_is'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }
}