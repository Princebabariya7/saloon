@php use App\Models\Service; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Order Confirmation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Hairck Saloon</h1>
    <h2 class="d-none d-sm-block">Salon Appointment Confirmation</h2>
    <p>Thank you for choosing Hairck Salon! Your order has been confirmed.</p>
    <p><strong>Details of your order:</strong></p>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Service</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
            </tr>
            </thead>
            <tbody>
            @foreach(request()->service_id as $service)
                <tr>
                    <td>{{ auth()->user()->firstname }}</td>
                    <td>{{ $appointment->services->categories->type }}</td>
                    <td>{{ Service::find($service)->name }}</td>
                    <td>{{ $appointment->date }}</td>
                    <td>{{ $appointment->time }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <p>We look forward to serving you. If you have any questions, feel free to contact us.</p>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
