@extends('lab_pages.Lab-main-template')

<!--Website Title-->
@section('title')
Al-Mokhtaber - Booked Appointments
@endsection


<!--Page Title-->
@section('pageTitle')
Booked Appointments
@endsection




<!--Website CSS-->
@section('css')
@parent
<link rel="stylesheet" href="/Lab_css/LabBookAppoint.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endsection


<!--Main Section-->
@section('main')



<!------ Alerts ------->
@if(session('success_alert'))
<div class="alert alert-success alert-dismissible fade show">
    <strong>Success!</strong> {{ session('success_alert') }}
</div>
@endif
@if(session('error_alert'))
<div class="alert alert-danger alert-dismissible fade show">
    <strong>Error!</strong> {{ session('error_alert') }}
</div>
@endif
@if(session('info_alert'))
<div class="alert alert-info alert-dismissible fade show">
    <strong>Important!</strong> {{ session('info_alert') }}
</div>
@endif
@if(session('warning_alert'))
<div class="alert alert-warning alert-dismissible fade show">
    <strong>Warning!</strong> {{ session('warning_alert') }}
</div>
@endif
<!------ /Alerts ------->



<!------ Calendar ------->
<div class="containerCalendar">
    <div id="Calendar" style="font-family:Ubuntu; font-size:15px;"></div>
</div>
<!------ /Calendar ------->




<!------ Form ------>
<h3 style="font-family:Lora; text-align:center; color:#3a87ad;">Today's Appointments</h3>
<div class="row">
    <div class="containerForm">
        <form action="/AcceptBookedAppointment" action="POST">
            @csrf
            @if(count($todayBooked) ==0)
            <p style="color:red; font-size:12px; text-align:center; margin-top:10px; ">No appointments are booked today</p>
            @endif
            @foreach($todayBooked as $key=>$book)
            <div class="row">
                <div class="col-50">
                    <input class="appointment_id" type="hidden" id="appointment_id" name="appointment_id" value="{{$book->appointment_id}}">
                    <h4 style="font-family:Lora; font-weight:bold;">Patient Info</h4>
                    <label for="Pmrn"><i class="fa fa-list-ol"></i> MRN</label>
                    <input class="Pmrn" type="text" id="Pmrn" name="Pmrn" value="{{$book->MRN}}" readonly>
                    <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                    <input class="fname" type="text" id="fname" name="firstname" value="{{$book->name}}" readonly>
                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                    <input class="email" type="text" id="email" name="email" value="{{$book->email}}" readonly>
                    <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                    <input class="adr" type="text" id="adr" name="address" value="{{$book->street}} , {{$book->city}}" readonly>
                    <label for="phone"><i class="fa fa-phone"></i>Phone</label>
                    <input class="phone" type="text" id="phone" name="phone" value="{{$book->phone}}" readonly>
                    <label for="type"><i class="fa fa-flask" aria-hidden="true"></i>Selected Tests</label>
                    <?php $Files = Illuminate\Support\Facades\DB::table('lab_result')
                        ->join('disease_test', 'disease_test.test_id', '=', 'lab_result.test_id')
                        ->where('appointment_id', '=', $book->appointment_id)->get();
                    ?>
                    <ul>
                        @foreach($Files as $file)
                        <li>{{$file->test_name}}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-50">
                    <h4 style="font-family:Lora; font-weight:bold;">Payment</h4>
                    <label for="fname"><i class="fa fa-check" aria-hidden="true"></i> Accepted Cards</label>
                    <div class="icon-container">
                        <i class="fa fa-cc-visa" style="color:navy;"></i>
                        <i class="fa fa-cc-amex" style="color:blue;"></i>
                        <i class="fa fa-cc-mastercard" style="color:red;"></i>
                        <i class="fa fa-cc-discover" style="color:orange;"></i>
                    </div>
                    <label for="pay"><i class="fa fa-money" aria-hidden="true"></i>Pay By</label>
                    <input class="pay" type="text" id="pay" name="pay" value="{{$book->payment_way}}" readonly style="margin-right:26px;">
                    <label for="cost"></i>Total Cost</label>
                    <input class="cost" type="text" id="cost" name="cost" value="{{$book->payment}} EGP" readonly>
                    <label for="payStatus"></i>Payment Status</label>
                    <input class="payStatus" type="text" id="payStatus" name="payStatus" value="{{$book->payment_status}}" readonly>
                    <label for="id"><i class="fa fa-user-md" aria-hidden="true"></i>Laboratory Physician ID</label>
                    <input class="id" type="text" id="id" name="id" placeholder="Write Here .." required>
                    <label for="date"><i class="fa fa-calendar" aria-hidden="true"></i>Due Date</label>
                    <input class="date" type="date" id="date" name="date" required>
                </div>
            </div>
            <label style="width:100%"><input type="checkbox" class="" checked name="checked"> Successful Payment Completed </label>
            <button class="btnsubmit">Submit</button>
            <button class="btnEdit" data-bs-toggle="modal" data-bs-target="#editModal" data-appointment_id="{{ $book->appointment_id }}">Edit</button>
            @endforeach
        </form>
    </div>
    <div style="margin-left:240px;">
        @if($todayBooked instanceof \Illuminate\Pagination\AbstractPaginator )
        {{ $todayBooked->links('lab_pages.LabCustomPagination') }}
        @endif
    </div>
