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
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item text-secondary"><a href="{{route('admin.payment.index')}}">
                                    Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.payment.index')}}">
                                    Payments</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            {{ Form::open(['route' => ['admin.payment.store'], 'method'=>'post','id'=>"payment-form" ]) }}
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
            <div class="card card-primary card-outline mx-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Billing">Customer Name</label>
                                {!! Form::text('buyer_name',$buyer_name, ['class' => 'form-control form-control-sm', 'id' => 'Billing', 'placeholder' => 'Enter your name', 'autocomplete'=>'off']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Billing_email">Customer Email</label>
                                {!! Form::text('buyer_email', $buyer_email, ['class' => 'form-control form-control-sm', 'id' => 'Billing_email', 'placeholder' => 'Enter your email', 'autocomplete'=>'off']) !!}
                            </div>
                        </div>
                    </div>
                    <label for="Billing">Card Detail</label>
                    <div id="payment-element">
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="row payment_methods">
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
                            <button id="submit" class="btn btn-sm btn-primary float-right"
                                    style="margin-right: 5px; float: left; margin-bottom: 20px;">MAKE PAYMENT
                                <h6 class="text-light text-bold"><i class='fas fa-rupee-sign'></i>{{$total}}
                                </h6>
                            </button>
                        </div>
                        <div id="error-message">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
@section('custom_js')
    <script>
        // Set your publishable key: remember to change this to your live publishable key in production
        // See your keys here: https://dashboard.stripe.com/apikeys
        $(document).ready(function () {
            var stripe = Stripe('please enter your sripe key');
            var elements = stripe.elements();
            // Create and mount the Payment Element
            var paymentElement = elements.create('card');
            paymentElement.mount('#payment-element');
            var formElement = $('#payment-form');
            var submitButton = $('#submit');
            var errorMessage = $('#error-message');
            formElement.on('submit', function (event) {
                event.preventDefault();
                submitButton.prop('disabled', true); // Disable the submit button to prevent double submission
                stripe.createToken(paymentElement).then(function (result) {
                    if (result.error) {
                        // Inform the user if there was an error
                        errorMessage.text(result.error.message);
                        submitButton.prop('disabled', false); // Re-enable the submit button
                    } else {
                        // Display the spinner while processing
                        submitButton.html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');

                        // Send the token to your server
                        stripeTokenHandler(result.token);
                    }
                });

            });

            function stripeTokenHandler(token)
            {
                var hiddenTokenInput = $('<input type="hidden" name="stripeToken">').val(token.id);
                var hiddenTotalInput = $('<input type="hidden" name="total">').val({{$total}});
                var hiddenIdInput = $('<input type="hidden" name="id">').val({{$id}});
                formElement.append(hiddenTokenInput);
                formElement.append(hiddenTotalInput);
                formElement.append(hiddenIdInput);
                // Now submit the form via AJAX
                $.ajax({
                    type: "POST",
                    url: formElement.attr('action'),
                    data: formElement.serialize(), // Serialize form data
                    success: function (response) {
                        // Handle success response here
                        window.location.replace(response.url);
                        console.log(response);
                    },
                    error: function (xhr, status, error) {
                        // Handle error response here
                        console.log(xhr.responseText);
                    },
                    complete: function () {
                        submitButton.prop('disabled', false);
                    }
                });
            }
        });
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
        @endif
    </script>
@endsection
