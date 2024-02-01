@extends('Backend.layout.index')
@section("title")
    User View
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header pt-0">
            <div class="container-fluid">
                <div class=" top-part d-flex flex-row-reverse">
                    <div class="new_btn mt-4">
                        <a href="{{ route('admin.user.index') }}"
                           class="btn btn-secondary btn-sm mb-3">Back</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-bold">User</h3>
                    </div>
                    <div class="container">
                        <table class="table">

                            <tbody>
                            <tr>
                                <td>First Name:</td>
                                <td>{{ $user->firstname }}</td>
                            </tr>
                            <tr>
                                <td>Last Name:</td>
                                <td>{{ $user->lastname }}</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>Mobile:</td>
                                <td>{{ $user->mobile }}</td>
                            </tr>
                            <tr>
                                <td>User Status:</td>
                                <td>{{$user->user_status}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