</div>

<!----------------------------- The Edit Modal ----------------------------->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="font-family: ubuntu;">Edit </h4>
                <button type="button" class="btn-close" title="Close" data-bs-dismiss="modal" style="border:transparent; background-color:transparent;"><span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <label for="testName" style="margin-top:20px; font-weight:bold; font-family:Lora; display:block; color:black;">Select Test Name:</label>
                <form method="POST" action="/LabBookedAppointment/edit" class="Edit-Form" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <?php $Files = Illuminate\Support\Facades\DB::table('disease_test')->skip(0)->take(10)->get();  ?>
                    @foreach($Files as $key=>$file)
                    <label for="testName"><input type="checkbox" id="tests[]" name="tests[]" value="{{$file->test_name}}"> {{$file->test_name}}</label><br>
                    @endforeach
                    <br><label for="test" style="font-size:15px; font-family:Lora;"><b>If you do not find the test in the pervious list , please write its name in the next box:</b> <span style="color: grey;">(optional)</span></label>

                    <input class="form-control typeahead" type="text" id="test" name="test" style="font-size: medium;" placeholder="Write Your Test Name Here ..">
                    <input type="hidden" name="appointment_id" id="appointment_id" value="">
                    <br><br><button type="submit" class="btn btn-success">Edit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!----- Add New Appointment Modal ------>
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Appointment</h5>
                <button type="button" class="btn-close" title="Close" data-bs-dismiss="modal" style="border:transparent; background-color:transparent;"><span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <label for="name" style="font-weight:bold; font-family:Lora;"></i><span style="color: red;">*</span> Select Patient Name:</label>
                <select name="patient" id="patient" class="form-control" required>
                    <?php $Users = Illuminate\Support\Facades\DB::table('patient')->get();  ?>
                    <?php $id = 1;  ?>
                    @foreach($Users as $key=>$user)
                    <option value="{{$user->name}}">{{$id}} - {{$user->name}}</option>
                    <?php $id++;  ?>
                    @endforeach
                </select>
                <label style="margin-top:15px; font-weight:bold; font-family:Lora; width:100%;"><span style="color: red;">*</span> Select Test Name:</label>
                <?php $Files = Illuminate\Support\Facades\DB::table('disease_test')->skip(0)->take(10)->get();  ?>
                @foreach($Files as $key=>$file)
                <label><input type="checkbox" id="tests[]" name="tests[]" value="{{$file->test_name}}"> {{$file->test_name}}</label><br>
                @endforeach

                <br><label for="test" style="font-size:15px; font-family:Lora;"><b>If you do not find the test in the pervious list , please write its name in the next box:</b> <span style="color: grey;">(optional)</span></label>
                <input class="form-control typeahead" type="text" id="testInput" name="testInput" style="font-size: medium;" placeholder="Write Your Test Name Here ..">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveBtn" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection


