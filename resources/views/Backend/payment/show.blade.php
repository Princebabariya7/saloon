@extends('Backend.layout.index')
@section("title")
    Payment Detail
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header pt-0">
            <div class="container-fluid">
                <div class="row pt-4">
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
                            <li class="breadcrumb-item active">View</li>
                        </ol>
                    </div>
                </div>
                <div class=" top-part d-flex flex-row-reverse">
                    <div class="new_btn mt-4">
                        <a href="{{ route('admin.payment.index') }}"
                           class="btn btn-secondary btn-sm mb-3">Back</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-bold">Payment Detail</h3>
                    </div>
                    <div class="container">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Transaction id:</td>
                                <td>{{$payment->transaction_id}}</td>
                            </tr>
                            <tr>
                                <td>Gateway:</td>
                                <td>{{$payment->gateway}}</td>
                            </tr>
                            <tr>
                                <td>Transaction Detail:</td>
                                <td>{{$payment->transaction_detail}}</td>
                            </tr>
                            <tr>
                                <td>Amount:</td>
                                <td><i class="fas fa-rupee-sign"></i> {{$payment->total}}</td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td>{{$payment->status }}</td>
                            </tr>
                            <tr>
                                <td>Created at:</td>
                                <td>{{ $payment->created_at->format('F d, Y H:i:s') }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
