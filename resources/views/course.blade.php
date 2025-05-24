@extends('layouts.parent')

@section('main')
    <div class="hover"></div>
    <div class="title">{{$info->name}}</div>
    <div class="row--small grid between">
        <div class="content">
            <img class="pre_title paddImage" src="{{asset('img/' . $info->image)}}" alt="Изображение курса">
            <p>Мастер: {{$info->masters->name}}</p>
            <p>Дата: {{$info->start_date_formatted}}</p>
            <p>Время: {{$info->event_time_formatted}}, идет 2 часа</p>
            <p>Дата: {{$info->start_date_formatted}}</p>
            <p>Свободно мест: {{$info->participants - $info->users_count}} из {{$info->participants}}</p>
            <p>Стоимость {{$info->price}} р.</p>
            <p>{{$info->descr}}</p>
            <h3>Список участников</h3>
            @if($info->users->isEmpty())
                <p>Пока нет участников</p>
            @else
                @foreach($info->users as $user)
                    <div class="driver grid members">
                        <div class="driver-left grid">
                            <div class="driver-text">
                                <p>{{$user->name}}</p>
                                <p>{{$user->email}}</p>
                                <hr>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <ul class="menu">
            <li><a href="{{route('home')}}">Главная</a></li>
            @foreach($types as $type)
                <li><a href="{{route('artType', ['type' => $type->id])}}">{{$type->name}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection