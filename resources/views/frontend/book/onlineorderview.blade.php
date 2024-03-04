@php use App\Models\Category; @endphp
@extends('frontend.layout.master')
@section('title')
    order list
@endsection
@section('mainContent')
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="login_logo font-weight-normal">Appointment List</h1>
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
                                {!! Form::select('status',[''=>'Please Select' ,'Pending' => 'Pending','Success' => 'Success','Cancel' => 'Cancel'], request('status'),['class'=>'form-control form-control-sm' , 'id'=>'myDropdown']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-sm ordertable">
                            <thead>
                            <tr>
                                <th>@sortablelink('users.firstname','Name')</th>
                                <th>@sortablelink('categories.type', 'Category')</th>
                                <th>@sortablelink('services.name', 'Service')</th>
                                <th scope="col">Type</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Status</th>
                                <th class="text-right" scope="col">Action</th>
                            </tr>
                            </thead>
                            @if(count($appointments) != 0)
                                <tbody>
                                @foreach($appointments as $appointment)
                                    <tr>
                                        <td>{{auth()->user()->firstname}}</td>
                                        <td>{{Category::find($appointment->services->category_id)->type}}</td>
                                        <td>{{$appointment->services->name}}</td>
                                        <td>{{$appointment->appointment->type}}</td>
                                        <td>{{$appointment->appointment->date}}</td>
                                        <td>{{$appointment->appointment->time}}</td>
                                        <td>
                                            @if($appointment->appointment->status =='Pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($appointment->appointment->status =='Success')
                                                <span class="badge badge-success">Success</span>
                                            @elseif($appointment->appointment->status =='Cancel')
                                                <span class="badge badge-danger">Cancel</span>
                                            @endif
                                        </td>
                                        @if($appointment->appointment->date > $currentDate->toDateString())
                                            <td class="project-actions text-right">
                                                <button type="button"
                                                        class="btn btn-light border btn-sm dropdown-toggle"
                                                        data-bs-toggle="dropdown">
                                                    Action
                                                </button>
                                                <div>
                                                    <ul class="dropdown-menu">
                                                        @if($appointment->appointment->status != 'Success')
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="{{route('payment.pending',$appointment->id)}}">
                                                                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                                    Make Payment
                                                                </a>
                                                            </li>
                                                            <li class="dropdown-divider"></li>
                                                        @else
                                                        @endif
                                                        @if($appointment->appointment->status != 'Success')
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="{{route('online.edit',$appointment->id)}}">
                                                                    <i class="fa fa-edit"> </i> Edit
                                                                </a>
                                                            </li>
                                                            <li class="dropdown-divider"></li>
                                                        @else
                                                        @endif
                                                        <li>
                                                            <a class="dropdown-item  delete_pop text-danger"
                                                               href="#"
                                                               data-href="{{route('online.delete',$appointment->id)}}">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        @else
                                            <td class="project-actions text-right">
                                                <button type="button"
                                                        class="btn btn-light border btn-sm dropdown-toggle modelBtn"
                                                        data-bs-toggle="dropdown">
                                                    Action
                                                </button>
                                                <div class="action-btn">

                                                    <ul class="dropdown-menu">
                                                        @if($appointment->appointment->status != 'Success')
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="{{route('payment.pending',$appointment->id)}}">
                                                                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                                    Make Payment
                                                                </a>
                                                            </li>
                                                            <li class="dropdown-divider"></li>
                                                        @else
                                                        @endif
                                                        <li>
                                                            <a class="dropdown-item" data-target="#exampleModal"
                                                               data-toggle="modal"
                                                               href="{{route('online.edit',$appointment->id)}}">
                                                                <i class="fa fa-edit"> </i> Edit
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item  delete_pop text-danger"
                                                               href="#"
                                                               data-href="{{route('online.delete',$appointment->id)}}">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="p-3 bg-danger">
                                                                <h5 class="modal-title text-light text-center"
                                                                    id="exampleModalLabel">This Appointment Can't Be
                                                                    Changable
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
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
                            {{ $appointments->appends(request()->input())->links() }}
                        </div>
                        @if(request('search') != '' || request('status') != '')
                            <i class="fa fa-filter"></i> {{ $appointments->total()}} Records Match
                            <a href="#" class="btn-link clear">Clear</a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('custom_js')
    <script>
        @if (\Session:: has('msg'))
        toastr.success('your order has been booked');
        {{\Session::forget('msg')}}
        @endif
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
            @if (\Session::has('update'))
            toastr.success('your order has been updated');
            {{\Session::forget('update')}}
            @endif
            $('#myDropdown').change(function () {
                $('.search-btn').trigger('click');
            });
            $('.clear').click(function () {
                $('#search').val('');
                $('#myDropdown').val('');
                $('.search-btn').trigger('click');
            });
        });
    </script>
@endsection
