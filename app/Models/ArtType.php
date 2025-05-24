<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtType extends Model
{
    //use HasFactory;
    protected $table = 'art_types';
    protected $guarded = ['id'];

    public function courses() {
        return $this->hasMany(Course::class, 'course_type');
    }
}