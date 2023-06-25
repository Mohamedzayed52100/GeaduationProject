<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Request Lab</title>
    <link rel="icon" href="/PatientImages/assistance.png">
    <link rel="stylesheet" href="../PatientCSS/all.min.css" />
    <link rel="stylesheet" href="../css/Patientcss/framework.css" />
    <link rel="stylesheet" href="../css/Patientcss/master.css" />
    <link rel="stylesheet" href="../css/Patientcss/requestlab.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="../css/Patientcss/font-awesome.min.css">
    <link rel="stylesheet" href="../css/Patientcss/feathericon.min.css">

</head>

<!-- patient_request -->

<body>
    <div class="page d-flex">
        @include('patient_pages.components.sidebar')
        <div class="content w-full">
            <!-- Start Head -->
            @include('patient_pages.components.headWithNotification')

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="text-align: center; color :rgb(159, 55, 55)" >
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- End Head -->
            <h1 class="p-relative">Request Lab</h1>
            <h2 style="margin-left:340px; color:grey;">Please , Fill The Next Form To Complete The Reservation</h2>
            <div class="container">
                <div class="card">
                @if(session('successRequest'))
                    <div class="successRequest">
                         <strong>Success!</strong>  {{ session('successRequest') }}
                    </div>
                @endif
                @if(session('failRequest'))
                    <div class="failRequest">
                        <strong>Error!</strong>  {{ session('failRequest') }}
                    </div>
                @endif
                    <div class="card-body">
                        <div class="card-body">
                            <form action="/RequestLab" method="POST" class="requestform" enctype="multipart/form-data" autocomplete="off">
                            @csrf 
                                <input type="hidden" name="latiude" id="latiude" value="0">
                                <input type="hidden" name="longitude" id="longitude" value="0">
                                <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                                <input class="fname" type="text" id="fname" name="fname" readonly style="font-size: medium;" value="{{ session('patient_login')->name }}">
                                <label for="adr" style="display :block"><i class="fa fa-address-card-o"></i> Address <span style="color: red;">*</span></label>
                                <input class="adr" type="text" id="adr" name="adr" style="font-size: medium;" value="{{  session('patient_login')->street }} - {{ session('patient_login')->city}}">
                                <button onclick="getLocation();" class="btnLocation">Get Location</button>
                                <label for="lab">-- Select Laboratory Name <span style="color: red;">*</span></label>
                                <select id="lab" name="lab" class="form-control" required>
                                <?php $labs = \DB::table('labunit')->get();  ?>
                                <?php $id =1;  ?>
                                @foreach($labs  as $key=>$lab)
                                    <option value="{{$lab->lab_name}}" >{{$id}} - {{$lab->lab_name}}</option>
                                    <?php $id ++;  ?>
                                @endforeach  
                                </select>
                                <label for="type" style="display:block;"><i class="fa fa-flask" aria-hidden="true"></i> Select Test Type <span style="color: red;">*</span></label>
                                <!-- Test Name -->
                                <?php $Files = \DB::table('disease_test')->skip(0)->take(15)->get();  ?>
                                @foreach($Files  as $key=>$file)
                                    <label for="testName"><input type="checkbox" id="tests[]" name="tests[]" value="{{$file->test_name}}">  {{$file->test_name}}</label><br>
                                @endforeach  
                                <br><label for="test" style="font-size:15px">If you do not find your specific test in the pervious list , please write its name in the next box: <span style="color: grey;">(optional)</span></label>
                                <input class="form-control typeahead" type="text" id="test" name="test" style="font-size: medium;" placeholder="Write Your Test Name Here ..">
                                <br><br><label for="date"><i class="fa fa-calendar" aria-hidden="true"></i> Select Appointment Date <span style="color: red;">*</span></label>
                                <input class="date" type="date" id="date" name="date" required style="font-size: medium;"><br><br>
                                <p style="display: inline; margin-right:100px;"><b> Taking Any Medications Currently ?  If YES , Please List it : </b><span style="color: grey;">(optional)</span></p>
                                <textarea rows="5" cols="100" autofocus placeholder=" Write Here .." style=" resize: none; width:720px;" class="medication" name="medication"  id="medication" ></textarea>
    
                                <label for="icon-container"><i class="fa fa-check" aria-hidden="true"></i> <b>Accepted Cards</b> </label>
                                <i class="fa fa-cc-visa" style="color:navy; font-size: 24px; padding: 7px 0;"></i>
                                <i class="fa fa-cc-amex" style="color:blue;font-size: 24px; padding: 7px 0;"></i>
                                <i class="fa fa-cc-mastercard" style="color:red;font-size: 24px; padding: 7px 0;"></i>
                                <i class="fa fa-cc-discover" style="color:orange;font-size: 24px; padding: 7px 0;"></i><br>
                                <label><b>-- Select the Way to Pay </b> </label>
                                <select name="paymentWay" id="paymentWay" class="form-control" required>
                                    <option value="Cache">Cache</option>
                                    <option value="Online Payment">Online Payment</option>
                                </select>
                                <input type="submit" value="Book Now" class="btnsubmit">
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    //Prevent Previous dates
    $(function(){
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        var maxDate = year + '-' + month + '-' + day;
        $('#date').attr('min', maxDate);
    });
</script>


<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            console.log("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        //Send values of latiude and longitude to the inputs in form
        var Latitude = position.coords.latitude;
        var Longitude = position.coords.longitude;
        document.querySelector("#latiude").value = Latitude;
        document.querySelector("#longitude").value = Longitude;
        document.querySelector("#adr").value = "Updated using GPS";
        //Show the map with this location to the user
        window.open("/Map/"+Latitude+"/"+Longitude , "_blank");
           
    }
</script>

<!-- AutoComplete -->
<!-- jQuery & Typeahead.js -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"> </script>
<script>
    var path = "{{ route('search_test') }}";
    $('input.typeahead').typeahead({
        
        source: function(query, process) {
            return $.get(path, {
                query: query
            }, function(result) {
                return process(result);
            });
        }

    });
</script>

</body>

</html>
