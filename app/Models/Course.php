<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Course extends Model
{
    //use HasFactory;
    protected $table = 'courses';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'course_type', 'master', 'descr', 'start_date', 'event_time', 'participants', 'price', 'image'];

    public function types() {
        return $this->belongsTo(ArtType::class, 'course_type');
    }

    public function masters() {
        return $this->belongsTo(User::class, 'master');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'user_id');
    }

    public function getStartDateFormattedAttribute() {
        return Carbon::parse($this->start_date)->format('d.m.Y');
    }

    public function getEventTimeFormattedAttribute() {
        return Carbon::parse($this->event_time)->format('H:i');
    }

    public function getIsUserEnrolledAttribute()
    {
        $user = current_user();
        if (!$user) {
            return false;
        }
        return $this->users->contains($user->id);
    }

    public function getIsFullAttribute()
    {
        return $this->users_count >= $this->participants;
    }

    public function getIsPastAttribute()
    {
        return Carbon::parse($this->start_date)->isPast();
    }
}