@section('customJS')
<!----------------------------------------------------         Calender         ---------------------------------------------------->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var booking = @json($events);


        //customize calendar shape
        $('#Calendar').fullCalendar({
            header: {
                left: 'prev, next today',
                center: 'title',
                right: 'month, agendaWeek, agendaDay',

            },
            events: booking,
            //enable that you can click on calendar and select any date
            selectable: true,
            selectHelper: true,
            defaultView: 'month',
            select: function(start, end, allDays) {
                //Disable previous dates
                var check = start.format("YYYY-MM-DD");
                var today = moment().format("YYYY-MM-DD");
                if (check < today) {
                    // Previous Day. So it will be unselectable
                    swal("Oops!", "You cannot book appointment in previous dates!", "warning");
                } else {
                    // Its a right date    
                    $('#bookingModal').modal('toggle');

                    //Add New Appointment
                    //Read data and send it to controller to save it in DB
                    $('#saveBtn').click(function() {
                        var patient = $('#patient').val();
                        //tests from checkbox
                        var Test = new Array();
                        $("input:checked").each(function() {
                            Test.push($(this).val());
                        });
                        //tests from input
                        var test_name = $('#testInput').val();


                        if (Test.length == 0 && $('#testInput').val().length == 0) {
                            alert("Please choose the test name");
                        } else if (Test.length == 0 && $('#testInput').val().length != 0) {
                            Test.push('No test');
                        } else if (Test.length != 0 && $('#testInput').val().length == 0) {
                            test_name = 'No test';
                        } else {}

                        var start_date = moment(start).format('YYYY-MM-DD');
                        var end_date = moment(end).format('YYYY-MM-DD');
                        $.ajax({
                            url: "{{ route('Add.Appointment') }}",
                            type: "POST",
                            dataType: 'json',
                            data: {
                                patient,
                                start_date,
                                end_date,
                                Test,
                                test_name
                            },
                            success: function(response) {
                                $('#bookingModal').modal('hide');
                                location.reload();
                                swal("Success!", "This appointment has been successfully booked!", "success");
                            },
                            error: function(error) {
                                if (error.responseJSON.errors) {
                                    console.log(error)
                                }
                            },
                        });
                    });
                }
            },




            //enable that you can move any appointment date from place to another place on calendar(drap & drop)
            editable: true,
            eventDrop: function(event) {
                var id = event.id;
                var start_date = moment(event.start).format('YYYY-MM-DD');
                var end_date = moment(event.end).format('YYYY-MM-DD');
                //Disable previous dates
                var today = moment().format("YYYY-MM-DD");
                if (start_date < today) {
                    swal("Warning!", "You cannot update appointment's date to previous one!", "warning");
                    location.reload();
                } else {
                    $.ajax({
                        url: "{{ route('Update.Appointment', '') }}" + '/' + id,
                        type: "PATCH",
                        dataType: 'json',
                        data: {
                            start_date,
                            end_date
                        },
                        success: function(response) {
                            console.log(response)
                            location.reload();
                            swal("Success!", "This appointment Date has been successfully updated!", "success");
                        },
                        error: function(error) {
                            console.log(error)
                        },
                    });
                }
            },



            //enable that you can delete any appointment from calendar by clicking on it
            eventClick: function(event) {
                var id = event.id;
                swal({
                    title: "Are you sure that you want to delete this appointment?",
                    text: "Once deleted, you will not be able to recover this!",
                    icon: "warning",
                    buttons: [true, "Delete"],
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ route('Delete.Appointment', '') }}" + '/' + id,
                            type: "DELETE",
                            dataType: 'json',
                            success: function(response) {
                                var id = response
                                console.log(id);
                                $('#Calendar').fullCalendar('removeEvents', response);
                                swal("Success!", "This appointment has been successfully deleted!", "success");
                                location.reload();
                            },
                            error: function(error) {
                                console.log(error)
                            },
                        });
                    }
                });
            },



            //Disabled long event within multiple days
            selectAllow: function(event) {
                return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
            },



        });

        //Prevent duplicate events
        $("#bookingModal").on("hidden.bs.modal", function() {
            $('#saveBtn').unbind();
        });



    });
</script>

<!----------------------------------------------------        /Calender         ---------------------------------------------------->

<script>
    //Make checkbox unchecked
    var inputs = document.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type == 'checkbox') {
            inputs[i].checked = false;
        }
    }
</script>


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

<!--Edit Modal-->
<script type="text/javascript">
    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var appointment_id = button.data('appointment_id')
        var modal = $(this)
        modal.find('.modal-body #appointment_id').val(appointment_id);

    })
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == document.getElementById('editModal')) {
            model.style.display = "none";
        }
    }
</script>


<!-- AutoComplete -->
<!-- jQuery & Typeahead.js -->
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


@endsection