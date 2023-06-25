<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
</head>
<body>
<h2 style="text-align:center">CamboTutorial.com Monthly Payroll {{ $date }}</h2>
<style>
table.GeneratedTable {
  width: 100%;
  background-color: #ffffff;
  border-collapse: collapse;
  border-width: 2px;
  border-color: #000000;
  border-style: solid;
  color: #000000;
}

table.GeneratedTable td, table.GeneratedTable th {
  border-width: 2px;
  border-color: #000000;
  border-style: solid;
  padding: 3px;
}

table.GeneratedTable thead {
  background-color: #ffffff;
}
h1{
    color:red;
    
}
</style>


<h1>mohamed ibrahim</h1>
{{-- <table class="GeneratedTable">
  <thead>
    <tr>
      <th>No</th>
      <th>Employee</th>
      <th>Gender</th>
      <th>Net Salary</th>
      <th>With Holding Tax</th>
      <th>Net Pay</th>
    </tr>
  </thead>
  <tbody>
  @for($i =0; $i< sizeof($data); $i++)
    <tr>
      <td style="text-align:center;">{{$i+1}}</td>
      <td>{{$data[$i]['name']}}</td>
      <td>{{$data[$i]['gender']}}</td>
      <td>{{$data[$i]['salary']}} $</td>
      <td>{{$data[$i]['withholding_tax']}} $</td>
      <td>{{$data[$i]['netpay']}} $</td>
    </tr>
  @endfor
  </tbody>
</table> --}}
</body>
</html>
