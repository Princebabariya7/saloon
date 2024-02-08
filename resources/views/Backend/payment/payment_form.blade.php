@php use App\Models\Service; @endphp
@extends ('Backend.layout.index')
@section("title")
    Payment Form
@endsection
@section("content")
    <section class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Payment</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item text-secondary"><a href="{{route('admin.payment.index')}}">
                                    Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.payment.index')}}">
                                    Payment</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            {{ Form::open(['route' => ['admin.appointment.store'], 'method'=>'post']) }}
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2">
                                <a class="btn btn-default btn-sm btn-block" href="{{route('admin.payment.index')}}">
                                    Back
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>

        <div class="w-100">
            <div class="card  mx-3">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Billing">Customer Name</label>
                                {!! Form::text('buyer_name', null, ['class' => 'form-control form-control-sm', 'id' => 'Billing', 'placeholder' => 'Enter your name']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Billing_email">Customer Email</label>
                                {!! Form::text('buyer_email', null, ['class' => 'form-control form-control-sm', 'id' => 'Billing_email', 'placeholder' => 'Enter your email']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Buyer_Address">Customer Address</label>
                        {!! Form::textarea('buyer_address', null, ['class' => 'form-control form-control-sm', 'id' => 'Buyer_Address', 'rows' => 1]) !!}
                    </div>

                    <div class="form-group">
                        <label for="cardnumber">Enter Card Number</label>
                        {!! Form::text('cd_number', null, ['class' => 'form-control form-control-sm', 'id' => 'cardnumber', 'maxlength'=>'12']) !!}
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Expiry Month</label>
                            <div class="form-group">
                                <div class="input-group">
                                    {!! Form::text('exp_month', null, ['class' => 'form-control form-control-sm', 'id' => 'month', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Expiry Year</label>
                            <div class="form-group">
                                <div class="input-group">
                                    {!! Form::text('exp_year', null, ['class' => 'form-control form-control-sm', 'id' => 'month', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cvv">CVV</label>
                                {!! Form::text('cvv', null, ['class' => 'form-control form-control-sm', 'id' => 'cvv', 'maxlength'=>'3']) !!}
                            </div>
                        </div>
                    </div>

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
            </div>
        </div>
        {!! Form::close() !!}
    </section>

@endsection

@section('custom_js')
    <script>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
        @endif
    </script>
@endsection
