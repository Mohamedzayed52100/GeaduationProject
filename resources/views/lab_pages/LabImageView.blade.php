<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <title>Search - Test File</title>
  <link rel="shortcut icon" type="image/x-icon" href="/Lab_images/Lablogin.png">
  <style>
    body{
      margin: 0px;
      background: #0e0e0e;
      height: 100%;
    }
    img {
      display: block;
      margin-left: auto;
      margin-right: auto;
      margin-top : 30px;
    }
  </style>
</head>
<body>
@foreach($result as $key=>$image)
    <img src="/Lab_images/Uploads/{{$image->image_name}}" alt="Tests' Files" style="width:50%">
@endforeach
</body>
</html>


