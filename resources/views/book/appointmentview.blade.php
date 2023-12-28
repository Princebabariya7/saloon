@extends('layout.master')
@section('title')
    appointment list
@endsection
@section('mainContent')
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="login_logo font-weight-normal">Book Appointment</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">package</th>
                <th scope="col">stylist</th>
                <th scope="col">appointment_time</th>
                <th class="text-right" scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $n)
                <tr>
                    <th>{{$n->id}}</th>
                    <td>{{$n->package}}</td>
                    <td>{{$n->stylist}}</td>
                    <td>{{$n->appointment_time}}</td>
                    <td class="project-actions text-right">
                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                data-bs-toggle="dropdown">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="mb-1 w-100 text-dark text-center d-block"
                                   href="{{route('appointment.edit',$n->id)}}">
                                    Edit
                                </a>
                            </li>
                            <li>
                                <a class="mb-1 w-100 text-dark text-center d-block"
                                   href="{{route('appointment.delete',$n->id)}}">
                                    Delete
                                </a>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            {{ $data->links() }}
        </div>
    </div>
@endsection
