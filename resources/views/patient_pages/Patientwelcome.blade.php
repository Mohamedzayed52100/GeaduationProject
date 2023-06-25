<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome Page</title>
    <link rel="icon" href="/PatientImages/assistance.png">
    <link rel="stylesheet" href="../PatientCSS/all.min.css" />
    <link rel="stylesheet" href="../css/Patientcss/framework.css" />
    <link rel="stylesheet" href="../css/Patientcss/master.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />


    <style>
        .imgh {
            display: flex;
            align-items: center;
            margin-left: 320px;
        }

        .welcomePage {
            text-align: center;
            font-size: 20px;
            color: #2d2b2b;
        }

      
    </style>
</head>

<body>
<div class="page d-flex">
    @include('patient_pages.components.sidebar')
    <div class="content w-full">
        @include('patient_pages.components.headWithNotification')
        <div class="center">
            <div class="imgh">
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_txinanby.json" background="transparent" speed="1" style="width: 350px; height: 350px;" loop autoplay></lottie-player>
                <h1 style=" margin-top: 50px;"> <span style=" color: #0fc145;"> {{ session('patient_login')->name }}</span></h1>
            </div>
            <p style="color: #0fc145;" class="welcomePage">Hope you are doing well today!</p>
            <p class="welcomePage">Please don't forget to check your measurements to help us make you feel better.</p>
            <p class="welcomePage">TeleMedicine always here to make you safe and totally satisfied! </p>
        </div>
        </div>
    </div>

</body>

</html>
