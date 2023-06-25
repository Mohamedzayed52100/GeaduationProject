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
    <div class="container">
        <div class="user-image">
            <img src="/Lab_images/ForgetPassword.png" alt="Forget Password Image">
        </div>

        <div class="content">
            <h3 class="title">Password Reset</h3>

            <p class="details">
                Trouble signing in? Resetting your password is easy. Just enter your email address and we'll send you an email with instructions to reset your password.
            </p>

            <form method="post" action="/forgetPass">
               @csrf
               @if(session('success')) <p class="success">{{ session('success') }}</p> @endif
               @if(session('error')) <p class="error">{{ session('error') }}</p> @endif
               @error('email') <p class="error">{{ $message }}</p> @enderror
               <input class="input" type="email" name="email" id="email" placeholder="Enter your email" >
               <button class="effect effect-4">	Submit </button>
            </form>
        </div>

    </div>

    <!-- This is link of adding small images
		which are used in the link section -->
    <script src="https://kit.fontawesome.com/704ff50790.js" crossorigin="anonymous">
    </script>



</body>

</html>