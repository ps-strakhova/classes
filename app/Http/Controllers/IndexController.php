<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\ArtType;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function Index() {
        $header = "Главная";
        $info = current_user();
        if($info) {
            $info->load('coursesUsers');
        }
        return view('index', compact('header', 'info'));
    }

    public function Type($id) {
        $artType = ArtType::find($id);
        $isAdmin = current_user() && current_user()->isAdmin();

        if(!$artType) {
            return redirect(route('home'));
        }

        $courses = Course::query();
        $courses->where('course_type', $id);
        if(current_user()) {
            $courses->with(['masters', 'users'])->withCount('users');
        }
        $courses = $courses->get();
        
        $message = null;
        if($courses->isEmpty()) {
            $message = "Пока нет таких курсов";
        }
        return view('type', compact('isAdmin', 'courses', 'artType'));
    }

    public function Account() {
        $info = current_user();
        $isAdmin = $info && $info->isAdmin();
        if($isAdmin) {
            $info->load(['coursesMasters.users']);
        }
        return view('account', compact('info', 'isAdmin'));
    }
}