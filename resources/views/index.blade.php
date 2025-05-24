@extends('layouts.parent')

@section('main')
    <div class="hover"></div>
    <div class="title">Главная</div>
    <div class="row--small grid between">
        <div class="content">
            @guest
                <p>Самые лучшие мастер-классы от самых очумелых для еще более очумелых. Присоединяйтесь к нам и откройте для себя мир творчества! На "Очумелых ручках" каждый найдет что-то для себя — вдохновляйтесь, создавайте и получайте удовольствие от процесса!</p>
            @endguest
            @auth
                @if(current_user()->isAdmin())
                <p>Самые лучшие мастер-классы от самых очумелых для еще более очумелых</p>
                @endif
                @if(current_user()->isUser())
                    <div class="row shedule">
                        <div class="row--small">
                            <h2>Мои курсы</h2>
                            @if($info->coursesUsers->isEmpty())
                                <h3>Вы пока не записаны на мастер-классы</h3>
                            @else
                                <div class="drivers">
                                    @foreach($info->coursesUsers as $course)
                                        <div class="driver grid">
                                            <div class="driver-left grid">
                                                <div class="driver-photo">
                                                    <img class="pre_title" src="{{asset('img/' . $course->image)}}">
                                                </div>
                                                <div class="driver-text">
                                                    <div class="driver-name">Мастер: {{$course->masters->name}}</div>
                                                    <div class="driver-name">{{$course->name}}</div>
                                                    <div class="driver-name">Дата: {{$course->start_date_formatted}}</div>
                                                    <div class="driver-name">Время проведения: {{$course->event_time}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @endauth
        </div>
        <ul class="menu">
            <li><a href="{{route('home')}}">Главная</a></li>
            @foreach($types as $type)
                <li><a href="{{route('artType', ['type' => $type->id])}}">{{$type->name}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection