@extends('lab_pages.Lab-main-template')
<!--Website Title-->
@section('title')
{{session('labName')}} - Search
@endsection

<!--Page Title-->
@section('pageTitle')
Search
@endsection 

<!--Website CSS-->
@section('css')
@parent
<link rel="stylesheet" href="/Lab_css/LabSearch.css">
<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
@endsection


<!--Main Section-->
@section('MainSection')
    <!-- Search -->
    <div class="s130">
        <form method="post" action="/Search" autocomplete="off">
            @csrf
            <div class="inner-form">
                <div class="input-field first-wrap">
                    <div class="svg-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                        </svg>
                    </div>
                    <input required pattern="[a-zA-Z0-9 ]+" title="Names only contain characters, IDs only contain numbers" type="search" name="search" id="search" class="form-control typeahead" placeholder="Search By Patient Name OR Patient ID" value="{{ old('search') }}"/>
                </div>
                <div class="input-field second-wrap">
                   <button class="btn-search" onclick="search()">SEARCH</button>
                </div>
           </div>
        </form>
    </div>



     <!------ Alerts ------->
     @if(session('success_alert'))
        <div class="alert alert-success alert-dismissible fade show">
            <strong>Success!</strong>  {{ session('success_alert') }}
        </div>
    @endif
    @if(session('error_alert'))
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Error!</strong> {{ session('error_alert') }}
        </div>
    @endif
    <!------ /Alerts ------->



    <!-- Recent requests -->
    <div class="Customcard-Searchtable">
        <div class="table-responsive">
            <table class="table table-hover table-center mb-0" >
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>MRN</th>
                        <th>Patient Name</th>
                        <th>Appointment Date</th>
                        <th>Upload Date</th>
                        <th>Physician ID</th>
                        <th>Test Name</th>
                        <th>Test File</th>
                        <th>Action</th>              
                    </tr>
                </thead>
                <tbody>
                    @if(count($Lab_user)>0)
                        @foreach($Lab_user as $key=>$user)
                            <tr>
                                <td style="width:9%">{{$user->appointment_id}}</td>
                                <td style="width:2%">{{$user->MRN}}</td>
                                <td>{{$user->name}}</td>
                                <td style="width:11%">
                                    @php 
                                        $appointmentDate = new DateTime($user->appointment_date);
                                    @endphp
                                    {{$appointmentDate->format('Y-m-d')}}
                                </td>         
                                <td style="width:11%">{{$user->upload_date}}</td> 
                                <td style="width:8%">{{$user->physician_id}}</td>
                                <td>{{$user->test_name}}</td> 
                                <td> 
                                    @if($user->image_name == null)
                                        Not Uploaded Yet
                                    @else
                                        <a href="{{ url('LabSearch/viewImage',['file' => $user->image_name] ) }}" target="_blank"><button type="button" class="btn btn-link">View</button></a>
                                    @endif
                                </td> 
                                <td style="width:14%">
                                    <button class="btn" style="display:inline;" title="Chat"   onclick="window.location.href='/chatify/{{ \App\Models\User::where('email', $user->email)->first()->id }}'" ><i class="fa fa-comments" ></i></button>
                                    <button class="btn" style="display:inline;" title="Edit"   data-bs-toggle="modal" data-bs-target="#editModal"  data-appointment_id="{{ $user->appointment_id }}" data-test_name="{{ $user->test_name}}" ><i class="material-icons" style="font-size:20px; color:rgb(97, 189, 6);">edit</i></button>
                                    @if($user->image_name == null)
                                        <div style="display:inline;" onclick="MyFunction()"><button class="btn" title="Download" ><i class="material-icons" style="font-size:21px; color:grey;" title="Download">download</i></button></div>
                                    @else
                                        <div style="display:inline;"><a href="/Lab_images/Uploads/{{$user->image_name}}" download = "{{$user->test_name}}_id{{$user->appointment_id}}"><button class="btn" title="Download" ><i class="material-icons" style="font-size:21px; color:grey;" title="Download">download</i></button></a></div>
                                    @endif
                                    <div onclick="javascript:Delete.call(this)" id="{{$user->appointment_id}}" style="display:inline;"><button class="btn" title="Reject" ><i class="material-icons" style="font-size:20px; color:red;" title="Delete">delete</i></button></div>
                                </td> 
                            </tr>
                        @endforeach
                    @else
                        <h2 style="color:red; margin-bottom:20px; font-family:Poppins;">No Records Found </h2>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
            
    @if($Lab_user instanceof \Illuminate\Pagination\AbstractPaginator )
        {{ $Lab_user->links('lab_pages.LabCustomPagination') }} 
    @endif   
        
     
    <div class="fixed">
        <a class=" nav-link" href="/LabSearch" title="Reset"><i class="material-icons"style="font-size:45px;">sync</i> </a>  
    </div>

    <!----------------------------- The Contact Modal ----------------------------->
    <div class="modal fade" id="contactModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="font-family: ubuntu;" >Chat </h4>
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


    <!----------------------------- The Edit Modal ----------------------------->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="font-family: ubuntu;" >Edit </h4>
                    <button type="button" class="btn-close" title="Close" data-bs-dismiss="modal" style="border:transparent; background-color:transparent;"><span aria-hidden="true">&times;</span> </button>   
                </div>
                <div class="modal-body">
                    <form method="POST" action="/Search/update" class="Edit-Form" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="appointment_id" id="appointment_id" value="">
                        <input type="hidden" name="test_name" id="test_name" value="">
                        <p class="P-upload">Click on the <B>Choose File</B> button to upload the file </p>
                        <label class="lblUpload" for="uploadfile"><i class="fa fa-paperclip fa-lg"></i>Choose file</label>
                        <input type="file" id="uploadfile" name="uploadfile" class="uploadfile" accept=".jpg,.jpeg,.png" required>                        
                        <p class="P-upload">Enter <B>Physician ID</B> :</p>
                        <input class="id" type="text" id="id" name="id" placeholder="Type here .." required>
                        <button type="submit" class="btn btn-success">Edit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    



@endsection



@section('customJS')
@parent

<script>
    function search() {
        const inpObj = document.getElementById("search");
        if (!inpObj.checkValidity()) {
            document.getElementById("demo").innerHTML = inpObj.validationMessage;
        }
    }
</script>

<script>
    function MyFunction() {
        window.alert('No File To Download');

    }
</script>


<!--Contact Modal-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
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


<!--Edit Modal-->
<script>
     $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var appointment_id = button.data('appointment_id')
        var test_name = button.data('test_name')
        var modal = $(this)
        modal.find('.modal-body #appointment_id').val(appointment_id);
        modal.find('.modal-body #test_name').val(test_name);

    })
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == document.getElementById('editModal')) {
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
        title: "Are you sure that you want to delete this data?",
        text: "Once deleted, you will not be able to recover this!",
        icon: "warning",
        buttons: [true, "Delete"],
        dangerMode: true,
        value: "appointment_id"
        }).then((willDelete) => {
            if (willDelete) {
               window.location="/LabDash/RejectRequest/"+appointment_id+"";
            }
        }); 
    }
</script>



<!-- AutoComplete -->
<!-- jQuery & Typeahead.js -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"> </script>
<script>
    var path = "{{ route('search_patient') }}";
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