<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Advices</title>
    <link rel="icon" href="/PatientImages/assistance.png">
    <link rel="stylesheet" href="../PatientCSS/all.min.css" />
    <link rel="stylesheet" href="../css/Patientcss/framework.css" />
    <link rel="stylesheet" href="../css/Patientcss/master.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="page d-flex">
        @include('patient_pages.components.sidebar')


        <div class="content w-full">
            <!-- Start Head -->
            @include('patient_pages.components.headWithNotification')

            <!-- End Head -->
            <h1 class="p-relative">Advices</h1>
            <div class="wrapper d-grid gap-20">
                <div class="last-project p-20 bg-white rad-10 p-relative">
                    <div class="intro p-20 d-flex space-between bg-eee">
                        <div>
                            <h2 class="mt-0 mb-20">
                                General Advices
                            </h2>
                        </div>
                    </div>
                    <ul class="m-0 p-relative">
                        <li class="mt-25 d-flex align-center done">If you have safety concerns, please notify your nurse right away.
                        </li>
                        <li class="mt-25 d-flex align-center done">Ask about prescribed tests or treatments .</li>
                        <li class="mt-25 d-flex align-center done">Learn about your condition and treatment by asking your physician </li>
                        <li class="mt-25 d-flex align-center done">Notify hospital personnel if you have an advance directive or living will</li>
                        <li class="mt-25 d-flex align-center done"> Read all medical forms and make sure you understand them </li>
                        <li class="mt-25 d-flex align-center done">Taking an active role in your care can help prevent medicine errors. </li>
                    </ul>
                </div>
                <div class="last-project p-20 bg-white rad-10 p-relative">
                    <div class="intro p-20 d-flex space-between bg-eee">
                        <div>
                            <h2 class="mt-0 mb-20">
                                Diabetes
                            </h2>
                        </div>
                    </div>
                    <ul class="m-0 p-relative">
                        <li class="mt-25 d-flex align-center done">Take medicines as prescribed

                        </li>
                        <li class="mt-25 d-flex align-center done">Do exercise as suggested .</li>
                        <li class="mt-25 d-flex align-center done">Follow diet as planned for you
                        </li>
                        <li class="mt-25 d-flex align-center done">Go for review on the given date
                        </li>
                        <li class="mt-25 d-flex align-center done"> Keep your blood pressure and cholesterol under control
                        </li>
                        <li class="mt-25 d-flex align-center done">Keep your vaccines up to date . </li>
                    </ul>
                </div>
                <div class="last-project p-20 bg-white rad-10 p-relative">
                    <div class="intro p-20 d-flex space-between bg-eee">
                        <div>
                            <h2 class="mt-0 mb-20">
                                Coronary heart disease
                            </h2>
                        </div>
                    </div>
                    <ul class="m-0 p-relative">
                        <li class="mt-25 d-flex align-center done">Eat a heart-healthy diet .
                        </li>
                        <li class="mt-25 d-flex align-center done">Maintain a healthy weight .
                        </li>
                        <li class="mt-25 d-flex align-center done">Get good quality sleep
                        </li>
                        <li class="mt-25 d-flex align-center done">Get regular health screenings
                        </li>
                        <li class="mt-25 d-flex align-center done"> Get moving: Aim for at least 30 to 60 minutes of activity daily
                        </li>
                        <li class="mt-25 d-flex align-center done">Don't smoke or use tobacco . </li>
                    </ul>
                </div>
                <div class="last-project p-20 bg-white rad-10 p-relative">
                    <div class="intro p-20 d-flex space-between bg-eee">
                        <div>
                            <h2 class="mt-0 mb-20">
                                Chronic kidney disease </h2>
                        </div>
                    </div>
                    <ul class="m-0 p-relative">
                        <li class="mt-25 d-flex align-center done">stay in your target blood sugar range as much as possible.
                        </li>
                        <li class="mt-25 d-flex align-center done">Keep your blood pressure below 140/90,
                        </li>
                        <li class="mt-25 d-flex align-center done">Get active. Physical activity helps control blood sugar levels
                        </li>
                        <li class="mt-25 d-flex align-center done">Lose weight if you are overweight
                        </li>
                        <li class="mt-25 d-flex align-center done"> Stay in your target cholesterol range.
                        </li>
                        <li class="mt-25 d-flex align-center done">Keep your kidneys healthy by controlling blood sugar, blood pressure </li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>
