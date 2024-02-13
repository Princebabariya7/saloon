@extends('Backend.layout.index')
@section("title")
    Payment View
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header pt-0">
            <div class="container-fluid">
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
                        <h3 class="card-title text-bold">Payment</h3>
                    </div>
                    <div class="container">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Customer Name:</td>
                                <td>{{ $payment->buyer_name }}</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>{{$payment->buyer_email}}</td>
                            </tr>
                            <tr>
                                <td>Transaction id:</td>
                                <td>{{$payment->transaction_id}}</td>
                            </tr>
                            <tr>
                                <td>Gateway:</td>
                                <td>{{$payment->gateway}}</td>
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
