<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $post->title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <nav>
            MENU
        </nav>
        <div>
            <h2>{{ $post->title }}</h2>
            <p>
                {{ $post->content }}
            </p>
        </div>
    </div>
</body>

</html>
