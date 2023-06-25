<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Diseases List</title>
    <link rel="icon" href="/PatientImages/assistance.png">
    <link rel="stylesheet" href="../PatientCSS/all.min.css" />
    <link rel="stylesheet" href="../css/Patientcss/framework.css" />
    <link rel="stylesheet" href="../css/Patientcss/master.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />

</head>

<body>
    <div class="page d-flex">
        @include('patient_pages.components.sidebar')


        <div class="content w-full">
            <!-- Start Head -->
            @include('patient_pages.components.headWithNotification')

            <!-- End Head -->
            <h1 class="p-relative">Registered Diseases</h1>
            <div class="courses-page d-grid m-20 gap-20">
            @foreach($disease_data as $key=>$data)
                <div class="course bg-white rad-6 p-relative">
                    <br><br><br>
                    @if($data->disease_name == 'CKD')
                        <img class="cover" style="margin-top:70px;" src="/PatientImages/kidney.png" alt="Kidney Image" /><br><br><br>
                        <div class="p-20"><h4 style="margin-left: 7px;">Chronic Kidney Disease</h4></div>
                    @elseif($data->disease_name == 'CHD')
                        <img class="cover" src="/PatientImages/heart.jpg" alt="HeartBeat Image" />
                        <div class="p-20"><h4 style="margin-left: 7px;">Coronary Heart Disease</h4></div>
                    @elseif($data->disease_name == 'Diabetes Type-1')
                        <img class="cover" src="/PatientImages/diabetes.jpg" alt="Diabetes Image" />
                        <div class="p-20"><h4 style="margin-left: 40px;">Diabetes Type-1</h4></div>
                    @elseif($data->disease_name == 'Diabetes Type-2')
                        <img class="cover" src="/PatientImages/diabetes.jpg" alt="Diabetes Image" />
                        <div class="p-20"><h4 style="margin-left: 40px;">Diabetes Type-2</h4></div>
                    @else
                        <img class="cover" src="/PatientImages/Gdiabetes.jpg" alt="Diabetes Image" />
                        <div class="p-20"><h4 style="margin-left: 20px;">Gestational Diabetes</h4></div>
                    @endif
                    <div class="info p-15 p-relative between-flex">
                        <div ><span class="title bg-blue c-white btn-shape">Registered</span><br></div>
                    </div>
                </div>
                @endforeach
            </div>


        
            <h1 class="p-relative">Add Diseases</h1>
            <div class="courses-page d-grid m-20 gap-20">
            @foreach($NotRegisteredDiseases as $key=>$data)
                <div class="course bg-white rad-6 p-relative">
                    <br><br><br>
                    @if($data->disease_name == 'CKD')
                        <input type="hidden" id="DiseaseName" value="{{$data->disease_name}}"></input>
                        <img class="cover" style="margin-top:70px;" src="/PatientImages/kidney.png" alt="Kidney Image" /><br><br><br>
                        <div class="p-20"><h4 style="margin-left: 7px;">Chronic Kidney Disease</h4></div>
                        <div class="info p-15 p-relative between-flex">
                            <a href="/PatientRequestDisease/{{$data->disease_name}}"><span class="title bg-blue c-white btn-shape">Send Request</span><br></a>
                        </div>
                    @elseif($data->disease_name == 'CHD')
                        <input type="hidden" id="DiseaseName" value="{{$data->disease_name}}"></input>
                        <img class="cover" src="/PatientImages/heart.jpg" alt="HeartBeat Image" />
                        <div class="p-20"><h4 style="margin-left: 7px;">Coronary Heart Disease</h4></div>
                        <div class="info p-15 p-relative between-flex">
                            <a href="/PatientRequestDisease/{{$data->disease_name}}"><span class="title bg-blue c-white btn-shape">Send Request</span><br></a>
                        </div>
                    @elseif($data->disease_name == 'Diabetes Type-1') 
                        <input type="hidden" id="DiseaseName" value="{{$data->disease_name}}"></input>
                        <img class="cover" src="/PatientImages/diabetes.jpg" alt="Diabetes Image" />
                        <div class="p-20"><h4 style="margin-left: 40px;">Diabetes Type-1</h4></div>
                        <div class="info p-15 p-relative between-flex">
                            <a href="/PatientRequestDisease/{{$data->disease_name}}"><span class="title bg-blue c-white btn-shape">Send Request</span><br></a>
                        </div>
                    @elseif($data->disease_name == 'Diabetes Type-2')
                        <input type="hidden" id="DiseaseName" value="{{$data->disease_name}}"></input>
                        <img class="cover" src="/PatientImages/diabetes.jpg" alt="Diabetes Image" />
                        <div class="p-20"><h4 style="margin-left: 40px;">Diabetes Type-2</h4></div>
                        <div class="info p-15 p-relative between-flex">
                            <a href="/PatientRequestDisease/{{$data->disease_name}}"><span class="title bg-blue c-white btn-shape">Send Request</span><br></a>
                        </div>
                    @else
                        <input type="hidden" id="DiseaseName" value="{{$data->disease_name}}"></input>
                        <img class="cover" src="/PatientImages/Gdiabetes.jpg" alt="Diabetes Image" />
                        <div class="p-20"><h4 style="margin-left: 20px;">Gestational Diabetes</h4></div>
                        <div class="info p-15 p-relative between-flex">
                            <a href="/PatientRequestDisease/{{$data->disease_name}}"><span class="title bg-blue c-white btn-shape">Send Request</span><br></a>
                        </div>
                    @endif

                   
                </div>
                @endforeach
                
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>

    @if(Session::has('sendRequest'))
    <script>
        swal("Success!","{!! Session::get('sendRequest') !!}",{
            button:"OK",})
        </script>

    @endif
    @if(Session::has('ErrorsendRequest'))
    <script>
        swal("Warning!","{!! Session::get('ErrorsendRequest') !!}",{
            button:"OK",})
        </script>

    @endif
</body>

</html>
