@extends('frontend.layout.master')
@section('title')
    order list
@endsection
@section('mainContent')
    <div class="page-header">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="login_logo font-weight-normal">Your orders</h1>
            </div>
        </div>
    </div>
    <div class="container login_content">
        <div class="card card-secondary">
            <div class="card-header">
                <div class="orderstable">
                    <h3 class="card-title mb-0">your orders<i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </h3>
                </div>
                <div class="returnhome float-right">
                    <a href="index.php">back to home</a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>service</th>
                        <th>DATE</th>
                        <th>price</th>
                        <th>status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>hair cutting</td>
                        <td>12/12/2023</td>
                        <td>$100</td>
                        <td><span class="badge badge-success">conform</span></td>
                    </tr>
                    <tr>
                        <td>hair and beard cutting</td>
                        <td>12/10/2022</td>
                        <td>$200</td>
                        <td><span class="badge badge-danger">cancel</span></td>
                    </tr>
                    <tr>
                        <td>grooming</td>
                        <td>1/1/2021</td>
                        <td>$70</td>
                        <td><span class="badge badge-success">conform</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
