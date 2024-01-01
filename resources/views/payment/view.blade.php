@extends('layout.master')
@section('title')
    payment list
@endsection
@section('mainContent')
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="login_logo font-weight-normal">Book Appointment</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">buyer_name</th>
                <th scope="col">buyer_email</th>
                <th scope="col">buyer_address</th>
                <th scope="col">cd_number</th>
                <th scope="col">month</th>
                <th scope="col">year</th>
                <th scope="col">cvv</th>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $n)
                <tr>
                    <th>{{$n->id}}</th>
                    <td>{{$n->buyer_name}}</td>
                    <td>{{$n->buyer_email}}</td>
                    <td>{{$n->buyer_address}}</td>
                    <td>{{$n->cd_number}}</td>
                    <td>{{$n->month}}</td>
                    <td>{{$n->year}}</td>
                    <td>{{$n->cvv}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('custom_js')
    <script>
        @if (\Session::has('msg'))
        Swal.fire({
            title: "Payment successful",
            text: "Check your email for more details",
            icon: "success"
        });
        {{\Session::forget('msg')}}
        @endif
    </script>
@endsection
