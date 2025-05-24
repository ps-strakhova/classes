@extends('layouts.parent')

@section('formUpperLine')
    <div class="row row--nogutter top-line">
		<div class="line"></div>
	</div>
@endsection

@section('main')
    <div class="row--small">
        <form enctype="multipart/form-data" method="POST" action="{{route('register')}}">
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
            <h2>Форма регистрации</h2>
            <div class="form-group">
                <label for="name">ФИО</label>
                <input type="text" name="name" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{old('email')}}">
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" name="password">
            </div>
            <div class="form-group">
                <label for="phone">Номер телефона</label>
                <input type="tel" name="phone" placeholder="x-xxx-xxx-xx-xx" value="{{old('phone')}}">
            </div>
            <div class="form_group">
                <label for="image" class="lblimage">Изображение для профиля</label>
                <input type="file" name="image" accept="image/jpeg" class="fileimage">
            </div>
            <div class="form-group">
                <button class="btn">Зарегистрироваться</button>
            </div>
        </form>
    </div>
@endsection

@section('formDownLine')
    <div class="row row--nogutter">
		<div class="line"></div>
	</div>
@endsection