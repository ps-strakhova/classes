<?php

namespace App\Http\Controllers;

use App\Models\Course;

class ActionController extends Controller
{
    public function Check(Course $course)
    {
        $user = current_user();
        $course->load('masters', 'types')->loadCount('users');
        return view('check', compact('user', 'course'));
    }

    public function Store(Course $course)
    {
        $user = current_user();

        if($course->is_user_enrolled) {
            return back()->with('error', 'Вы уже записаны на этот курс.');
        }

        if($course->is_full) {
            return back()->with('error', 'На курсе нет свободных мест.');
        }

        if($course->is_past) {
            return back()->with('error', 'Нельзя записаться на прошедший курс.');
        }

        $course->users()->attach($user->id);
        return redirect()->route('artType', $course->course_type)->with('success', 'Вы успешно записались на курс!');
    }

    public function Cancel(Course $course)
    {
        return redirect()->route('artType', $course->course_type)->with('info', 'Вы отменили запись на курс');
    }
}