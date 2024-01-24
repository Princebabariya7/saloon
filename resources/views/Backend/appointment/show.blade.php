@php use App\Models\Category;use App\Models\Service; @endphp
@extends('Backend.layout.index')
@section("title")
    Appointment View
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header pt-0">
            <div class="container-fluid">
                <div class=" top-part d-flex flex-row-reverse">
                    <div class="new_btn mt-4">
                        <a href="{{ route('admin.appointment.edit', ['id' => $appointment->id]) }}"
                           class="btn btn-primary btn-sm mb-3">Edit</a>
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
                        <h3 class="card-title text-bold">Appointment</h3>
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
                                <td>{{$appointment->type}}</td>
                            </tr>
                            <tr>
                                <td>Date Time:</td>
                                <td>{{$appointment->date}}</td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td>{{$appointment->status }}</td>
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
