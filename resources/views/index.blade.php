<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <nav>
            <a href="{{ route('home') }}">Trang chủ</a>
            @foreach ($categories as $cate)
                <a href="{{ route('posts.list', $cate->id) }}">
                    {{ $cate->name }}
                </a>
            @endforeach

            @if (Auth::check())
                {{ Auth::user()->email }}

                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endif
        </nav>
        <div class="container">
            <h2>Danh sách bài viết mới nhất</h2>
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-3 mb-3">
                        <a href="{{ route('posts.detail', $post->id) }}">
                            <h3>{{ $post->title }}</h3>
                        </a>
                        <div>
                            Danh mục: {{ $post->name }}
                        </div>
                        <div>
                            {{ $post->description }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
