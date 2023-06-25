<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="/image/support.png">
    <title>Login</title>
    <link rel="stylesheet" href="/RelativeCSS/style.css">
</head>

<body>

    <div class="login-div flex-column-centered">
        @if(session('success'))<div class="success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Success! </strong>{{ session('success') }}
        </div>@endif

        <div class="login-comps">
            <h1 style="text-align: center;">Login </h1>
            <form method="post" aaction="{{ route('login') }}" class="flex-column-centered">
                @csrf
                @if(session('error'))<div class="erroralert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    {{ session('error') }}
                </div>@endif
                <input style="margin: 0.9rem auto;margin-top: 30px;" type="email" name="email" id="email" placeholder="Email" required value="{{ old('email') }}">
                @error('email')<p class="erroralert">{{ $message }}</p>@enderror
                <input style="margin: 0.9rem auto;" type="password" name="password" id="password" placeholder="Password" required>
                @error('password')<p class="erroralert">{{ $message }}</p>@enderror
                <button type="submit">Login</button>
                
            </form>
            <p style="margin-left: 100px;">Don't have account? </p>
            <a href="/RegisterRelative">
                <p class="text-center"> Register </p>
            </a>
        </div>
    </div>
</body>

</html>