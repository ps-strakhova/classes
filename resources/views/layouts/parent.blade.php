<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мастер-классы</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
    <header class="header">
        <div class="row grid middle between">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="Логотип">
                </a>
            </div>
            <h1 class="title">КЛУБ ЛЮБИТЕЛЕЙ ТВОРЧЕСТВА «ОЧУМЕЛЫЕ РУЧКИ»</h1>

            <div class="auth">
                @if(Route::currentRouteName() !== 'login')
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="info-form">
                            @csrf
                            <p class="text_info">
                                Добро пожаловать, <a href="{{ route('account') }}">{{ current_user()->email }}</a>
                            </p>
                            <button type="submit" class="button-logout">Выход</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">Вход</a>
                    @endauth
                @else
                    <div class="empty-space"></div>
                @endif
            </div>
        </div>
    </header>

    <div class="row row--nogutter"></div>

    @yield('formUpperLine')

    <main class="main">
        <div class="row">
            @yield('main')
        </div>
    </main>

    @yield('formDownLine')

    <footer class="footer">
        <div class="row">
            <div class="row--small grid between">
                <address class="address">Наш адрес: ВДНХ, 120в</address>
                <div class="tel">Тел: 8&nbsp;912&nbsp;345&nbsp;67&nbsp;65</div>
                <div class="copy">&copy; {{ now()->year }} Все права защищены</div>
            </div>
        </div>
    </footer>

    @once
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            toastr.options = {
                closeButton: true,
                positionClass: "toast-bottom-right",
                timeOut: 4000
            };
        </script>
    @endonce

    @if(session()->has('info'))
        <script>
            toastr.info(@json(session('info')));
        </script>
    @endif

    @if(session()->has('success'))
        <script>
            toastr.success(@json(session('success')));
        </script>
    @endif
</body>
</html>
