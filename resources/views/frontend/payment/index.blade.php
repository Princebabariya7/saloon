@extends('frontend.layout.master')
@section('title')
    Payment
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
        {{ Form::open(['route' => ['payment.info.store'], 'method'=>'post','id'=>"payment-form" ]) }}
        {{ Form::hidden('token',$token) }}
        <div class="w-100">
            <div class="card  mx-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Billing">Customer Name</label>
                                {!! Form::text('buyer_name', null, ['class' => 'form-control form-control-sm', 'id' => 'Billing', 'placeholder' => 'Enter your name', 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Billing_email">Customer Email</label>
                                {!! Form::text('buyer_email', null, ['class' => 'form-control form-control-sm', 'id' => 'Billing_email', 'placeholder' => 'Enter your email', 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                    </div>
                    <label for="Billing">Card Detail</label>
                    <div id="payment-element">
                        <!-- Elements will create form elements here -->
                    </div>

                    <div class="row mt-5">
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
                            <button type="submit" id="submit" class="btn btn-sm btn-primary float-right"
                                    style="margin-right: 5px; float: left; margin-bottom: 20px;">MAKE PAYMENT<h6
                                    class="text-light text-bold"><i class="fa fa-inr" aria-hidden="true"></i>
                                    {{request('total')}}</h6>
                            </button>
                        </div>
                        <div id="error-message">
                            <!-- Display error message to your customers here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
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

        $(document).ready(function () {
            var stripe = Stripe('pk_test_51Oh3GkSGdlQqnOKgAeJvDMxNGdxK5HvcoCDLt50Sn3YYqMBlVBL6vV3IhMKUs4KjG6cM9T6kVfuy3BMyoXaCRNpc009dVA2mvf');
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
                    if (result.error)
                    {
                        // Inform the user if there was an error
                        errorMessage.text(result.error.message);
                        submitButton.prop('disabled', false); // Re-enable the submit button
                    }
                    else
                    {
                        // Send the token to your server
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token)
            {
                var hiddenInput = $('<input type="hidden" name="stripeToken">').val(token.id);
                formElement.append(hiddenInput);
                console.log(formElement.attr('action'));
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
                        submitButton.prop('disabled', false); // Re-enable the submit button after AJAX request completes
                    }
                });
            }
        });
    </script>
@endsection
