@extends('Backend.layout.index')
@section("title")
    Appointment Detail
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header pt-0">
            <div class="container-fluid">
                <div class="row pt-4">
                    <div class="col-sm-6">
                        <h1 class="m-0">Appointment</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item text-secondary"><a href="{{route('admin.appointment.index')}}">
                                    Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.appointment.index')}}">
                                    Appointments</a>
                            </li>
                            <li class="breadcrumb-item active">View</li>
                        </ol>
                    </div>
                </div>
                <div class=" top-part d-flex flex-row-reverse">
                    <div class="new_btn mt-4">
                        @if($appointment->appointment->date > $currentDate->toDateString())
                            <a href="{{ route('admin.appointment.edit', ['id' => $appointment->id]) }}"
                               class="btn btn-primary btn-sm mb-3">Edit</a>
                        @else
                            <td class="project-actions">
                                <a data-toggle="modal"
                                   data-target="#exampleModal"
                                   href="{{ route('admin.appointment.edit', ['id' => $appointment->id]) }}"
                                   class="btn btn-primary btn-sm mb-3">Edit</a>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="p-3 bg-danger">
                                                <h5 class="modal-title text-light text-center"
                                                    id="exampleModalLabel">This Appointment Can't Be
                                                    Changable </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        @endif
                        <a href="{{ route('admin.appointment.index') }}"
                           class="btn btn-secondary btn-sm mb-3">Back</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-bold">Appointment Detail</h3>
                    </div>
                    <div class="container">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Category:</td>
                                <td>{{ $appointment->services->categories->type }}</td>
                            </tr>
                            <tr>
                                <td>Service:</td>
                                <td>{{$appointment->services->name}}</td>
                            </tr>
                            <tr>
                                <td>Type:</td>
                                <td>{{$appointment->appointment->type}}</td>
                            </tr>
                            <tr>
                                <td>Date:</td>
                                <td>{{$appointment->appointment->date}}</td>
                            </tr>
                            <tr>
                                <td>Time:</td>
                                <td>{{$appointment->appointment->time}}</td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td>{{$appointment->appointment->status }}</td>
                            </tr>
                            <tr>
                                <td>Created at:</td>
                                <td>{{ $appointment->created_at->format('F d, Y H:i:s') }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
