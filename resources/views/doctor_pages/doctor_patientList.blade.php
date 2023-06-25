<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="../css/DoctorCss/style.css">


    <!-- Favicons -->
    <link href="asset/img/features/" rel="icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="../asset/css/font-awesome.min.css">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="../asset/css/feathericon.min.css">

    <!-- Datatables CSS -->
    <link rel="stylesheet" href="../asset/plugins/datatables/datatables.min.css">


    <title>Patients' List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">


    <style>
        .delete{
            background: #007bff;
            color:white;
        }
        
    </style>

</head>
<body>

     <!-- SIDEBAR -->
    @include('doctor_pages.component.sidebar')

     <!-- SIDEBAR -->
     <!-- CONTENT -->
    <section id="content">
         <!-- NAVBAR -->
         @include('doctor_pages.component.navbar')
         @section('notification')
         @endsection

        <!-- NAVBAR -->


        <main>
             <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                     <div class="col-sm-12">
                        <h3 class="page-title">List of Patient</h3>
                         <ul class="breadcrumb">
                            <li>
                                <a href="#">Dashboard</a>
                            </li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li>
                                <a class="active" href="#"> All Patients</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
             <!-- /Page Header -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="table table-bordered yajra-datatable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Email</th>                
                                                <th>Phone</th>
                                                <th>Date Of Birthday</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



<!-- CONTENT -->



<!-- jQuery -->
<script src="../asset/js/jquery-3.2.1.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="../asset/js/popper.min.js"></script>
<script src="../asset/js/bootstrap.min.js"></script>

<!-- Slimscroll JS -->
<script src="../asset/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Datatables JS -->
<script src="../asset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../asset/plugins/datatables/datatables.min.js"></script>

<!-- Custom JS -->
<script src="../asset/js/script.js"></script>


<script src="../js/DoctorJS/script.js"></script>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {

    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('patients.list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'birth_of_date', name: 'birth_of_date'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });

  });
</script>
</html>
