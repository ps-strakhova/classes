@extends('layouts.parent')

@section('main')
    <div class="hover"></div>
    <div class="title">Подтверждение записи</div>
    <div class="row--small">
        <div class="content">
            <p><strong>ФИО пользователя:</strong> {{$user->name}}</p>
            <p><strong>Вид творчества:</strong> {{$course->types->name}}</p>
            <p><strong>Мастер:</strong> {{$course->masters->name}}</p>
            <p><strong>Дата:</strong> {{$course->start_date_formatted }}</p>
            <p><strong>Время:</strong> {{$course->event_time_formatted}}</p>
        </div>

        <form class="action-btn" method="POST" action="{{route('enroll.store', $course->id)}}">
            @csrf
            <button type="submit" class="btn">Подтвердить</button>
        </form>

        <form class="action-btn" method="POST" action="{{route('enroll.cancel', $course->id)}}" style="margin-top: 10px;">
            @csrf
            <button type="submit" class="btn">Отмена</button>
        </form>
    </div>
@endsection