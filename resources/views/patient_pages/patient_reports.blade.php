<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reports</title>
    <link rel="icon" href="/PatientImages/assistance.png">
    <link rel="stylesheet" href="../PatientCSS/all.min.css" />
    <link rel="stylesheet" href="../css/Patientcss/framework.css" />
    <link rel="stylesheet" href="../css/Patientcss/master.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />

    <style>
        .plan{
            border-radius:25px;
        }
        .availability{
            text-align: center;
        }
        #cases-pie-chart , #chart_div , #chart_div2 , #chart_div3{
            height: 340px;
        }
        #testtable {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 1170px;
            margin-left:60px;
            margin-top:30px;
        }

        #testtable td, #testtable th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #testtable tr:nth-child(even){background-color: #f2f2f2;}

        #testtable tr:hover {background-color: #ddd;}

        #testtable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color:#1e90ff;
            color: white;
        }
        .buttonView{
            border: none;
            color: var(--blue);
            padding: 2px 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 20px;
            font-style: bold;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }
    </style>


</head>


<!-- patient_reports -->

<body>
    <div class="page d-flex">
        @include('patient_pages.components.sidebar')
        <div class="content w-full">
            <!-- Start Head -->
            @include('patient_pages.components.headWithNotification')
            <!-- end Head -->

            <h1 class="p-relative">Reports</h1>
            <div class="plans-page d-grid m-20 gap-20">
                <div class="plan blue bg-white p-20"  >
                    @if($unstable >0 ||  $stable >0 ||  $emergency >0)
                        <div id="cases-pie-chart"></div>
                    @else 
                        <h3 class="availability">No Data Available For You Now </h3>
                    @endif
                </div>

                <div class="plan blue bg-white p-20">
                    @if (count($readings) > 0)
                        <div id="chart_div" ></div>
                    @else 
                        <h3 class="availability">No Data Available For You Now </h3>
                    @endif
                </div>

                <div class="plan blue bg-white p-20">
                    @if (count($readings2) > 0)
                        <div id="chart_div2" ></div>
                    @else 
                        <h3 class="availability">No Data Available For You Now </h3>
                    @endif
                </div>
               
                <div class="plan blue bg-white p-20">
                    @if (count($readings3) > 0)
                        <div id="chart_div3"  ></div>
                    @else 
                        <h3 class="availability">No Data Available For You Now </h3>
                    @endif
                </div>
                <div style="width:1280px; background-color:white;">
                <h1 class="p-relative">Lab Results</h1>
                @if(count($Lab_result)>0)
                <table id="testtable" >
                    <tr>
                        <th>#</th>
                        <th>Test Name</th>
                        <th>Test File</th>
                        <th>Upload Date</th>

                    </tr>
                    @foreach ( $Lab_result as $key => $value )
                        <tr>
                            <td>{{ $loop->iteration	 }}</td>
                            <td>{{ $value->test_name }}</td>
                            <td>
                                <a href="{{ url('/viewImage',['file' => $value->image_name] ) }}" target="_blank"><button type="button" class="buttonView">View</button></a>
                            </td>
                            <td>{{ $value->upload_date }}</td>
                        </tr>
                    @endforeach
                </table>
                @else
                    <p style="text-align:center; font-size:30px;">No Tests Available</p>
                @endif 
            <div style="margin-left:490px; margin-bottom:20px;margin-top:10px;">
                @if($Lab_result instanceof \Illuminate\Pagination\AbstractPaginator )
                    {{ $Lab_result->links('relative_pages.Relative_pagination') }} 
                @endif  
            </div>
        </div>
        
        </div>
    </div>                      
                

</body>

                               
</html>

            </div>
        </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!--Pie Chart-->
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Category', 'Cases', { role: 'style' }],
                ['Stable', {{ $stable }}, 'color: green'],
                ['Unstable', {{ $unstable }}, 'color: orange'],
                ['Emergency', {{ $emergency }}, 'color: red']
            ]);

            var options = {
                title: 'Cases by Category',
                is3D: true,
                slices: {
                    0: { color: 'green' },
                    1: { color: 'orange' },
                    2: { color: 'red' }
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('cases-pie-chart'));
            chart.draw(data, options);
        }
    </script>

    <!--/Pie Chart-->

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
                0: { color: '#e2431e' }, 
                1: { color: '#6f9654' }  
            }
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

 
<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $chartDataJson2; ?>);

        var options = {
            title: 'Blood Pressure Readings',
            curveType: 'function',
            legend: { position: 'bottom' },
            series: {
                0: { color: '#e2431e' }, 
                1: { color: '#6f9654' }  
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
    }
</script>


<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $chartDataJson3; ?>);

        var options = {
            title: 'Blood Glucose Readings',
            curveType: 'function',
            legend: { position: 'bottom' },
            series: {
                0: { color: '#e2431e' }
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
    }
</script>


 
</body>

 

</html>
