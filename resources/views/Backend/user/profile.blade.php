@extends ('Backend.layout.index')
@section("title")
    Profile
@endsection
@section("content")
    <div class="container mt-4">
        <div class="row justify-content-center login_content">
            <div class="col-md-6">
                <div class="card">
                    <div class="card card-primary card-outline m-0">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ asset('backend/assets/img/team-3.jpg') }}"
                                     alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ auth()->user()->firstname }}</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email</b>
                                    <p class="float-right">{{ auth()->user()->email }}</p>
                                </li>
                            </ul>
                            <div class="row justify-content-center mb-3">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#changePasswordModal">
                                    Change Password
                                </button>
                            </div>

                            <div class="row justify-content-center">
                                <button type="button" class="btn btn-sm btn-secondary">
                                    <a href="{{ route('dashboard.index') }}" class="text-light">
                                        Back to home
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
         aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'profile.change-password', 'method' => 'post']) !!}
                    <div class="form-group">
                        {!! Form::label('current_password', 'Current Password') !!}
                        {!! Form::password('current_password', ['class' => 'form-control form-control-sm']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('new_password', 'New Password') !!}
                        {!! Form::password('new_password', ['class' => 'form-control form-control-sm']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('confirm_password', 'Confirm Password') !!}
                        {!! Form::password('confirm_password', ['class' => 'form-control form-control-sm']) !!}
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Change Password</button>
                    {!! Form::close() !!}
                </div>
            </div>
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
    </script>
@endsection
