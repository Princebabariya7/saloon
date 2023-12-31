@extends('frontend.layout.master')
@section('title')
    order list
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
                        {{ Form::open(['route' => ['online.index'], 'method'=>'get']) }}
                        <div class="row  justify-content-between px-3 pt-3">
                            <div class=" col-md-2">
                                <div class="input-group pb-2">
                                    {!! Form::text('search', request('search'),['id' => 'search', 'class' => 'h-auto form-control form-control-sm inline','placeholder' => 'Search','autocomplete' =>'off']) !!}
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-secondary search-btn" type="submit">
                                            <i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                {!! Form::select('city',[''=>'Please Select' ,'ahmedabad' => 'ahmedabad','rajkot' => 'rajkot'], request('city'),['class'=>'form-control form-control-sm' , 'id'=>'myDropdown']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-sm ordertable">
                            <thead>
                            <tr>
                                <th scope="col">Package</th>
                                <th scope="col">Categories</th>
                                <th scope="col">Service</th>
                                <th scope="col">Address</th>
                                <th scope="col">City</th>
                                <th scope="col">State</th>
                                <th scope="col">Zipcode</th>
                                <th scope="col">Date</th>
                                <th class="text-right" scope="col">Action</th>
                            </tr>
                            </thead>
                            @if(count($orders) != 0)
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->package}}</td>
                                        <td>{{$order->categories}}</td>
                                        <td>{{$order->service}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>{{$order->city}}</td>
                                        <td>{{$order->state}}</td>
                                        <td>{{$order->zipcode}}</td>
                                        <td>{{$order->appointment_time}}</td>
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
                                                           href="{{route('online.edit',$order->id)}}">
                                                            <i class="fa fa-edit"> </i> Edit
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item  delete_pop text-danger"
                                                           href="#"
                                                           data-href="{{route('online.delete',$order->id)}}">
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
                                    <td colspan="9" class="text-center">
                                        <h6 class="text-danger text-bold  pt-2">No Data Found</h6>
                                    </td>
                                </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="pagination pagination-sm  float-right">
                            {{ $orders->links() }}
                        </div>
                        @if(request('search') != '' || request('city') != '')
                            <i class="fa fa-filter"></i> {{ $orders->total()}} Records Match
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
            $('.delete_pop').click(function () {
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
            $('#myDropdown').change(function () {
                $('.search-btn').trigger('click');
            });
            $('.clear').click(function () {
                $('#search').val('');
                $('#myDropdown').val('');
                $('.search-btn').trigger('click');
            });
            @if (\Session::has('update'))
            toastr.success('your order has been updated');
            {{\Session::forget('update')}}
            @endif
        });
    </script>
@endsection
