@extends('lab_pages.Lab-main-template')


<!--Website Title-->
@section('title')
{{session('labName')}}- Uploads
@endsection

<!--Page Title-->
@section('pageTitle')
Uploads
@endsection

<!--Website CSS-->
@section('css')
@parent
<link rel="stylesheet" href="/Lab_css/LabUploads.css">
@endsection


<!--Main Section-->
@section('main')
<!---------------------------------------------------      Today's Required Uploads       --------------------------------------------------->
<div class="CardTitle">Today's Required Uploads</div>
<div class="row" name="Today's Upload">
    @if(count($TodayUploads) == 0)
    <div class="NoDataFound">No Uploads Required Today</div>
    @else
    @foreach($TodayUploads as $key=>$upload)
    <div class="card">
        <header class="w3-light-grey">
            <h4 style="text-align:center; font-family:Ubuntu;"><b>{{$upload->name}}</b></h4>
        </header>
        <div class="container">
            <p style="text-align:center; margin-top:5px; font-family:Lora;"><b style="color:red;">
                    <!--- Count Number of files required to be uploaded --->
                    <?php $numFiles = Illuminate\Support\Facades\DB::table('lab_result')->where('appointment_id', '=', $upload->appointment_id)->where('result_file', '=', null)->count();  ?>
                    {{$numFiles}}</b> File Required</p>
            <hr>
            <img src="{{ asset('PatientImages/'. $upload->patient_image) }}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
            <div class="userData">
                <p><i class="fa fa-user"></i>ID : {{$upload->MRN}}</p>
                <p><i class="fa fa-clock-o"></i>Remaining :
                    @php
                    $time = Carbon\Carbon::parse(Carbon\Carbon::now()->addMinutes(180))->diff($upload->due_date." 24:00:00")->format('%hH %iM');
                    @endphp
                    {{$time}}
                </p>

                <p><i class="fa fa-folder"></i>Test :

                    <!--- Get All files required to upload for the same patient--->
                    <?php $Files = Illuminate\Support\Facades\DB::table('lab_result')
                        ->join('disease_test', 'disease_test.test_id', '=', 'lab_result.test_id')
                        ->where('appointment_id', '=', $upload->appointment_id)
                        ->where('result_file', '=', null)->get();  ?>
                    @foreach($Files as $key=>$file)
                    {{$file->test_name}}
                    @if( $numFiles > 1)
                    ,
                    @php
                    $numFiles--;
                    @endphp
                    @endif
                    @endforeach

                </p>
            </div>
        </div>
        <div class="containerButton">
            <button class="btn"><i class="fa fa-folder" title="Upload" data-bs-toggle="modal" data-bs-target="#uploadModal" data-patient_id="{{ $upload->MRN }}" data-appointment_id="{{ $upload->appointment_id }}"></i></button>
        </div>
    </div>
    @endforeach
    @endif
</div>





<!---------------------------------------------------      Next Required Uploads       --------------------------------------------------->
<div class="CardTitle">Reminder of Next Uploads</div>
<div class="row" name="Tomorrow's Upload">
    @if(count($NextUploads) == 0)
    <div class="NoDataFound">No Future Uploads Required</div>
    @else
    @foreach($NextUploads as $key=>$upload)
    <div class="card">
        <header class="w3-light-grey">
            <h4 style="text-align:center; font-family:Ubuntu;"><b>{{$upload->name}}</b></h4>
        </header>
        <div class="container">
            <p style="text-align:center; margin-top:5px; font-family:Lora;"><b style="color:red;">
                    <!--- Count Number of files--->
                    <?php $numFiles = Illuminate\Support\Facades\DB::table('lab_result')->where('appointment_id', '=', $upload->appointment_id)->count();  ?>
                    {{$numFiles}}</b> File Required</p>
            <hr>
            <img src="{{ asset('PatientImages/'. $upload->patient_image) }}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
            <div class="userData">
                <p><i class="fa fa-user"></i>ID : {{$upload->MRN}}</p>
                <p><i class="fa fa-clock-o"></i>Remaining :
                    @php
                    $time = Carbon\Carbon::parse($upload->due_date)->diff(Carbon\Carbon::now()->addMinutes(180))->format('%dD %hH %iM');
                    @endphp
                    {{$time}}
                </p>

                <p><i class="fa fa-folder"></i>Test :

                    <!--- Get All files required to upload for the same patient--->
                    <?php $Files = Illuminate\Support\Facades\DB::table('lab_result')
                        ->join('disease_test', 'disease_test.test_id', '=', 'lab_result.test_id')
                        ->where('appointment_id', '=', $upload->appointment_id)
                        ->where('result_file', '=', null)->get();  ?>
                    @foreach($Files as $key=>$file)
                    {{$file->test_name}}
                    @if( $numFiles > 1)
                    ,
                    @php
                    $numFiles--;
                    @endphp
                    @endif
                    @endforeach

                </p>
            </div>
        </div>
        <div class="containerButton">
            <button class="btn"><i class="fa fa-folder" title="Upload" data-bs-toggle="modal" data-bs-target="#uploadModal" data-patient_id="{{ $upload->MRN }}" data-appointment_id="{{ $upload->appointment_id }}"></i></button>
        </div>
    </div>
    @endforeach
    @endif
