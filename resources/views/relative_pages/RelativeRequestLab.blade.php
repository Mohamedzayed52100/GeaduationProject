@extends('relative_pages.main_template_relative')
@section('main')



    <div class="home-content">
        @if(session('success'))<div class="success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Awsoume! </strong>{{ session('success') }}
        </div>@endif
        @if(session('error'))<div class="erroralert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{ session('error') }}
        </div>@endif
        
        <h2>Please , Fill The Next Form To Complete The Reservation</h2>
        <div class="container">
            <div class="card">
                <!------ Alerts ------->
                @if(session('successRequest'))
                <div class="successRequest">
                    <strong>Success!</strong> {{ session('successRequest') }}
                </div>
                @endif
                @if(session('failRequest'))
                <div class="failRequest">
                    <strong>Error!</strong> {{ session('failRequest') }}
                </div>
                @endif
                <!------ /Alerts ------->
                <div class="card-body">
                    <form action="/LabRequest" method="POST" class="requestform" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <input type="hidden" name="latiude" id="latiude" value="0">
                        <input type="hidden" name="longitude" id="longitude" value="0">
                        <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                        @foreach($selected_patient as $patient_name)
                        <input class="fname" type="text" id="fname" name="fname" readonly style="font-size: medium;" value="{{$patient_name->name}}">
                        @endforeach
                        <label for="adr" style="display :block"><i class="fa fa-address-card-o"></i> Address <span style="color: red;">*</span></label>
                        <input class="adr" type="text" id="adr" name="adr" style="font-size: medium;" value="Benha , Egypt">
                        <button onclick="getLocation();" class="btnLocation">Get Location</button>
                        <label for="lab">-- Select Laboratory Name <span style="color: red;">*</span></label>
                        <select id="lab" name="lab" class="form-control" required>
                            <?php $labs = Illuminate\Support\Facades\DB::table('labunit')->get();  ?>
                            <?php $id = 1;  ?>
                            @foreach($labs as $key=>$lab)
                            <option value="{{$lab->lab_name}}">{{$id}} - {{$lab->lab_name}}</option>
                            <?php $id++;  ?>
                            @endforeach
                        </select>
                        <label for="type" style="display:block;"><i class="fa fa-flask" aria-hidden="true"></i>
                            Select Test Type <span style="color: red;">*</span></label>
                        <!-- Test Name -->
                        <?php $Files = Illuminate\Support\Facades\DB::table('disease_test')->skip(0)->take(15)->get();  ?>
                        @foreach($Files as $key=>$file)
                        <label for="testName"><input type="checkbox" id="tests[]" name="tests[]" value="{{$file->test_name}}"> {{$file->test_name}}</label><br>
                        @endforeach
                        <br><label for="test" style="font-size:15px">If you do not find your specific test in the
                            pervious list , please write its name in the next box: <span style="color: grey;">(optional)</span></label>
                        <input class="form-control typeahead" type="text" id="test" name="test" style="font-size: medium;" placeholder="Write Your Test Name Here ..">
                        <br><br><label for="date"><i class="fa fa-calendar" aria-hidden="true"></i> Select
                            Appointment Date <span style="color: red;">*</span></label>
                        <input class="date" type="date" id="date" name="date" required style="font-size: medium;"><br><br>
                        <p style="display: inline; margin-right:100px;"><b> Taking Any Medications Currently ? If
                                YES , Please List it : </b><span style="color: grey;">(optional)</span></p>
                        <textarea rows="5" cols="100" autofocus placeholder=" Write Here .." style=" resize: none;" class="medication" name="medication" id="medication"></textarea>

                        <label for="icon-container"><i class="fa fa-check" aria-hidden="true"></i> <b>Accepted
                                Cards</b> </label>
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


    <!------------- Request lab ------------------>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        //Prevent Previous dates
        $(function() {
            var dtToday = new Date();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
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
            window.open("/Maps/" + Latitude + "/" + Longitude, "_blank");

        }
    </script>

    <!-- AutoComplete -->
    <!-- jQuery & Typeahead.js -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"> </script>
    <script>
        var path = "{{ route('search_tests') }}";
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


@endsection