<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang chủ</title>
</head>

<body>
    <h1>Trang chủ</h1>
    <div>
        <a href="{{ route('admin.users') }}">Admin User</a> |
        <a href="{{ route('admin.products') }}">Admin Products</a> |
        <a href="{{ route('products.comment', ['slug' => 'iphone', 'id' => 12]) }}">Product Comment</a>
    </div>
</body>

</html>