</div>




<!---------------------------------------------------             Upload form             --------------------------------------------------->


<div class="modal fade" id="uploadModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <form action="/LabUploads" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="appointment_id" id="appointment_id" value="">

                <div class="headercontainer">
                    <h2 class="txtUpload"><b><i class="fa fa-upload" aria-hidden="true"></i>Upload Medical Files</b></h2>
                </div>
                <div class="containerUpload">
                    <p class="P-upload">Click on the <B>Choose File</B> button to upload the file </p>
                    <label class="lblUpload" for="uploadfile"><i class="fa fa-paperclip fa-lg"></i>Choose file</label>
                    <!---Type of uploaded file---->
                    <input type="file" id="uploadfile" name="uploadfile" class="uploadfile" accept=".jpg,.jpeg,.png" required>


                    <!---Show the file that the user has been chosen---->
                    <p class="p-result">The file uploaded will be rendered inside the box below</p>
                    <div class="Result">
                        <span style="margin-left:33px; margin-right:190px;">File</span>
                        <span> Name</span>
                        <img id="resultfile" class="w3-left w3-margin-right" style="width:100px">
                        <p class="w3-right" id="filename"></p>
                    </div>


                    <div class="PID" id="PID" name="PID">
                        <span>Patient ID :</span>
                        <input type="text" class="patient_id" id="patient_id" name="patient_id" value="" readonly>
                    </div>
                    <input type="text" name="labID" class="labID" placeholder="Enter Laboratory Physician ID" required>
                    
                    <div name="testName" id="testName">
                        <!---Get the Test Name --->
                        <?php
                        $date = Carbon\Carbon::now()->addMinutes(180)->format('y-m-d');
                        $Files = Illuminate\Support\Facades\DB::table('disease_test')
                            ->select('disease_test.test_name')
                            ->join('lab_result', 'lab_result.test_id', '=', 'disease_test.test_id')
                            ->join('lab_appointment', 'lab_appointment.appointment_id', '=', 'lab_result.appointment_id')
                            ->where('lab_appointment.status', '=', 'upload')
                            ->where('lab_appointment.due_date', '=', $date)
                            ->where('lab_result.result_file', '=', null)
                            ->distinct()->get();  ?>
                        <select name="testType" id="testType" required>
                            <option disabled>Select Test Name</option>
                            @foreach($Files as $key=>$file)
                            <option value="{{$file->test_name}}">{{$file->test_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btnUpload">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection
@section('customJS')
@parent

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script>
    $('#uploadModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var appointment_id = button.data('appointment_id')
        var patient_id = button.data('patient_id')


        var modal = $(this)
        modal.find('.modal-content #patient_id').val(patient_id);
        modal.find('.modal-content #appointment_id').val(appointment_id);

    })

    // Get the modal
    var model = document.getElementById('uploadModal');
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == model) {
            model.style.display = "none";
        }
    }
</script>

<script>
    //Show the file that the user has been chosen
    let uploadButton = document.getElementById("uploadfile");
    let uploadImage = document.getElementById("resultfile");
    let fileName = document.getElementById("filename");
    uploadButton.onchange = () => {
        let reader = new FileReader();
        reader.readAsDataURL(uploadButton.files[0]);
        reader.onload = () => {
            uploadImage.setAttribute("src", reader.result);
        }
        fileName.textContent = uploadButton.files[0].name;
    }
</script>



@endsection