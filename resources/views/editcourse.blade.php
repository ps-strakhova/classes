@extends('layouts.parent')

@section('formUpperLine')
    <div class="row row--nogutter top-line">
		<div class="line"></div>
	</div>
@endsection

@section('main')
    <div class="row--small">
        <form method="POST" action="{{route('course.update', ['id' => $course->id])}}">
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
            @method('PATCH')
            <h2>Изменение данных о курсе</h2>
            <div class="form-group">
                <label for="descr">О мастер-классе</label>
                <textarea class="descrarea" name="descr" class="less">{{old('name', $course->descr)}}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Стоимость</label>
                <input type="number" name="price" min="0" value="{{old('name', $course->price)}}">
            </div>
            <div class="form-group">
                <button class="btn">Редактировать</button>
            </div>
        </form>
    </div>
@endsection

@section('formDownLine')
    <div class="row row--nogutter">
		<div class="line"></div>
	</div>
@endsection