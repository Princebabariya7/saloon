<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Hairck Saloon</h1>
    <h1>Saloon Appointment Confirmation</h1>
    <p>Thank You For Choosing Hairck Saloon! Your order has been confirmed.</p>
    <p>Details of your order:</p>
    <table>
        <tr>
        <td>{{auth()->user()->firstname}}</td>
        <td>{{$appointment->services->name}}</td>
        <td>{{$appointment->date}}</td>
        <td>{{$appointment->time}}</td>
        </tr>
    </table>
    <p>We look forward to serving you. If you have any questions, feel free to contact us.</p>
</div>
</body>
</html>
