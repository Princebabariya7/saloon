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
    <h1>Saloon Order Confirmation</h1>
    <p>Thank you for choosing our salon! Your order has been confirmed.</p>
    <p>Details of your order:</p>
    <ul>
        <li>{{auth()->user()->firstname}}</li>
        <li>{{$appointment->services->name}}</li>
        <li>{{$appointment->date}}</li>
        <li>{{$appointment->time}}</li>
    </ul>
    <p>We look forward to serving you. If you have any questions, feel free to contact us.</p>
</div>
</body>
</html>
