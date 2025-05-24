@extends('layouts.parent')

@section('main')
    <div class="hover"></div>
    <div class="title">{{$artType->name}}</div>
    <div class="row--small grid between">
        <div class="content">
            <img class="paddImage" src="{{asset('img/' . $artType->title_image)}}" alt="Изображение курса">
            <p>{{$artType->descr}}</p>
        </div>
        <ul class="menu">
            <li><a href="{{route('home')}}">Главная</a></li>
            @foreach($types as $type)
                <li><a href="{{route('artType', ['type' => $type->id])}}">{{$type->name}}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="row shedule">
        <div class="row--small">
            <h2>Расписание</h2>
            <div class="drivers">
                @if(isset($message))
                    <p>{{$message}}</p>
                @else
                    @foreach($courses as $course)
                        <div class="driver grid">
                            <div class="driver-left grid">
                                <div class="driver-photo">
                                    <img class="pre_title" src="{{asset('img/' . $course->image)}}" alt="Фото курса">
                                </div>
                                <div class="driver-text">
                                    @if($isAdmin)
                                        <div class="driver-name"><a href="{{route('course.show', ['type' => $artType->id, 'id' => $course->id])}}">Мероприятие: {{$course->name}}</a></div>
                                    @else
                                        <div class="driver-name">Мероприятие: {{$course->name}}</div>
                                    @endif
                                    <div class="driver-name">Мастер: {{$course->masters->name}}</div>
                                    <div class="driver-name">Дата: {{$course->start_date_formatted}}</div>
                                    <div class="driver-name">Время проведения: {{$course->event_time}}</div>
                                    <div class="driver-name">Свободно мест: {{$course->participants - $course->users_count}} из {{$course->participants}}</div>
                                    <div class="driver-name">Стоимость: {{$course->price}} р.</div>
                                    <div class="driver-desc">{{$course->descr}}</div>
                                </div>
                            </div>
                            <div class="driver-right">
                                
                                @if(current_user() && current_user()->isUser())
                                    @if($course->is_past)
                                        <p class="notice">Мастер-класс уже прошёл</p>
                                    @elseif($course->is_user_enrolled)
                                        <p class="notice">Вы уже записаны</p>
                                    @elseif($course->is_full)
                                        <p class="notice">Свободных мест нет</p>
                                    @else
                                        <a href="{{route('check', $course->id)}}" class="driver-btn">Записаться</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
