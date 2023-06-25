@extends('lab_pages.Lab-main-template')
<!--Website Title-->
@section('title')
{{session('labName')}} - Dashboard
@endsection

<!--Page Title-->
@section('pageTitle')
Dashboard
@endsection

<!--Welcome back-->
@section('Welcomepage')
@if(session('success_message'))
<p class="page-title" style="color: greenyellow;">{{ session('success_message') }}</p>
@endif
@endsection


<!--Main Section-->
@section('main')
<!------ Page Cards ------->
<div class="row">
    <!-------- Number of new requests --------->
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon "><i class="fa fa-spinner fa-spin" style="color:  #000000;"></i></span>
                    <div class="dash-count">
                        <h3>{{count($new_request)}}</h3>
                        <div class="dash-widget-info">
                            <h6 class="textmuted">New Requests</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-------- Number of today's required appointments -------->
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon "><i class="fa fa-users"></i></span>
                    <div class="dash-count">
                        <h3>{{count($appointments)}}</h3>
                        <div class="dash-widget-info">
                            <h6 class="textmuted">Booked Appointments</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-------- Number of today's required upload -------->
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon "><i class="material-icons" style="color: #000000;">upload</i></span>
                    <div class="dash-count">
                        <h3>{{count($uploads)}}</h3>
                        <div class="dash-widget-info">
                            <h6 class="textmuted">Required Uploads</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!----------- Total Money ------------->
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon "><i class="fa fa-money" style="color:  #000000;"></i></span>
                    <div class="dash-count">
                        <h3>
                            <?php

                            $totals = 0 ?>
                            @foreach ($uploadsCost as $upload)
                            <?php $totals += $upload->payment ?>
                            @endforeach
                            {{$totals}} EGP
                        </h3>
                        <div class="dash-widget-info">
                            <h6 class="textmuted">Total Revenue</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!------ /Page Cards ------->


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
<!------ /Alerts ------->



