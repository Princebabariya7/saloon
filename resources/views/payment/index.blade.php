@extends('layout.master')
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
    <div class="container appointment">
        <div class="card login_content payment_formpage">
            <div class="card-body register-card-body">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Selected Servies</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>service</th>
                                <th>price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>John Doe</td>
                                <td><i class="fa fa-inr" aria-hidden="true"></i>
                                    100
                                </td>
                            </tr>
                            <tr>
                                <td>Alexander Pierce</td>
                                <td><i class="fa fa-inr" aria-hidden="true"></i>
                                    200
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <form action="{{route('payment.info.store')}}" method="post">
                @csrf
                <div class="container main_form">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="Billing">Buyer name</label>
                                        <input type="text" class="form-control" id="Billing"
                                               placeholder="Enter your name" name="buyer_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="Billing_email">Buyer email</label>
                                        <input type="text" class="form-control" id="Billing_email"
                                               placeholder="Enter your email" name="buyer_email">
                                    </div>
                                    <div class="form-group">
                                        <label for="Buyer_Address">Buyer Address</label>
                                        <textarea id="Buyer_Address" class="form-control" rows="2"
                                                  name="buyer_address"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        <div class="col-md-12">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title mb-0 text-light">Credit/Debit Card</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <label>Payment Methods:</label>
                                    <div class="row payment_methods">
                                        <div class="col-md">
                                            <img src="{{asset('cd/page_img/credit/visa.png')}}" alt="Visa">
                                            <img src="{{asset('cd/page_img/credit/mastercard.png')}}" alt="master card">
                                            <img src="{{asset('cd/page_img/credit/american-express.png')}}"
                                                 alt="American Express">
                                            <img src="{{asset('cd/page_img/credit/paypal2.png')}}" alt="Paypal">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cardnumber">Enter card number</label>
                                        <input type="text" id="cardnumber" class="form-control" name="cd_number">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>expiry date</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select class="form-control select2bs4" style="width: 100%;"
                                                                name="month">
                                                            <option selected disabled>month</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option>6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                            <option>10</option>
                                                            <option>11</option>
                                                            <option>12</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select class="form-control select2bs4" style="width: 100%;"
                                                                name="year">
                                                            <option selected disabled>year</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option>6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                            <option>10</option>
                                                            <option>11</option>
                                                            <option>12</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cvv">cvv</label>
                                                <input type="text" id="cvv" class="form-control" name="cvv">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right"
                                            style="margin-right: 5px;">
                                        MAKE PAYMENT
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('custom_js')
    <script>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
        @endif

        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
        @endif
    </script>
@endsection
