<!DOCTYPE html>
<html lang="en">

<head>
    <title>Patient Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../image/PatientImages/favicon.ico" />

    <link rel="stylesheet" type="text/css" href="../css/Patientcss/util.css">
    <link rel="stylesheet" type="text/css" href="../css/Patientcss/loginpage.css">
</head>

<body>

    <!-- patient_login -->
    <div class="limiter">
        <div class="container-login100" style="background-image: url('../image/PatientImages/login.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
					 Login as Patient
				</span>
                <form class="login100-form validate-form p-b-33 p-t-5" method="POST" action="/login_submit_p" >
                    @csrf

                    <div class="wrap-input100 validate-input" data-validate="Enter username">
                        <input class="input100" type="email" name="email" placeholder="Email" value="{{old('email')}}">
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="password" placeholder="Password">
                    </div>

                    <div class="container-login100-form-btn m-t-32">
                        <button type="submit" class="login100-form-btn" style="background-color: #4aafff   !important; ">
							Login
						</button>
                    </div>

                </form>
                <!-- </div> -->
            </div>
        </div>


        <div id="dropDownSelect1"></div>


        <script src="../js/Patientjs/Loginmain.js"></script>


</body>

</html>
