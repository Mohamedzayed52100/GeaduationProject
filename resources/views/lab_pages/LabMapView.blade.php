<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <title>Location</title>
  <link rel="shortcut icon" type="image/x-icon" href="/Lab_images/map.png">
  <style>
    body{
        margin: 0px;
        background: #0e0e0e;
    }
    iframe {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width:50%;
        height:700px;
    }
    h3 {
        display: block;
        margin-left: 610px;
        margin-bottom : 5px;
        color: white;
        margin-top:10px;
    }
  </style>
</head>
<body>
    <h3>The location has been updated to</h3>
    <iframe src='https://www.google.com/maps?q={{$latiude}},{{$longitude}}&hl=es;z=14&output=embed'></iframe>
</body>
</html>


