<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Results</title>
    <link rel="icon" href="/PatientImages/assistance.png">

    <!-- result -->

    <link rel="stylesheet" href="../css/Patientcss/master.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../PatientCSS/all.min.css" />
    <link rel="stylesheet" href="../css/Patientcss/framework.css" />
 
</head>

<body>
    <div class="page d-flex">
        @include('patient_pages.components.sidebar')

     
      <div class="content w-full">
            <!-- Start Head -->
            @include('patient_pages.components.headWithNotification')

            <!-- End Head -->





            <!----------- Result Page ---------------->
            <h1 class="p-relative">Results</h1>
            <p style="font-size:40px; text-align:center;">Your Current Health Condition is :

                @if (session('report_Result') =="stable")
                    <span style="color:#22c55e">Stable</span>
                @elseif  (session('report_Result') =="unstable")    
                    <span style="color:#ff9933">Unstable</span>
                @else
                <span style="color:red">Emergency</span>

                @endif
                
            </p>
            <div class="wrapper d-grid gap-20">


                <!-------------- Card of Measurements -------------->
                <div class="targets p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-10" style="text-align: center;"> Current Vital Signs </h2>
                    <br>

                    <div class="target-row mb-20 center-flex orange">
                        <div class="icon center-flex">
                            <i class="fa fa-stethoscope" aria-hidden="true"></i>
                        </div>
                        <div class="details">
                            <span class="fs-14 c-grey">Blood Pressure</span>
                            <span class="d-block mt-5 mb-10 fw-bold">{{ session('systolic') }} /{{ session('diastolic') }}  mmHg</span>
                            @if (session('pressure_Result') =="stable")
                            <span style="color:#22c55e">Stable</span>
                            @elseif  (session('pressure_Result') =="unstable")    
                            <span style="color:#ff9933">Unstable</span>
                            @else
                            <span style="color:red">Emergency</span>
                            @endif
                        </div>
                        <div class="icon center-flex">
                            <i class="fa fa-tint" aria-hidden="true"></i>
                        </div>
                        <div class="details">
                            <span class="fs-14 c-grey">Blood Glucose</span>
                            <span class="d-block mt-5 mb-10 fw-bold">{{ session('glucose') }}   mg/dL</span>
                            @if (session('glucose_Result') =="stable")
                            <span style="color:#22c55e">Stable</span>
                            @elseif  (session('glucose_Result') =="unstable")    
                            <span style="color:#ff9933">Unstable</span>
                            @else
                            <span style="color:red">Emergency</span>        
                            @endif
                        </div>
                    </div>
                    <div class="target-row mb-20 center-flex green">
                        <div class="icon center-flex">
                            <i class="fa fa-heartbeat" aria-hidden="true"></i>
                        </div>
                        <div class="details">
                            <span class="fs-14 c-grey">Heart Rate </span><br>
                            @if (session('heart_Result') =="stable")
                            <span style="color:#22c55e">Stable</span>
                            @elseif  (session('heart_Result') =="unstable")    
                            <span style="color:#ff9933">Unstable</span>
                            @else
                            <span style="color:red">Emergency</span>
                            @endif
                        </div>
                        <div class="icon center-flex">
                            <i class="fa fa-medkit" aria-hidden="true"></i>

                        </div>
                        <div class="details">
                            <span class="fs-14 c-grey">Oxygen Saturation </span><br>
                            @if (session('oxygen_Result') =="stable")
                            <span style="color:#22c55e">Stable</span>
                            @elseif  (session('oxygen_Result') =="unstable")    
                            <span style="color:#ff9933">Unstable</span>
                            @else
                            <span style="color:red;">Emergency</span>
                            @endif
                        </div>
                    </div>
                </div>
                <!-------------- /Card of Measurements -------------->






                <!-------------- Card of tips -------------->

                <!----------------- if patient health condition(report) == Stable ----------------->
                @if (session('report_Result') =="stable")
                <div class="targets p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-10" style="text-align: center; color:#22c55e;">Remember </h2>
                    <div>
                        <ul style="list-style-type: '🔔 '; margin-left: 30px;">
                            <li style=" margin-bottom: 30px;">Follow up with your doctor and contact him</li>
                            <li style=" margin-bottom: 30px;">Take care of your medications and take your medication on time</li>
                            <li style=" margin-bottom: 30px;">If you feel unwell at any time, do not hesitate to check your vital signs</li>
                            <li> Contact the laboratory to get the results of Medical tests</li>
                        </ul>
                    </div>
                </div>

                @endif


                <!----------------- if patient health condition(report) == Unstable ----------------->
                @if (session('report_Result') =="unstable")
                <div class="targets p-20 bg-white rad-10">
                    <h3 class="mt-0 mb-10" style="text-align: center; color: red;">Do not neglect to take the following steps so that your condition does not deteriorate </h3>
                    <h5 class="mt-0 mb-10" style="text-align: center; color: grey;">We have informed your doctor about your health developments. If you feel fatigue, contact him immediately </h5>
                    <div>
                        <!------- if heart rate is unstable ------->
                        @if (session('heart_Result')=="unstable")
                        <ul style="margin-left: 30px;">
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Practicing deep or guided breathing techniques</li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Maintaining a healthy body weight by eating a nutritious, balanced diet , Heart-healthy nutrients include: omega-3, vitamin A, dietary fiber, vitamin C </li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Getting enough sleep</li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Avoid caffeine and nicotine</li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Reducing or resolving sources of substantial long-term stress</li>
                        </ul>
                            
                        @endif
                      
                        @if (session('oxygen_Result') =="unstable")

                        <!------- if oxygen is unstable ------->
                        <ul style="margin-left: 30px;">
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Sit up straight rather than laying flat</li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Be sure that you are taking deep breaths to get oxygen into your blood</li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Adopting and sticking to a regular exercise routine</li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Drink Lots of Water </li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Do not smoke </li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Eat Iron-rich Foods </li>
                        </ul>

                        @endif


                        @if(session('pressure_Result')=="unstable")
                        <!------- if pressure is unstable ------->
                        <ul style="margin-left: 30px;">
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Avoid to eat: Frozen foods, Salty and sugary foods, Caffeine and alcohol, Red meats</li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Eating a diet rich in whole grains, fruits, vegetables and low-fat dairy products and low in saturated fat and cholesterol</li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Smoking increases blood pressure. Stopping smoking helps lower blood pressure</li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Monitor your blood pressure at home and get regular checkups</li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Get a good night's sleep </li>
                        </ul>
                        @endif
                 


                        <!------- if glucose is unstable ------->
                        @if(session('glucose_Result')=="unstable")

                        <ul style="margin-left: 30px;">
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Eat more fiber which can slow down the digestion and absorption of carbohydrates</li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Incorporate more snacks by eating smaller meals more frequently</li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Increase your probiotic intake</li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Drink water and stay hydrated</li>
                            <li style=" margin-bottom: 30px;"><i class="fa fa-angle-double-right" style="color:red;"></i> Eat foods rich in chromium and magnesium</li>

                        </ul>

                        @endif
                    </div>
                </div>
                @endif


                <!----------------- if patient health condition(report) == Emergency ----------------->

                   @if (session('report_Result') =="emergency")
                    
           
                <div class="targets p-20 bg-white rad-10">
                    <h1 class="mt-0 mb-10" style="text-align: center; color:red;">You must go to Hospital !!</h1>
                    <div style="text-align: center; color:red;">
                        <h2>We have located you and called the ambulance.</h2>
                        <h2>We have told your doctor and relatives as well .</h2>
                        <h2>We will reach you soon.</h2>
                    </div>
                </div>
                @endif
                <!-------------- /Card of tips -------------->


            </div>

        </div>

</body>

</html>