<!------ Page Table ------->
<div class="row">
    <!-- New requests List -->
    <div class="table table-hover table-center mb-0">
        <div class="Customcard-table">
            <div class="card-header">
                <h4 class="card-title">New Booking Requests List</h4>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-center mb-0" style="text-align:center;">
                    <thead>
                        <tr>
                            <th>MRN</th>
                            <th>Patient Name</th>
                            <th>Disease</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Test Name</th>
                            <th>Medicine</th>
                            <th>Booking Date</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <!---- Table Data ----->
                    <tbody>
                        @if(count($new_request)>0)
                        @foreach($new_request as $key=>$request)
                        <tr>
                            <td style="width:2%">{{$request->MRN}}</td>
                            <td>{{$request->name}}</td>
                            <td style="width:12%; color:red;">
                                <!--- Count Number of diseases--->
                                <?php $numDiseases = Illuminate\Support\Facades\DB::table('patient-disease')->where('MRN', '=', $request->MRN)->count();  ?>
                                <?php $diseases = Illuminate\Support\Facades\DB::table('disease')
                                    ->join('patient-disease', 'patient-disease.disease_id', '=', 'disease.disease_id')
                                    ->where('patient-disease.MRN', '=', $request->MRN)->get();  ?>
                                @foreach($diseases as $key=>$disease)
                                {{$disease->disease_name}}
                                @if( $numDiseases > 1)
                                ,
                                @php
                                $numDiseases--;
                                @endphp
                                @endif
                                @endforeach
                            </td>
                            <td style="width:2px">
                                @if($request->sex == "female")
                                <a><i class="fa fa-female"></i></a>
                                @else
                                <a><i class="fa fa-male"></i></a>
                                @endif
                            </td>
                            <td style="width:6%">
                                @php
                                $age = Carbon\Carbon::parse($request->birth_of_date)->diff(Carbon\Carbon::now()->addMinutes(120))->format('%y years');
                                @endphp
                                {{$age}}
                            </td>
                            <td style="color:red;">
                                <!--- Get All files required to upload for the same patient--->
                                <!--- Count Number of files--->
                                <?php $numFiles = Illuminate\Support\Facades\DB::table('lab_result')->where('appointment_id', '=', $request->appointment_id)->count();  ?>
                                <?php $Files = Illuminate\Support\Facades\DB::table('lab_result')
                                    ->join('disease_test', 'disease_test.test_id', '=', 'lab_result.test_id')
                                    ->where('appointment_id', '=', $request->appointment_id)->get();  ?>
                                @foreach($Files as $key=>$file)
                                {{$file->test_name}}
                                @if( $numFiles > 1)
                                ,
                                @php
                                $numFiles--;
                                @endphp
                                @endif
                                @endforeach
                            </td>
                            <td style="color:red;">{{$request->medicine}}</td>
                            <td style="width:8%">
                                <!--convert date which is return in string format into date format-->
                                @php
                                $appointmentDate = new DateTime($request->appointment_date);
                                @endphp
                                {{$appointmentDate->format('Y-m-d')}}
                            </td>
                            <td>@if($request->latiude == 0)
                                {{$request->live_location}}
                                @else
                                <a href="{{ url('Map' , [ 'latiude' => $request->latiude , 'longitude' => $request->longitude ]) }}" target="_blank"><button type="button" class="btn btn-link">View Map</button></a>
                                @endif
                            </td>
                            <td style="width:5%">0{{$request->phone}}</td>
                            <td style="width:12%">
                                <button class="btn" style="display:inline;" title="Chat"  onclick="window.location.href='/chatify/{{ \App\Models\User::where('email', $request->email)->first()->id }}'"><i class="fa fa-comments"></i></button>
                                <div onclick="javascript:Accept.call(this)" id="{{$request->appointment_id}}" style="display:inline;"><button class="btn" title="Accept"><i class="fa fa-check"></i></button></div>
                                <div onclick="javascript:Delete.call(this)" id="{{$request->appointment_id}}" style="display:inline;"><button class="btn" title="Reject"><i class="fa fa-remove"></i></button></div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <h2 style="color:red; margin-top:10px; margin-bottom:10px; margin-left:42%; font-family:Poppins;">No Requests Found </h2>
                        @endif

                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if($new_request instanceof \Illuminate\Pagination\AbstractPaginator )
{{ $new_request->links('lab_pages.LabCustomPagination') }}
@endif

<!---- Reset Icon ---->
<div class="fixed">
    <a href="/LabDash" title="Reset"><i class="material-icons" style="font-size:45px;">sync</i> </a>
</div>


<!----------------------------- The Contact Modal ----------------------------->
<div class="modal fade" id="contactModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="font-family: ubuntu;">Chat </h4>
                <button type="button" class="btn-close" title="Close" data-bs-dismiss="modal" style="border:transparent; background-color:transparent;"><span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/LabDash/contact-user" class="Contact-Form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id" value="">
                    <div class="form-floating mb-3 mt-3">
                        <textarea class="form-control" id="message" name="message" placeholder="Type message .. " required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Send</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection
@section('customJS')
@parent

<!--Contact Modal-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $('#contactModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('user_id')

        var modal = $(this)
        modal.find('.modal-body #user_id').val(id);
    })
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == document.getElementById('contactModal')) {
            model.style.display = "none";
        }
    }
</script>




<!---Sweet Alert "Delete"--->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function Delete() {
        var appointment_id = this.id;
        swal({
            title: "Are you sure that you want to reject this appointment?",
            text: "Once deleted, you will not be able to recover this!",
            icon: "warning",
            buttons: [true, "Delete"],
            dangerMode: true,
            value: "appointment_id"
        }).then((willDelete) => {
            if (willDelete) {
                window.location = "/LabDash/RejectRequest/" + appointment_id + "";
            }
        });
    }
</script>

<!---Sweet Alert "Accept"--->
<script>
    function Accept() {
        var appointment_id = this.id;
        swal({
            title: "Are you sure that you want to accept this appointment?",
            icon: "warning",
            buttons: [true, "Accept"],
            value: "appointment_id"
        }).then((willDelete) => {
            if (willDelete) {
                window.location = "/LabDash/AcceptRequest/" + appointment_id + "";
            }
        });
    }
</script>

@endsection