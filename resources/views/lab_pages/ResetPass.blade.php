<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reset Your Password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/Lab_images/Lablogin.png">
    <link rel="stylesheet" href="/Lab_css/ForgetPass.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../path/to/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <div class="Resetcontainer">
    
    <form method="post" action="/ResetPassword" class="resetForm">
        @csrf
        <hr><p class="title">Enter Your New Password</p><hr style="margin-bottom:15px;">
        @if(session('error')) <p class="error">{{ session('error') }}</p> @endif
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <input type="hidden" name="token" id="token" value="{{ $token }}" />

        <div class="form__group">
            <label for="email">Email:</label>
            @foreach($email as $key=>$userEmail)
            <input type="email" name="email" id="email" class="form__input" value="{{ $userEmail->email }}" readonly />
            @endforeach
        </div>
        
        @error('password') <p class="error">{{ $message }}</p> @enderror
        <div class="form__group">
            <label for="password">Password:</label>
            <input type="password"  name="password" id="password" class="form__input" pattern=".{8,}" title="Must contain at least 8 or more characters" />
        </div>
        
        <div class="form__group">
            <label for="password-confirmation">Password Confirmation:</label>
            <input type="password" name="password_confirmation" id="password-confirmation" class="form__input" />
        </div>
        
        <button class="btn" >Reset Password</button>
    </form>
</div>
    


</body>

</html>