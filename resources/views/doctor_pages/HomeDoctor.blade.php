<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="../css/DoctorCss/style.css">

    <title>Doctor Dashboard</title>

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

        <!-- MAIN -->
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
                            <a class="active" href="#">Home</a>
                        </li>
                    </ul>
                </div>

            </div>

            <ul class="box-info">
                <li>
                    <i class='bx bxs-badge-check'></i>

                    <span class="text">
						<h3>Stable Cases</h3>
						<p>{{ $dataTodaystable }}</p>
					</span>
                </li>
                <li>
                    <i class='bx bxs-calendar-exclamation'></i>
                    <span class="text">
						<h3>Unstable Cases</h3>
						<p>{{ $dataTodayunstable }}</p>
					</span>
                </li>

                <li>
                    <i class='bx bxs-alarm-exclamation'></i>
                    <span class="text">
						<h3> Emergency</h3>
						<p>{{ $dataTodayemergency }}</p>
					</span>
                </li>

            </ul>
            <!--chart-->
            <div class="charts" style="display: flex; justify-content: space-between;">
                <div id="cases-chart" style="width: 600px; height: 500px;"></div>
                <div id="cases-pie-chart" style="width: 600px; height: 400px;"></div>
            </div>
            <!--Table-->

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Unstable Cases</h3>
                        <i href="#" class='bx'>View All</i>
                        <i class='bx bx-filter'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Disease</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($table_show_unstable as $key => $value)
                            @php
                                $patient_name =\App\Models\Patient::where('MRN' , $value->MRN)->first();
                            @endphp
                            <tr>
                                <td>
                                    <img src="{{ asset('images') }}/{{ $patient->patient_image }}">
                                    <p>{{ $patient_name->name  }}</p>
                                </td>
                                <td><span class="Disease">{{ $value->name }}</span></td>
                                <td><span class="status completed">{{ $value->report }}</span></td>
                                <td>
                                    <a href="/medicalrecord_Doctor/{{ $value->MRN }}">
                                        <button class="button button1">View</button></td>
                                </a>
                            </tr>
                            @endforeach
                             
                        </tbody>
                    </table>
                </div>
            </div>
            <!--Zoom Table-->
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Zoom Meeting</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Topic</th>
                                <th>Start at</th>
                                <th>Duration</th>
                                <th>Patients</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($zoom_data_id as $key => $value)
                             <tr>
                                <td><span style="margin-top:12px">{{ \DB::table('zoom')->where('primary_id' , $value->primary_id)->first()->topic  }}</span></td>
                                <td><span>{{\DB::table('zoom')->where('primary_id' , $value->primary_id)->first()->start_at }}</span></td>
                                <td><span class="status completed">{{ \DB::table('zoom')->where('primary_id' , $value->primary_id)->first()->duration }}</span></td>
                                <td>                                              
                                    @php
                                        $imgdata= \DB::table('zoompatient')->join('patient' , 'zoompatient.patient_id' ,'patient.MRN')->where('zoompatient.zoom_id' , $value->primary_id)->get();                      
                                    @endphp
                                    @foreach ( $imgdata as $key =>$imagedata )
                                        <a href="/medicalrecord_Doctor/{{$imagedata->MRN}}">
                                            <span title="{{$imagedata->name  }}" style="width:90px; border-radius: 50%;" ><img  src="{{ asset('PatientImages') }}/{{ $imagedata->patient_image }}"></span>
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{\DB::table('zoom')->where('primary_id' , $value->primary_id)->first()->start_url}}">
                                        <button class="button button1">Start</button></td>
                                </a>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
         

        </main>
        <!-- MAIN -->
        <!-- </section> -->
        <!-- CONTENT -->


    <script src="../js/DoctorJS/script.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Period', 'Stable', 'Unstable', 'Emergency'],
                ['Today', {{ $dataTodaystable}}, {{ $dataTodayunstable }}, {{ $dataTodayemergency }}] , 

                ['Yesterday', {{ $dataYesterdaystable }}, {{ $dataYesterdayunstable }}, {{ $dataYesterdayemergency }}],

                ['Last Week', {{ $dataLastWeekstable }}, {{ $dataLastWeekunstable }}, {{ $dataLastWeekemergency }}],
            ]);

            var options = {
                chart: {
                    title: 'Cases by Status and Period',
                    subtitle: ' Today , Yesterday and Last Week ',
                },
                bars: 'vertical',
                vAxis: {format: 'decimal'},
                height: 400,
                colors: ['#3366CC', '#FF9900','#DC3912'],
                legend: {position: 'top', maxLines: 3},
            };

            var chart = new google.charts.Bar(document.getElementById('cases-chart'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Category', 'Cases', { role: 'style' }],
                ['Stable', {{ $dataTodaystable }}, 'color: #3366cc'],
                ['Unstable', {{ $dataTodayunstable }}, 'color: orange'],
                ['Emergency', {{ $dataTodayemergency }}, 'color: #DC3912']
            ]);

            var options = {
                title: 'Cases by Category',
                is3D: true,
                slices: {
                    0: { color: '#3366cc' },
                    1: { color: 'orange' },
                    2: { color: '#DC3912' }
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('cases-pie-chart'));
            chart.draw(data, options);
        }
    </script>

</body>

</html>
