@extends ('Backend.layout.index')
@section("title")
    Appointments
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-9">
                        <h1><i class="fas fa-calendar-check"></i> Appointments </h1>
                    </div>
                    <div class="col-sm-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard.index')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Appointments</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        {!! Form::open(['route' => ['admin.appointment.index'], 'method'=>'get', 'id' => 'filter', 'class' => 'form-inline m-0', 'autocomplete' => 'off']) !!}

                        <ul class="nav nav-pills nav-search pt-1">

                            <li class="nav-item mr-1">
                                <div class="input-group mb-1">
                                    {!! Form::text('search', request('search'),['id' => 'search', 'class' => 'h-auto form-control form-control-sm inline','autofocus']) !!}
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-sm btn-default  search">
                                            <i class="fas fa-search"></i></button>
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="nav nav-pills  ml-auto">
                            <li class="nav-item mt-1 mb-1 mr-1">
                                {!! Form::text('daterange', request('anotherInput') , ['class' => 'form-control form-control-sm float-right', 'id' => 'reservation', 'placeholder' => 'Select Date']) !!}
                                {!! Form::hidden('anotherInput', request('anotherInput') , ['id'=>'anotherInput' , 'placeholder'=>'Selected Date Range']) !!}
                            </li>

                            <li class="nav-item mt-1 mb-1 mr-1">
                                {!! Form::select('type',[''=>'Select Type', 'HomeService'=>'HomeService', 'Appointment'=>'Appointment'], request('type'),['class'=>'form-control form-control-sm', 'id'=>'type']) !!}
                            </li>
                            <li class="nav-item mt-1 mb-1 mr-1">
                                {!! Form::select('status',[''=>'Select Status', 'Pending'=>'Pending', 'Success'=>'Success', 'Cancel'=>'Cancel'], request('status'),['class'=>'form-control form-control-sm', 'id'=>'status']) !!}
                            </li>
                            <li class="nav-item mt-1 mb-1 mr-1">
                                <a class="btn btn-primary btn-sm float-right"
                                   href="{{route('admin.appointment.create')}}">
                                    <i class="fa fa-plus">
                                    </i>
                                    Add
                                </a>
                            </li>
                        </ul>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-body table-responsive p-0 ">
                        <table class="table table-striped table-sm projects">
                            <thead>
                            <tr>
                                <th class="text-center">@sortablelink('users.firstname',__('saloon.user_name'))</th>
                                <th class="text-center">@sortablelink('categories.type', __('saloon.category'))</th>
                                <th class="text-center">@sortablelink('services.name', __('saloon.service_name'))</th>
                                <th class="text-center">
                                    Type
                                </th>
                                <th class="text-center">
                                    Booking Date
                                </th>
                                <th class="text-center">
                                    Appointment Date
                                </th>
                                <th class="text-center">
                                    Time
                                </th>
                                <th class="text-center">
                                    Status
                                </th>
                                <th class="text-center">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            @if(count($appointments) > 0)
                                <tbody>
                                @foreach($appointments as $detail)

                                    <tr>
                                        <td class="text-center">
                                            {{$detail->getUsername()}}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('admin.appointment.edit',$detail->id)}}">
                                                {{ $detail->category }}
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            {{$detail->name}}
                                        </td>
                                        <td class="text-center">
                                            {{$detail->type}}
                                        </td>
                                        <td class="text-center">
                                            {{$detail->created_at}}
                                        </td>
                                        <td class="text-center">
                                            {{$detail->date}}
                                        </td>
                                        <td class="text-center">
                                            {{$detail->time}}
                                        </td>
                                        <td class="project-state text-center">
                                            @if($detail->status =='Pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($detail->status =='Success')
                                                <span class="badge badge-success">Success</span>
                                            @elseif($detail->status =='Cancel')
                                                <span class="badge badge-danger">Cancel</span>
                                            @endif
                                        </td>
                                        <td class="project-actions text-center">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                                    data-bs-toggle="dropdown">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item small"
                                                       href="{{route('admin.appointment.show',$detail->id)}}">
                                                        <i class="fa fa-eye"> </i> View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item small"
                                                       href="{{route('admin.appointment.edit',$detail->id)}}">
                                                        <i class="fa fa-pen"> </i> Edit
                                                    </a>
                                                </li>
                                                @if($detail->status != 'Success')
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item small"
                                                           href="{{route('admin.payment.pending',$detail->id)}}">
                                                            <i class="fas fa-credit-card"></i> Payment
                                                        </a>
                                                    </li>
                                                @else
                                                @endif
                                                <li class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item small appointment-delete text-danger"
                                                       href="#"
                                                       data-href="{{route('admin.appointment.delete',$detail->id)}}">
                                                        <i class="fa fa-trash"></i> Cancel
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @else
                                <tfoot>
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <h5 class="text-danger text-bold">No Data Found</h5>
                                    </td>
                                </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>

                    <div class="card-footer">
                        <div class="pagination pagination-sm float-right">
                            {{ $appointments->appends(request()->input())->links() }}
                        </div>
                        <div class="clear-btn">
                            @if(request('search') != '' || request('status') != '' || request('type') != '' || request('anotherInput') != '')
                                <i class="fa fa-filter"></i> {{ $appointments->total()}} Records Match
                                <button type="button" class="btn btn-sm btn-link" id="btn-clear-filters">
                                    Clear
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function () {
            $('.appointment-delete').click(function () {
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

            $('#status, #type').change(function () {
                $('.search').trigger('click');
            });

            $('#btn-clear-filters').click(function () {
                $('#search').val('');
                $('#anotherInput').val('');
                $('#status, #type').val('');
                $('.search').trigger('click');
            });
            $('#reservation').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('#reservation').on('apply.daterangepicker', function (ev, picker) {
                var startDate = picker.startDate.format('MM/DD/YYYY');
                var endDate = picker.endDate.format('MM/DD/YYYY');

                $('#anotherInput').val(startDate + ' - ' + endDate);

                $('#filter').submit();
            });

        });
        @if (\Session::has('add'))
        toastr.success({{ Lang::get('saloon.success') }});
        {{ \Session::forget('add') }}
        @endif
        @if (\Session::has('update'))
        toastr.success('Your Data Has Successfully Updated!');
        {{ \Session::forget('update') }}
        @endif
        @if (\Session::has('paymentmsg'))
        toastr.success('payment accepted');
        {{\Session::forget('paymentmsg')}}
        @endif
    </script>
@endsection
