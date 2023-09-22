@props([
	'title',
	'h1' => null
])

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.scss'])
</head>
<body>
<header>
    <div class="container border-bottom pb-2">
        <div class="row">
            <div class="col"><div class="alert">Logo</div></div>
            <div class="col">
                ---
            </div>
        </div>
    </div>
</header>
<div>
    <div class="container py-2">
        <div class="row">
            <div class="col col-3">
                <div class="list-group">
                    <li class="list-group-item">
                        <a href="{{ route('city.index') }}">Города</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('manager.index') }}">Менеджеры</a>
                    </li>
                </div>
            </div>
            <div class="col col-9">
                @if (session('alert'))
                    <div class="alert alert-info" role="alert">
                        {{ session('alert') }}
                    </div>
                @endif
                <h1>{{ $h1 ?? $title }}</h1>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="container border-top pt-2">
        Footer
    </div>
</footer>
@vite(['resources/js/app.js'])
</body>
</html>
