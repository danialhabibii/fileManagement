<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/app.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    @if (session('success'))
        <h2 class="Session_Message"> {{ session('success') }}</h2>
    @endif
    @if (session('warning'))
        <h2 class="Session_Message"> {{ session('warning') }}</h2>
    @endif
    {{-- Form Code --}}
    <div class="upload_form">
        <h3 class="upload_file_form_title">Upload Your Files</h3>
        <h4 class="upload_file_form_text">Easy and free way to share your data</h4>
        <form action="{{ route('uploads') }}" class="upload_forms" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" class="file_input" name="user_file">
            @error('user_file')
                {{ $message }}
            @enderror
            <br>
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display() !!}
            <br>
            <button type="submit" class="upload_form_btn">upload</button>
        </form>
        <h3 class="uploaded">{{ $uploaded->uploaded }} File uploaded</h3>
    </div>
</body>

</html>



