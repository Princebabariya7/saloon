@extends('Frontend.layout.master')
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
        <section class="content">
            <div class="container-fluid">
                <div class="card my-5">
                    <div class="card-header p-0">
                        {{ Form::open(['route' => ['price.index'], 'method'=>'get']) }}
                        <div class="row">
                            <div class=" col-md-2 mx-2">
                                <div class="input-group pt-3 pb-3">
                                    {!! Form::text('search', request('search'),['id' => 'search', 'class' => 'h-auto form-control form-control-sm inline','placeholder' => 'Search','autocomplete' =>'off']) !!}
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-secondary search-btn" type="submit">
                                            <i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th scope="col">service</th>
                                <th scope="col">@sortablelink('Price')</th>
                                <th scope="col">image</th>
                                <th scope="col" class="text-right">Action</th>
                            </tr>
                            </thead>
                            @if(count($prices) != 0)
                                <tbody>
                                @foreach($prices as $price)
                                    <tr>
                                        <td>{{$price->service}}</td>
                                        <td>{{$price->price}}</td>
                                        <td>
                                            <a href="{{ asset('uploads/gallery/'.$price->image) }}" target="_blank">
                                                <img src="{{ asset('uploads/gallery/'.$price->image) }}" width="40px" alt="Image">
                                            </a>
                                        </td>
                                        <td class="project-actions text-right">
                                            <button type="button"
                                                    class="btn  btn-light border btn-sm dropdown-toggle"
                                                    data-bs-toggle="dropdown">
                                                Action
                                            </button>
                                            <div class="btn-group">
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item"
                                                           href="{{route('price.edit',$price->id)}}">
                                                            <i class="fa fa-edit"> </i> Edit
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item  delete_popup text-danger"
                                                           href="#"
                                                           data-href="{{route('price.delete',$price->id)}}">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @else
                                <tfoot>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <h6 class="text-danger text-bold  pt-2">No Data Found</h6>
                                    </td>
                                </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="pagination pagination-sm  float-right">
                            {{ $prices->links() }}
                        </div>
                        @if(request('search') != '' || request('city') != '')
                            <i class="fa fa-filter"></i> {{ $prices->total()}} Records Match
                            <a href="#" class="btn-link    clear">Clear</a>
                        @endif
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function () {
            $('.delete_popup ').click(function () {
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
                    if (result.isConfirmed)
                    {
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
        $('.clear').click(function () {
            $('#search').val('');
            $('.search-btn').trigger('click');
        });
        @if (\Session::has('update'))
        toastr.success('Your price Has Successfully Updated!');
        {{ \Session::forget('update') }}
        @endif
    </script>
@endsection
