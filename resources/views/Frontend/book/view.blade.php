@extends('Frontend.layout.master')
@section('title')
    order list
@endsection
@section('mainContent')
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="login_logo font-weight-normal">{{ Lang::get('saloon.order_list') }}</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <section class="content">
            <div class="container-fluid">
                <div class="card my-5">
                    <div class="card-header">
                        {!! Form::open(['route' => ['online.index'], 'method'=>'get', 'id' => 'filter', 'class' => 'form-inline m-0', 'autocomplete' => 'off']) !!}
                        <ul class="nav nav-pills nav-search pt-1">
                            <li class="nav-item mr-1">
                                <div class="input-group mb-1">
                                    {!! Form::text('search', request('search'),['id' => 'search', 'class' => 'h-auto form-control form-control-sm inline','placeholder' => 'Search','autocomplete' =>'off']) !!}
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-secondary search-btn" type="submit">
                                            <i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="nav nav-pills  ml-auto">
                            <li class="nav-item mt-1 mb-1 mr-1">
                                {!! Form::select('status',[''=>'Please Select' ,'Pending' => 'Pending','Success' => 'Success','Cancel' => 'Cancel'], request('status'),['class'=>'form-control form-control-sm' , 'id'=>'myDropdown']) !!}
                            </li>
                        </ul>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-sm ordertable">
                            <thead>
                            <tr>
                                <th>@sortablelink('users.firstname',__('saloon.user_name'))</th>
                                <th>@sortablelink('categories.type', __('saloon.category'))</th>
                                <th>@sortablelink('services.name', __('saloon.service_name'))</th>
                                <th>
                                    {{ Lang::get('saloon.type') }}
                                </th>
                                <th>
                                    {{ Lang::get('saloon.app_date') }}
                                </th>
                                <th>
                                    {{ Lang::get('saloon.time') }}
                                </th>
                                <th class="text-center">
                                    {{ Lang::get('saloon.status') }}
                                </th>
                                <th class="text-center pr-0">Action</th>
                            </tr>
                            </thead>
                            @if(count($appointments) != 0)
                                <tbody>
                                @foreach($appointments as $detail)
                                    <tr>
                                        <td>{{$detail->getUsername()}}</td>
                                        <td>{{$detail->category}}</td>
                                        <td>{{$detail->name}}</td>
                                        <td>{{$detail->type}}</td>
                                        <td>{{$detail->date}}</td>
                                        <td>{{$detail->time}}</td>
                                        <td>
                                            @if($detail->status =='Pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($detail->status =='Success')
                                                <span class="badge badge-success">Success</span>
                                            @elseif($detail->status =='Cancel')
                                                <span class="badge badge-danger">Cancel</span>
                                            @endif
                                        </td>
                                        @if($detail->date > $currentDate->toDateString())
                                            <td class="project-actions text-right">
                                                <button type="button"
                                                        class="btn btn-light border btn-sm dropdown-toggle"
                                                        data-bs-toggle="dropdown">
                                                    Action
                                                </button>
                                                <div>
                                                    <ul class="dropdown-menu">
                                                        @if($detail->status != 'Success')
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="{{route('payment.pending',$detail->id)}}">
                                                                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                                    {{ Lang::get('saloon.make_payment') }}
                                                                </a>
                                                            </li>
                                                            <li class="dropdown-divider"></li>
                                                        @else
                                                        @endif
                                                        @if($detail->status != 'Success')
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="{{route('online.edit',$detail->id)}}">
                                                                    <i class="fa fa-edit"> </i>
                                                                    {{ Lang::get('saloon.edit') }}
                                                                </a>
                                                            </li>
                                                            <li class="dropdown-divider"></li>
                                                        @else
                                                        @endif
                                                        <li>
                                                            <a class="dropdown-item  delete_pop text-danger"
                                                               href="#"
                                                               data-href="{{route('online.delete',$detail->id)}}">
                                                                <i class="fa fa-trash"></i>
                                                                {{ Lang::get('saloon.delete') }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        @else
                                            <td class="project-actions text-right">
                                                <button type="button"
                                                        class="btn btn-light border btn-sm dropdown-toggle modelBtn mr-0"
                                                        data-bs-toggle="dropdown">
                                                    Action
                                                </button>
                                                <div class="action-btn">
                                                    <ul class="dropdown-menu">
                                                        @if($detail->status != 'Success')
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="{{route('payment.pending',$detail->id)}}">
                                                                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                                    {{ Lang::get('saloon.make_payment') }}
                                                                </a>
                                                            </li>
                                                            <li class="dropdown-divider"></li>
                                                            <li>
                                                                <a class="dropdown-item" data-target="#exampleModal"
                                                                   data-toggle="modal"
                                                                   href="{{route('online.edit',$detail->id)}}">
                                                                    <i class="fa fa-edit"> </i>
                                                                    {{ Lang::get('saloon.edit') }}
                                                                </a>
                                                            </li>
                                                            <li class="dropdown-divider"></li>
                                                        @else
                                                        @endif
                                                        <li>
                                                            <a class="dropdown-item delete_pop text-danger"
                                                               href="#"
                                                               data-href="{{route('online.delete',$detail->id)}}">
                                                                <i class="fa fa-trash"></i>
                                                                {{ Lang::get('saloon.delete') }}
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
        @if (\Session::has('msg'))
        toastr.success("{{ Lang::get('saloon.your_order_booked') }}");
        {{ \Session::forget('msg') }}
        @endif
        $(document).ready(function () {
            $('.delete_pop').click(function () {
                var $_this = $(this);
                Swal.fire({
                    title: '{{ Lang::get('saloon.are_you_sure') }}',
                    text: '{{ Lang::get('saloon.delete_confirmation') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ Lang::get('saloon.delete_confirmation_title') }}'
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
            toastr.success('{{ Lang::get('saloon.update_message') }}');
            {{ \Session::forget('update') }}
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
