@extends('layouts.parent')

@section('formUpperLine')
    <div class="row row--nogutter top-line">
		<div class="line"></div>
	</div>
@endsection

@section('main')
    <div class="row--small">
        <form enctype="multipart/form-data" method="POST" action="{{route('course.store')}}">
            @if($errors->any())
                <div class="alert">
                    <ul class="alert_ul">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            <h2>Добавление мастер-класса</h2>
            <input type="hidden" id="masterId" value="{{current_user()->id}}"> 
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" name="name" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="course_type">Вид творчества</label>
                <select class="course_type" name="course_type">
                    @foreach($types as $type)
                        <option value="{{$type->id}}"
                            {{old('course_type', '') == $type->id ? 'selected' : ''}}>
                            {{$type->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="descr">Описание</label>
                <textarea class="descrarea" name="descr">{{old('descr')}}</textarea>
            </div>
            <div class="form-group">
                <label for="start_date">Дата начала</label>
                <input type="date" name="start_date" id="datePicker" value="{{old('start_date')}}" min="{{\Carbon\Carbon::today()->toDateString()}}">
            </div>
            <div class="form-group">
                <label class="radio_name">Время проведения</label>
                @foreach($times as $time)
                    <label class="radio_time">{{$time}}
                        <input type="radio" name="event_time" value="{{$time}}" class="time-option">
                    </label>
                @endforeach
            </div>
            <div class="form-group">
                <label for="participants">Количество участников</label>
                <input type="number" name="participants" min="1" value="{{old('participants')}}">
            </div>
            <div class="form-group">
                <label for="price">Стоимость</label>
                <input type="number" name="price" min="0" value="{{old('price')}}">
            </div>
            <div class="form_group">
                <label for="image" class="lblimage">Изображение для курса</label>
                <input type="file" name="image" accept="image/jpeg" class="fileimage">
            </div>
            <button type="submit" class="btn">Создать</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const datePicker = document.getElementById('datePicker');
            const masterId = document.getElementById('masterId');
            const timeOptions = document.querySelectorAll('.time-option');

            function updateTimeOptions(date) {
                fetch(`/api/courses/occupied-times?date=${date}&master_id=${masterId.value}`)
                    .then(response => response.json())
                    .then(data => {
                        timeOptions.forEach(option => {
                            option.disabled = data.occupied.includes(option.value);
                        });
                    })
                    .catch(error => {
                        console.error("Ошибка при получении данных:", error);
                    });
            }

            datePicker.addEventListener('change', function () {
                if(this.value) {
                    updateTimeOptions(this.value);
                }
            });

            if(datePicker.value) {
                updateTimeOptions(datePicker.value);
            }
        });
    </script>
@endsection

@section('formDownLine')
    <div class="row row--nogutter">
		<div class="line"></div>
	</div>
@endsection