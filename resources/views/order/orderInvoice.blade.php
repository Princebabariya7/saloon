@extends('layout.master')
@section('title')
    order invoice
@endsection
@section('mainContent')
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="login_logo font-weight-normal">Invoice detail</h1>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="card appointment_content">
            <form action="../../index3.html" method="post">
                <div class="invoice p-3">
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <a href="#" class="navbar-brand hair text-dark">Hairck <span>Saloon</span></a>
                            </h4>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>hairck saloon</strong><br>
                                nikol,ahmedabad<br>
                                Phone: (804) 123-5432<br>
                                Email: info@haircksaloon.com
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>yash buha</strong><br>
                                pancham park<br>
                                nikol,ahmedabad<br>
                                Phone: (555) 539-1037<br>
                                Email: yash.buha@example.com
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <br>
                            <b>Payment Due:</b> 2/22/2014<br>
                            <b>Payment mode:</b> upi<br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Product</th>
                                    <th>Serial #</th>
                                    <th>price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>hair washing</td>
                                    <td>455-981-221</td>
                                    <td>$51.50</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>hair styling</td>
                                    <td>247-925-726</td>
                                    <td>$50.00</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="lead">Payment Methods:</p>
                            <img src="{{asset('cd/page_img/credit/visa.png')}}" alt="Visa">
                            <img src="{{asset('cd/page_img/credit/mastercard.png')}}" alt="Mastercard">
                            <img src="{{asset('cd/page_img/credit/american-express.png')}}" alt="American Express">
                            <img src="{{asset('cd/page_img/credit/paypal2.png')}}" alt="Paypal">

                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya
                                handango imeem
                                plugg
                                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="lead">Amount Due 2/22/2014</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>$101.50</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row no-print">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary float-right"><a href="{{route('orderlist')}}" class="text-light">return to orders</a></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
