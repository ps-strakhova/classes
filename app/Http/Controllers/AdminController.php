<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\EditCourseRequest;
use App\Http\Requests\StoreCourseRequest;

class AdminController extends Controller
{
    public function CourseShow($type, $id) {
        $info = Course::where('id', $id)->with(['masters', 'users'])->withCount('users')->first();
        return view('course', compact('info'));
    }

    public function CourseEdit($id) {
        $course = Course::findOrFail($id);
        return view('editcourse', compact('course'));
    }

    public function CourseUpdate(EditCourseRequest $request, $id) {
        $course = Course::findOrFail($id);
        $data = $request->validated();
        $course->update([
            'descr' => $data['descr'],
            'price' => $data['price']
        ]);

        return redirect(route('account'));
    }

    public function CourseCreate() {
        $times = Course::distinct()->pluck('event_time');
        return view('classadd', compact('times'));
    }

    public function CourseStore(StoreCourseRequest $request) {
        $data = $request->validated();
        $file = $data['image'];
        $filename = 'course' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('img'), $filename);
        
        Course::create([
            'name' => $data['name'],
            'course_type' => $data['course_type'],
            'master' => current_user()->id,
            'descr' => $data['descr'],
            'start_date' => $data['start_date'],
            'event_time' => $data['event_time'],
            'participants' => $data['participants'],
            'price' => $data['price'],
            'image' => $filename
        ]);

        return redirect(route('account'));
    }
}