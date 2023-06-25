<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../all.min/all.min.css">
    <link rel="stylesheet" href="../css/DoctorCss/style.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Emergent Cases</title>
</head>

<body>

    <!-- SIDEBAR -->
    @include('doctor_pages.component.sidebar')

    <!-- SIDEBAR -->
    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->

        @include('doctor_pages.component.navbarWithNotification')
        <!-- NAVBAR -->
        <main>
            <div class="head-title">
                <div class="left">
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Emergency List</a>
                        </li>
                    </ul>
                </div>

            </div>
            <!---->
            <div class="container">
                @foreach ($final_res as $key => $value)
                    <div class="box">
                        <h2>   {{ \App\Models\Patient::where('MRN', $value->MRN)->first()->name   }}</h2>
                        <p>Medical Record Number is {{ $value->MRN }}</p>
                        <span style="font-size: 20px;" class="diseaseName"> 
                            <!--- Count Number of diseases--->
                            <?php $numDiseases = Illuminate\Support\Facades\DB::table('patient-disease')->where('MRN', '=', $value->MRN)->count();  ?>
                            <?php $diseases = Illuminate\Support\Facades\DB::table('disease')
                                ->join('patient-disease', 'patient-disease.disease_id', '=', 'disease.disease_id')
                                ->where('patient-disease.MRN', '=', $value->MRN)->get();  ?>
                            @foreach($diseases as $key=>$disease)
                            {{$disease->disease_name}}
                            @if( $numDiseases > 1)
                            ,
                            @php
                            $numDiseases--;
                            @endphp
                            @endif
                            @endforeach
                        <span>/Patient</span>  </span>
                        <ul class="features">
                            <li>
                                @php
                                    $pressurestate= \DB::table('patient-vital-sign')->where('MRN' , '=', $value->MRN)->where('report' , '=', 'emergency')->orderBy('recorded_at' ,'desc')->first()->pressure_result ;
                                @endphp
                                @if( $pressurestate== "emergency")
                                <i class="fa-solid fa-xmark"></i>
                                @else
                                <i class="fa-solid fa-check"></i>
                                @endif
                                Blood Pressure:  
                                {{  \DB::table('patient-vital-sign')->where('MRN' , '=', $value->MRN)->where('report' , '=', 'emergency')->orderBy('recorded_at' ,'desc')->first()->systolic }} / {{ \DB::table('patient-vital-sign')->where('MRN' , '=', $value->MRN)->orderBy('recorded_at' ,'desc')->first()->diastolic }}
                                mmHg 

                            </li>
 
                            <li>
                                @php
                                    $gulcosestate= \DB::table('patient-vital-sign')->where('report' , '=', 'emergency')->where('MRN' , '=', $value->MRN)->orderBy('recorded_at' ,'desc')->first()->glucose_result ;
                                @endphp
                                @if( $gulcosestate== "emergency")
                                <i class="fa-solid fa-xmark"></i>
                                @else
                                <i class="fa-solid fa-check"></i>
                                @endif
                                Blood Glucose:                            
                                {{ \DB::table('patient-vital-sign')->where('MRN' , '=', $value->MRN)->where('report' , '=', 'emergency')->orderBy('recorded_at' ,'desc')->first()->glucose }}
                                mg/dL
 
                            </li>
                            <li >
                                @php
                                    $heart_result= \DB::table('patient-vital-sign')->where('MRN' , '=', $value->MRN)->where('report' , '=', 'emergency')->orderBy('recorded_at' ,'desc')->first()->heart_result ;
                                @endphp
                                @if( $heart_result== "emergency")
                                <i class="fa-solid fa-xmark"></i>
                                @else
                                <i class="fa-solid fa-check"></i>
                                @endif
                                Heart Rate :        
                                @if( $heart_result== "stable")
                                    <span style="color:black">Stable</span>
                                @elseif ($heart_result== "unstable")
                                    <span style="color:black">Unstable</span>
                                @else
                                    <span style="color:black">Emergency</span>
                                @endif
                            </li>
                            <li >
                                @php
                                    $oxygen_result= \DB::table('patient-vital-sign')->where('MRN' , '=', $value->MRN)->where('report' , '=', 'emergency')->orderBy('recorded_at' ,'desc')->first()->oxygen_result ;
                                @endphp
                                @if( $oxygen_result == "emergency")
                                <i class="fa-solid fa-xmark"></i>
                                @else
                                <i class="fa-solid fa-check"></i>
                                @endif
                                Oxygen Saturation :        
                                @if( $oxygen_result == "stable")
                                    <span style="color:black">Stable</span>
                                @elseif ($oxygen_result == "unstable")
                                    <span style="color:black">Unstable</span>
                                @else
                                    <span style="color:black">Emergency</span>
                                @endif
                            </li>
                         
                                  
                            <li><i class="fa-solid fa-user"></i> Relatives: 
                                @php
                                    $rel =   $rel=DB::table('relatives')->join('patient_relatives' , 'relatives.relative_id' , 'patient_relatives.relative_id')->where('patient_relatives.MRN', $value->MRN)->get();
                                @endphp
                                @foreach ( $rel as $key => $value )
                                    <li><i class="fa-solid fa-check"></i>{{ $value->name }}</li>                                    
                                @endforeach
                            </li>                      
                        </ul>
                        <a href="medicalrecord_Doctor/{{ $value->MRN }}">
                            <button>View Medical Record</button>
                        </a>
                    </div>
                @endforeach
                     
                
            </div>
        </main>
    </section>
    <script src="../js/DoctorJS/script.js"></script>
</body>

</html>
