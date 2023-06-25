<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="/image/support.png">
    <title>Register</title>
    <link rel="stylesheet" href="/RelativeCSS/style.css">
</head>

<body>
    <div class="login-div flex-column-centered">
        <div class="login-comps">
            <h1 style="text-align: center;">Registration </h1>
            <form method="post" action="/RegisterRelative" class="flex-column-centered">
                @csrf
                @if(session('error'))<div class="erroralert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    {{ session('error') }}
                </div>@endif
                <input type="text" name="username" id="username" placeholder="Username" required value="{{ old('username') }}">
                @error('username')<p class="erroralert">{{ $message }}</p>@enderror

                <input type="email" name="email" id="email" placeholder="Email" required value="{{ old('email') }}">
                @error('email')<p class="erroralert">{{ $message }}</p>@enderror

                <input type="password" name="password" id="password" placeholder="Password" required>
                @error('password')<p class="erroralert">{{ $message }}</p>@enderror

                <input type="password" name="password_confirmation" id="password_confirm" placeholder="Password Confirmation" required>

                <input type="text" name="city" id="city" placeholder="City" required value="{{ old('city') }}">
                @error('city')<p class="erroralert">{{ $message }}</p>@enderror

                <input type="text" name="country" id="country" placeholder="Country" required value="{{ old('country') }}">
                @error('country')<p class="erroralert">{{ $message }}</p>@enderror

                <input type="tel" name="phone" id="phone" placeholder="Phone Number" required value="{{ old('phone') }}">
                @error('phone')<p class="erroralert">{{ $message }}</p>@enderror

                <button type="submit">Register</button>
            </form>
            <p style="margin-left: 85px;">Already have account? </p>
            <a href="/loginRelative">
                <p class="text-center"> Log in </p>
            </a>
        </div>
    </div>
</body>

</html>