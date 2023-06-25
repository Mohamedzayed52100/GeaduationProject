<!DOCTYPE html>
<html lang="en">

<head>
    <title>Al-Mokhtaber Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/Lab_images/Lablogin.png">
    <link rel="stylesheet" type="text/css" href="/Lab_vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/Lab_fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Lab_fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="/Lab_vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="/Lab_vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="/Lab_vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="/Lab_vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/Lab_vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="/Lab_css/LabLoginUtil.css">
    <link rel="stylesheet" type="text/css" href="/Lab_css/LabLogin.css">
</head>

<body>
<!---- Sweet alert---->
@include('sweetalert::alert')

    <div class="limiter">
        <div class="container-login" style="background-image: url('/Lab_images/labLoginBackground.jpg');">
            <div class="wrap-login" style="position: absolute; left: 1100px;">
                <form class="login-form" method="post" action="{{ route('login') }}">
                    @csrf
                    <span class="login-form-logo">
						<i><iconify-icon icon="mdi:account-lock"></iconify-icon></i>
						</span>

                    <span class="login-form-title" >
						Welcome Back,
                        </span>
					
                        @if(session('success')) <p class="success">{{ session('success') }}</p> @endif
                        @if(session('error')) <p class="error">{{ session('error') }}</p> @endif


                    <!-- Email -->
                    @error('email') <p class="error">{{ $message }}</p> @enderror
                    <div class="wrap-input">
                        <input class="input" type="email" name="email" id="email" placeholder="Email" 
                        @if (Cookie::has('LabAdminEmail')) value="{{Cookie::get('LabAdminEmail')}}" @endif
                        value="{{ old('email') }}"
                        >
                        <span class="focus-input" data-placeholder="&#xf207;"></span>
                    </div>

                    
                     <!-- Password -->
                    @error('password') <p class="error">{{ $message }}</p> @enderror
                    <div class="wrap-input">
                        <input class="input" type="password" name="password" id="password" placeholder="Password" 
                        @if (Cookie::has('LabAdminPassword')) value="{{Cookie::get('LabAdminPassword')}}" @endif
                        >
                        <span class="focus-input" data-placeholder="&#xf191;"></span>
                    </div>

                     <!-- Remember me -->
                    <div class="contact-form-checkbox">
                        <input class="input-checkbox" id="checkboxRemember" type="checkbox" name="remember-me"
                        @if (Cookie::has('LabAdminEmail')) checked @endif
                        >
                        <label class="label-checkbox" for="checkboxRemember">
							Remember me
						</label>
                    </div>

                    <!-- Login Button -->
                    <div class="container-login-form-btn">
						<button class="login-form-btn" >
							Login
						</button>
					</div>


                    <!-- Forgot Password -->
                    <div class="text-center p-t-90">
                        <a class="txtForget" href="/forgetPass">
							Forgot Password?
						</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="/Lab_vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="/Lab_vendor/animsition/js/animsition.min.js"></script>
    <script src="/Lab_vendor/bootstrap/js/popper.js"></script>
    <script src="/Lab_vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="/Lab_vendor/select2/select2.min.js"></script>
    <script src="/Lab_vendor/daterangepicker/moment.min.js"></script>
    <script src="/Lab_vendor/daterangepicker/daterangepicker.js"></script>
    <script src="/Lab_vendor/countdowntime/countdowntime.js"></script>
    <script src="/Lab_js/main.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
</body>

</html>