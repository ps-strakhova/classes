@extends('layouts.parent')

@section('main')
    <div class="hover"></div>
    <div class="title">Личный кабинет</div>
    <div class="row--small grid between">
        <div class="content driver-page">
            <div class="driver-page-photo">
                <img src="{{asset('img/' . $info->image)}}">
            </div>	

            <div class="driver-page-name">{{$info->name}}</div>
            <div class="driver-page-text">
                <p>Email: {{$info->email}}</p>
                <p>Телефон: {{$info->phone}}</p>

                @if($isAdmin)
                    <div class="driver-page-my">Мои мастер-классы</div>

                    @if($info->coursesMasters->isEmpty())
                        <p>Вы пока не ведёте ни одного курса.</p>
                    @else
                        <table class="driver-page-table">
                            <tbody>
                                @foreach($info->coursesMasters as $course)
                                    <tr>
                                        <td>{{$course->start_date_formatted}} {{$course->event_time_formatted}}</td>
                                        <td>
                                            <b><a href="{{route('course.show', ['type' => $course->course_type, 'id' => $course->id])}}">{{$course->name}}</a></b><br>
                                            <b><a class="edit-a" href="{{route('course.edit', ['id' => $course->id])}}">Редактировать мой курс</a></b>
                                            @if($course->users->isEmpty())
                                                <p>Нет участников мастер-класса</p>
                                            @else
                                                @foreach($course->users as $user)
                                                    <p>
                                                        {{$user->name}}<br>
                                                        Email: {{$user->email}}<br>
                                                        Тел: {{$user->phone}}
                                                    </p>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    <div class="driver-page-btn-wrapper">
                        <div class="driver-page-btn btn">
                            <a href="{{route('course.create')}}">Добавить мастер-класс</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <ul class="menu">
            <li><a href="{{route('home')}}">Главная</a></li>
            @foreach($types as $type)
                <li><a href="{{route('artType', ['type' => $type->id])}}">{{$type->name}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection

@section('formDownLine')
    <div class="row row--nogutter">
		<div class="line"></div>
	</div>
@endsection