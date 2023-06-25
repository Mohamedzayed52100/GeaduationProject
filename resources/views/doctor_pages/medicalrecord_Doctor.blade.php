<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- FontAwesome -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- My CSS -->
    <link rel="stylesheet" href="../css/DoctorCss/style.css">
    

    <title>Patient Medical Record</title>

   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <style>
        .mess{
           font-size:95px;
        }
    </style>

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
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Patient Medical Record</a>
                        </li>
                    </ul>
                </div>
            </div>



            <div class="formbold-main-wrapper">

                <div class="formbold-form-wrapper">

                    <img src="{{ asset('PatientImages') }}/{{ $PatientData->patient_image }}">

                    <form action="/medicalrecord_Doctor_submit" method="POST">
                        @csrf

                        <input type="hidden" name="patient_id" id="id" class="formbold-form-input" value="{{$patient_id }}" readonly />
                        <input type="hidden" name="doctor_id" id="id" class="formbold-form-input" value="{{ session('doctorid') }}" readonly />
                        
                        <div class="formbold-form-title"><h2>{{ $PatientData->name }}</h2> </div>

                        <div class="formbold-input-flex">
                            <div>
                                <label for="sex" class="formbold-form-label">Sex</label>
                                <input type="text" name="sex" id="s" class="formbold-form-input" value="{{ $PatientData->sex }}" readonly />
                            </div>
                            <div>
                                <label for="age" class="formbold-form-label"> Age </label>
                                <input type="text" name="age" id="age" class="formbold-form-input"value="{{ $patient_age }}" readonly />
                            </div>
                        </div>

                        <div class="formbold-input-flex">
                            <div>
                                <label for="status" class="formbold-form-label"> Status </label>
                                @if($VitalData)
                                    <input type="text" name="status" id="status" class="formbold-form-input" value="{{ $VitalData->report }}" readonly />
                                @else
                                    <input type="text" name="status" id="status" class="formbold-form-input" value="--" readonly />
                                @endif
                                </div>
                            <div>
                                <label for="dept" class="formbold-form-label"> Disease </label>
                                <input type="text" name="disease" id="disease" class="formbold-form-input" value="{{$alldiseases}}" readonly />
                            </div>
                        </div>

                        <ul class="box-info2">
                            <li>
                                <i class='fa fa-heartbeat'></i>
                                <span class="text">
                                    <h3> Blood Glucose</h3>
                                    @if($VitalData)
                                        <p>{{ $VitalData->glucose }} mg/dL</p>
                                    @else
                                        <p>--</p>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <i class="fas fa-kit-medical"></i>
                                <span class="text">
                                    <h3>Blood Pressure</h3>
                                    @if($VitalData)
                                        <p>{{ $VitalData->systolic }} / {{ $VitalData->diastolic }} mmHg</p>
                                    @else
                                        <p>--</p>
                                    @endif
                                </span>
                            </li>

                            <li style="width: 720px; height:370px; text-align:center ;" >
                                 
                                <span class="text">
                                    <h3 class="mess" >Oxygen Saturation and Heart Rate </h3>
                                    @if (count($readings) > 0)
                                        <div id="chart_div" style="width: 650px; height: 290px"></div>
                                    @else
                                       <div style="width: 650px; margin-top:70px; font-size:30px">No Data Available</div>
                                    @endif
                                </span>
                            </li>
                        </ul>

                        <div class="formbold-mb-3">
                            <label for="chief_complaint" class="formbold-form-label">Chief Complaint </label>
                            <textarea rows="3" name="chief_complaint" id="chief_complaint" class="formbold-form-input" readonly>{{ $data_complaint->chief_complaint }}</textarea>
                        </div>

                        <div class="formbold-input-flex">
                            <div>
                                <label for="surgery" class="formbold-form-label">Previous Surgeries </label>
                                <input type="text" name="previous_surgeries" id="previous_surgeries" class="formbold-form-input"
                                    value="{{  $data_complaint->previous_surgeries }}" readonly />
                            </div>
                            <div>
                                <label for="symptoms" class="formbold-form-label">Medication Allergies</label>
                                <input type="text" name="medication_allergies" id="medication_allergies" class="formbold-form-input"
                                    value="{{  $data_complaint->medication_allergies }}" readonly />
                            </div>
                        </div>

                        <div class="formbold-input-flex">
                            <div class="formbold-mb-3" style="width: 720px;">
                                <label for="medecation" class="formbold-form-label">Current Medications</label>
                                <input type="text" name="current_medications" id="current_medications" class="formbold-form-input"
                                value="{{  $data_complaint->current_medications }}" readonly />
                            </div>
                        </div>

                        <div class="formbold-mb-3">
                            <label for="message" class="formbold-form-label">Medicine Side Effects </label>
                            @if ($VitalData)
                                <textarea rows="4" name="notes" id="notes" class="formbold-form-input" readonly>{{  $VitalData->effects }}</textarea>
                            @else
                                <textarea rows="4" name="notes" id="notes" class="formbold-form-input" readonly>No Data Inserted Yet</textarea>
                            @endif                        
                        </div>
                        <div class="formbold-mb-3">
                            <label for="message" class="formbold-form-label">Symptoms Appearing On Patient </label>
                            @if ($VitalData)
                                <textarea rows="4" name="notes" id="notes" class="formbold-form-input" readonly>{{  $VitalData->symptoms }}</textarea>
                            @else
                                <textarea rows="4" name="notes" id="notes" class="formbold-form-input" readonly>No Data Inserted Yet</textarea>
                            @endif                        
                        </div>

                        <div class="formbold-mb-3">
                            <label for="message" class="formbold-form-label">Lab Results</label>
                            @if (count($Lab_result)>0)
                                <div class="formbold-form-input">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0" >
                                            <thead>
                                                <tr style="color:#0e318f;font-family: Sans-serif;">
                                                    <th>Test Name</th>
                                                    <th style="text-align:center;">Test File</th>
                                                    <th style="text-align:center;">Upload Date</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($Lab_result as $key=>$test)
                                                    <tr>
                                                        <td style="width:430px;">{{$test->test_name}}</td> 
                                                        <td style="text-align:center; width:110px;"> 
                                                            <a href="{{ url('/viewImage',['file' => $test->image_name] ) }}" target="_blank"><button type="button" class="buttonView">View</button></a>
                                                        </td> 
                                                        <td>
                                                        @php
                                                            $appointmentDate = new DateTime( $test->upload_date);
                                                            @endphp
                                                        {{$appointmentDate->format('Y-m-d')}}
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="margin-left:150px;">
                                        @if($Lab_result instanceof \Illuminate\Pagination\AbstractPaginator )
                                            {{ $Lab_result->links('relative_pages.Relative_pagination') }} 
                                        @endif  
                                    </div>
                                </div>
                            @else
                                <textarea rows="4" name="notes" id="notes" class="formbold-form-input" readonly>No Tests Available</textarea>
                            @endif                        
                        </div>
                        <div class="formbold-mb-3">
                            <label for="message" class="formbold-form-label">Last Visit Notes </label>
                            <textarea rows="4" name="notes" id="notes" class="formbold-form-input" readonly>{{  $data_complaint->notes }}</textarea>
                        </div>

                        <div class="formbold-mb-3">
                            <label for="newnotes" class="formbold-form-label">Doctor Notes </label>
                            <textarea rows="6" name="newnotes" id="newnotes" class="formbold-form-input"></textarea>
                            @error('newnotes')
                                <p style="color:red;text-align:center;margin-top:20px;">{{ $message }}</p>
                            @enderror
                        </div>
                            <a href="/chatify/{{ \App\Models\User::where('email', $PatientData->email)->first()->id }}"
                                class="formbold-btn chaifybtn" style="margin-left:132px">Send Message</a>

                            <button class="formbold-btn" style="font-weight:bold; width:180px">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </section>
    <script src="../js/DoctorJS/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>

    @if(Session::has('newnotes'))
    <script>
        swal("Geart Job!","{!! Session::get('newnotes') !!}",{
        button:"OK",
        })
    </script>
    @endif

<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $chartDataJson; ?>);

        var options = {
            title: 'Sensor Data Readings',
            curveType: 'function',
            legend: { position: 'bottom' },
            series: {
                0: { color: '#e2431e' }, // Systolic color
                1: { color: '#6f9654' }  // Diastolic color
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>


</body>

</html>
