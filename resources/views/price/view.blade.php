@extends('layout.master')
@section('title')
    price list
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
                <th scope="col">service</th>
                <th scope="col">price</th>
                <th scope="col">image</th>
                <th scope="col ">Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($price as $n)
                <tr>
                    <th>{{$n->id}}</th>
                    <td>{{$n->service}}</td>
                    <td>{{$n->price}}</td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#exampleModal{{ $n->id }}">
                            <img src="{{ asset('uploads/gallery/'.$n->image) }}" width="40px"
                                 alt="Image">
                        </a>
                    </td>
                    <td class="project-actions">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                data-bs-toggle="dropdown">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item  small "
                                   href="{{route('price.edit',$n->id)}}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item small gallery-delete text-danger"
                                   href="#"
                                   data-href="{{route('price.delete',$n->id)}}">
                                    <i class="fa fa-trash"> </i> Delete
                                </a>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function () {
            $('.gallery-delete').click(function () {
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

        @if (\Session::has('add'))

        toastr.success('Your Data Has Successfully Added!');
        {{ \Session::forget('add') }}
        @endif

        @if (\Session::has('update'))

        toastr.success('Your Data Has Successfully Updated!');
        {{ \Session::forget('update') }}
        @endif
    </script>
@endsection
