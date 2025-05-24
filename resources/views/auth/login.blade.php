@extends('layouts.parent')

@section('formUpperLine')
    <div class="row row--nogutter top-line">
		<div class="line"></div>
	</div>
@endsection

@section('main')
    <div class="row--small">
        <form method="POST" action="{{route('login')}}">
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
            <h2>Войти</h2>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{old('email')}}">
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="password">
            </div>
            <div class="form-group">
                <a href="{{route('register')}}">Зарегистрироваться</a>
            </div>
            <div class="form-group">
                <button class="btn">Вход</button>
            </div>
        </form>
    </div>
@endsection

@section('formDownLine')
    <div class="row row--nogutter">
		<div class="line"></div>
	</div>
@endsection