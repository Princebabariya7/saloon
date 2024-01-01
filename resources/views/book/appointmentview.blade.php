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
                                    <i class="fa fa-edit text-primary"></i>   Edit
                                </a>
                            </li>
                            <li>
                                <a class="mb-1 w-100 text-dark text-center d-block  apod"
                                   href="#"
                                   data-href="{{route('appointment.delete',$n->id)}}">
                                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>
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
@section('custom_js')
    <script>
        $(document).ready(function () {
            $('.apod').click(function () {
                var $_this = $(this);

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $_this.data('href');
                        $.get(url).done(function (res) {
                            $_this.parent().closest('tr').remove();
                            toastr.success(res.message);
                        }).fail(function (res) {
                            console.log(res.responseJSON.message);
                            toastr.error(res.responseJSON.message);
                        });
                    }
                });
            });
        });
    </script>
@endsection
