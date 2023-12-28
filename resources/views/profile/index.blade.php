@extends('layout.master')
@section('title')
    Profile
@endsection
@section('mainContent')
    <div class="wrapper">
        <div class="page-header m-0">
            <div class="container">
                <div class="row justify-content-around">
                    <h1 class="login_logo font-weight-normal">Your Profile</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center login_content ">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card card-secondary card-outline m-0">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="cd/page_img/avatar5.png"
                                         alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">yash buha</h3>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>First Name</b>
                                        <p class="float-right">yash</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Last Name</b>
                                        <p class="float-right">buha</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>DOB</b>
                                        <p class="float-right">10/01/2004</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Mobile</b>
                                        <p class="float-right">6320154875</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Email</b>
                                        <p class="float-right">yash@example.com</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Gender</b>
                                        <p class="float-right">male</p>
                                    </li>
                                </ul>
                                <div class="row justify-content-center">
                                    <button type="button" class="btn btn-secondary"><a href="#" class="text-light">return to
                                            home</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
