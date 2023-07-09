<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/app.css">
    <title>Document</title>
</head>

<body>
    @if (session('success'))
        <h2 class="Session_Message"> {{ session('success') }}</h2>
    @endif
    @if (session('warning'))
        <h2 class="Session_Message"> {{ session('warning') }}</h2>
    @endif
    <div class="admin_form">
        <h3 class="upload_file_form_title">Please Login</h3>
        <form action="{{ route('admin_login') }}" class="upload_forms" method="post">
            @csrf
            <input type="email" name="email" class="admin_input" placeholder="email">
            <br>
            <input type="password" name="password" placeholder="password">
            <br>
            <button type="submit" class="upload_form_btn">login</button>
        </form>
    </div>
</body>

</html>
