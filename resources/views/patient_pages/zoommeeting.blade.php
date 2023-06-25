<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Zoom Meeting</title>
    <link rel="stylesheet" href="../PatientCSS/all.min.css" />
    <link rel="stylesheet" href="../css/Patientcss/framework.css" />
    <link rel="stylesheet" href="../css/Patientcss/master.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />

    <style>
        #zoomtable {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 1170px;
        }

        #zoomtable td, #zoomtable th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #zoomtable tr:nth-child(even){background-color: #f2f2f2;}

        #zoomtable tr:hover {background-color: #ddd;}

        #zoomtable th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color:#1e90ff;
        color: white;
        }
    </style>

</head>

<!-- patient_profile -->

<body>
    <div class="page d-flex">
        @include('patient_pages.components.sidebar')
        <div class="content w-full">
            <!-- Start Head -->
            @include('patient_pages.components.headWithNotification')
            @section('notification')
            @parent
            @endsection
            <!-- End Head -->
            <h1 class="p-relative">Zoom meeting</h1>
            <div class="profile-page m-20">
              <div class="other-data d-flex gap-20">
                <div class="activities p-20 bg-white rad-10 mt-20">
                  <div class="targets p-20 bg-white rad-10">
                    <div class="content w-full">
                      <div class="settings-page m-20 d-grid gap-20">
                        <table id="zoomtable">
                          <tr>
                            <th>#</th>
                            <th>Doctor name</th>
                            <th>Topic</th>
                            <th>Start at</th>
                            <th>Duration</th>
                            <th>Meeting Password</th>
                            <th>Join meeting</th>
                          </tr>
                          @foreach ( $zoomdata as $key => $value )
                            <tr>
                              <td>{{ $loop->iteration	 }}</td>
                              <td>{{  \DB::table('doctor')->where('doctor_id', $value->doctor_id)->first()->name  }}</td>
                              <td>{{ $value->topic }}</td>
                              <td>{{ $value->start_at }}</td>
                              <td>{{ $value->duration }}</td>
                              <td>{{ $value->password }}</td>
                              <td>  <a href="{{  $value->join_url }}">Join Zoom Meeting</a></td>                                       
                            </tr>
                          @endforeach
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Other Data -->
            </div>
          </div>
        </div>

</body>

                               
</html>
