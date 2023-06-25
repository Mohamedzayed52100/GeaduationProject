<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/Lab_images/health.png">
    <title> Survey Results </title>
    <link rel="shortcut icon" type="image/x-icon" href="/Lab_images/surveyIcon.png">
    <link rel="stylesheet" href="/Lab_css/SurveyResult.css">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>

    <!-- Reault section starts  -->

    <section class="result" id="Reault">

        <h1 class="heading"> <span>Heart Disease</span> Prediction </h1>

        <div class="row">

            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
            <lottie-player src="https://assets7.lottiefiles.com/packages/lf20_pcqghvjn.json" background="transparent"
                speed="1" style="width: 500px; height: 500px;" loop autoplay></lottie-player>

            <div class="content">
                <h3>Your Heart Survey Result is <div class="radioresult">

                        @if(session('result') =='Positive')
                        <br><br><br><strong style="color: rgb(196, 72, 72);">Positive</strong>
                        <script
                            src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_e1pmabgl.json"
                            background="transparent" speed="1"
                            style="width: 150px; height: 150px;margin-left: 30%;margin-top: -20%;" loop
                            autoplay></lottie-player>

                        @elseif(session('result')=='Negative')
                        <br><br><br><strong style="color: rgb(70, 145, 82);">Negative</strong>

                        <script
                            src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://assets7.lottiefiles.com/private_files/lf30_x0qiw13f.json"
                            background="transparent" speed="1.9"
                            style="width: 250px; height: 250px;margin-left: 25%;margin-top: -30%;" loop
                            autoplay></lottie-player>

                        @endif
                </h3>

            </div>
            <div class="button">
                <a href="/"><button class="btn-hover color-1">Go Back</button></a>
            </div>

        </div>

    </section>




</body>

</html>