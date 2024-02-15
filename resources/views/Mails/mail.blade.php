<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Order Confirmation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            box-sizing: border-box;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2, p {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        @media only screen and (max-width: 600px) {
            table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1 style="color: #ff6600;">Hairck Saloon</h1>
    <h2 style="color: #ff6600;">Salon Appointment Confirmation</h2>
    <p style="color: #555;">Thank you for choosing Hairck Salon! Your order has been confirmed.</p>
    <p style="color: #555;"><strong>Details of your order:</strong></p>
    <table>
        <tr>
            <th>Name</th>
            <td>{{ $appointmentDetail['user'] }}</td>
        </tr>

        <tr>
            <th>Category</th>
            <td>{{ $appointmentDetail['category'] }}</td>
        </tr>
        <tr>
            <th>Service</th>
            <td>{{ $appointmentDetail['service'] }}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ $appointmentDetail['date'] }}</td>
        </tr>
        <tr>
            <th>Time</th>
            <td>{{ $appointmentDetail['time'] }}</td>
        </tr>
    </table>
    <p style="color: #555;">We look forward to serving you. If you have any questions, feel free to contact us.</p>
</div>
</body>
</html>
