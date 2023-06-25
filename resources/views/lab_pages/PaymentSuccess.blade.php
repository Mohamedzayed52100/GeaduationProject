<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Success Payment</title>
        <link rel="shortcut icon" type="image/x-icon" href="/Lab_images/success.png">
        <link rel="stylesheet" href="/Lab_css/Payment.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    </head>

    <body>


    @foreach($result as $key=>$appointment)
        <div class="card">
           <div style="display:inline">
                <img src="/Lab_images/payment.gif" alt="Successful Payment" style="width:50%">
            </div>
            <h1 style="color: #4b83b0;">Payment Successful!</h1> 
            <p>Transaction Number: {{$appointment->invoice_id}}</p>
            <hr style="border-style:dashed" />
            <table style="width:100%">
                <tr>
                    <th>Amount Paid:</th>
                    <td>{{$appointment->payment}} LE</td>
                </tr>
                <tr>
                    <th>Card Type:</th>
                    <td>Visa</td>
                </tr>
                <tr>
                    <th>Telephone:</th>
                    <td>0{{$appointment->phone}}</td>
                </tr>
            </table>
            <h5>Thank you , {{$appointment->name}}</h5>
        </div> 
    @endforeach
    </body>


    
</html>