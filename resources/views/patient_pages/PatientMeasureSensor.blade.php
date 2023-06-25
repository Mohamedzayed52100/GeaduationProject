<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Measurements</title>
    <link rel="icon" href="/PatientImages/assistance.png">
    <link rel="stylesheet" href="../PatientCSS/all.min.css" />
    <link rel="stylesheet" href="../css/Patientcss/framework.css" />
    <link rel="stylesheet" href="../css/Patientcss/master.css" />
    <link rel="stylesheet" href="/Lab_css/patientMeasure.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="../PatientCSS/font-awesome.min.css">
    <link rel="stylesheet" href="../PatientCSS/feathericon.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />
</head>


<body>
    <div class="page d-flex">
        @include('patient_pages.components.sidebar')
        <div class="content w-full">
            <!-- Start Head -->
            @include('patient_pages.components.headWithNotification')

            <!-- End Head -->
            <h1 class="p-relative">Measurements</h1>
            <section class="myform-step">
                <h2 class="font-normal">Let's Start</h2>
                <p style="text-align:center;">If you want to start to take your measurements from your device,</p>
                <p style="text-align:center;">Please check that you follow the instructions and don't lift your thumb before the downcount timer finish</p>
                <div name="error" id="error" class="error" style="text-align:center; color:red;"></div>
                
                <div class="mt-3">
                    <div class="mb-3 row">
                        <div class="timer" id="timer"></div>
                    </div>
                </div>

                <div class="mt-3" style="margin-left:430px">
                    <button type="button" class="Startbutton" id="Startbutton">Start</button>
                </div>
            </section> 

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
        var seconds=5;
        var timer;
        function myFunction() {
            if(seconds < 30) { 
                document.getElementById("timer").innerHTML = seconds;
            }
            if (seconds >30 ) { 
                seconds--;
            } else{
                clearInterval(timer);
                $.ajax({
                    url: '{{url("Sensor")}}',
                    type: "GET",
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        var reply = response;
                        console.log(reply);
                        if(reply == 'No data is entered'){
                            document.getElementById("error").innerHTML="Something went wrong. Please Follow the instructions and Reuse your medical device again"; 
                        }
                        if(reply == 'Data is Updated'){
                            window.open("/measurement","_self");
                        }
                    }, 
                    error: function(error) {
                        console.log(error)
                    },
                });    
            }
        }
        $("#Startbutton").click( function(){
            if(!timer) {
                timer = window.setInterval(function() { 
                     myFunction(); }, 
                1000); // every second
            }
        } )
        document.getElementById("timer").innerHTML="Timer"; 
    </script>



</body>

</html>