@extends ('Backend.layout.index')
@section("content")
            <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Order</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                                <li class="breadcrumb-item active">Order</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Main content -->
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <i class="fas fa-globe"></i> Hairec Saloon
                                            <small class="float-right">Date: 15/10/2023</small>
                                        </h4>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        From
                                        <address>
                                            <strong>Prince Patel</strong><br>
                                            a-25 ravidarshan socirty<br>
                                            nikol road Ahmedabad<br>
                                            Phone: 8160725545<br>
                                            Email: prince123@gmail.com
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        To
                                        <address>
                                            <strong>
                                                Alexander Pierce</strong><br>
                                            Hairec Saloon Shop no-5<br>
                                            xyz complex nikol Ahmedabad<br>
                                            Phone: 9998875456<br>
                                            Email: hairec989@gmail.com
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <b>Order #007612</b><br>
                                        <br>
                                        <b>Order ID:</b> 4F3S8J<br>
                                        <b>Payment Due:</b> 05/11/2023<br>
                                        <b>Account:</b> 968-34567
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Service</th>
                                                <th>Mode</th>
                                                <th>Description</th>
                                                <th>Subtotal</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Hair Styling</td>
                                                <td>UPI</td>
                                                <td>Hair wash and hair Styling</td>
                                                <td>₹500</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Beard</td>
                                                <td>UPI</td>
                                                <td>Beard Styling</td>
                                                <td>₹500</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-6">
                                        <p class="lead">Payment Methods:</p>
                                        <img src="{{asset('assets/dist/img/credit/visa.png')}}" alt="Visa">
                                        <img src="{{asset('assets/dist/img/credit/mastercard.png')}}" alt="Mastercard">
                                        <img src="{{asset('assets/dist/img/credit/american-express.png')}}" alt="American Express">
                                        <img src="{{asset('assets/dist/img/credit/paypal2.png')}}" alt="Paypal">
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">
                                        <p class="lead">Amount Due 05/11/2023</p>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td>₹1000</td>
                                                </tr>
                                                <tr>
                                                    <th>Tax (10%)</th>
                                                    <td>₹93</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>₹1000</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-12">
                                        <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                                class="fas fa-print"></i> Print</a>
                                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                            <i class="fas fa-download"></i> Generate PDF
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.invoice -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
@endsection
