@extends('frontend.layout.master')
@section('title')
    payment
@endsection
@section('mainContent')
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="login_logo font-weight-normal">Payment</h1>
            </div>
        </div>
    </div>
    <div class="container appointment  mt-3">
        <div class="card login_content payment_formpage">
            {{ Form::open(['route' => ['online.info.store'], 'method'=>'post']) }}
            <div class="container main_form pt-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Billing">Customer Name</label>
                                            {!! Form::text('buyer_name', null, ['class' => 'form-control', 'id' => 'Billing', 'placeholder' => 'Enter your name']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Billing_email">Customer Email</label>
                                            {!! Form::text('buyer_email', null, ['class' => 'form-control', 'id' => 'Billing_email', 'placeholder' => 'Enter your email']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Buyer_Address">Customer Address</label>
                                    {!! Form::textarea('buyer_address', null, ['class' => 'form-control', 'id' => 'Buyer_Address', 'rows' => 2]) !!}
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cardnumber">Enter Card Number</label>
                                            {!! Form::text('cd_number', null, ['class' => 'form-control', 'id' => 'cardnumber', 'maxlength'=>'12']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Expiry Date</label>
                                        <div class="form-group">
                                            <div class="input-group date" id="reservationdate"
                                                 data-target-input="nearest">
                                                {!! Form::text('expiry', null, ['class' => 'form-control appointment-date datetimepicker-input', 'id' => 'date', 'data-target' => '#reservationdate', 'autocomplete' => 'off']) !!}
                                                <div class="input-group-append" data-target="#reservationdate"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cvv">CVV</label>
                                            {!! Form::text('cvv', null, ['class' => 'form-control', 'id' => 'cvv', 'maxlength'=>'3']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Selected Services Section -->
                <div class="card-body register-card-body">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Selected Services</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th scope="col">Service</th>
                                    <th scope="col">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($services as $service)
                                    <tr>
                                        <td>{{$service->name }}</td>
                                        <td><i class="fa fa-inr" aria-hidden="true"></i> {{ $service->price }}</td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td><strong>Total</strong></td>
                                    <td><strong><i class="fa fa-inr" aria-hidden="true"></i> <span
                                                id="totalPrice">{{ $total }}</span> </strong></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Payment Methods Section -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row payment_methods">
                                <!-- Payment methods images -->
                                <div class="col-md">
                                    <img src="{{ asset('cd/page_img/credit/visa.png') }}" alt="Visa">
                                    <img src="{{ asset('cd/page_img/credit/mastercard.png') }}" alt="MasterCard">
                                    <img src="{{ asset('cd/page_img/credit/american-express.png') }}"
                                         alt="American Express">
                                    <img src="{{ asset('cd/page_img/credit/paypal2.png') }}" alt="Paypal">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {!! Form::submit('MAKE PAYMENT', ['class' => 'btn btn-sm btn-primary float-right', 'style' => 'margin-right: 5px; float: left; margin-bottom: 20px;']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('custom_js')
    <script>
        @if ($errors -> any())
        @foreach($errors -> all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
        @endif
        $(document).ready(function () {
            $('#reservationdate').datetimepicker({
                format: 'MM/YYYY',
                viewMode: 'months',
                minViewMode: 'months',
                minDate: moment(),
            });
        });
    </script>
@endsection
