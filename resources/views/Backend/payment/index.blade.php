@extends ('Backend.layout.index')
@section("title")
    Payments
@endsection
@section("content")
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <h1><i class="fas fa-credit-card"></i> Payments </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard.index')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Payments</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        {!! Form::open(['route' => ['admin.payment.index'], 'method'=>'get', 'id' => 'filter', 'class' => 'form-inline m-0', 'autocomplete' => 'off']) !!}
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
                                {!! Form::select('status',[''=>'Please select', 'Pending'=>'Pending', 'Success'=>'Success', 'Cancel'=>'Cancel'], request('status'),['class'=>'form-control form-control-sm', 'id'=>'status']) !!}
                            </li>
                        </ul>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-body table-responsive p-0 ">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th>
                                    @sortablelink('buyer_name','Customer Name')
                                </th>
                                <th>
                                    @sortablelink('buyer_email','Email')
                                </th>
                                <th>
                                    @sortablelink('transaction_id','TransactionId')
                                </th>
                                <th>
                                    @sortablelink('transaction_detail','Amount')
                                </th>
                                <th class="text-center">
                                    @sortablelink('status','Status')
                                </th>
                                <th class="text-right">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            @if(count($payments) > 0)
                                <tbody>
                                @foreach($payments as $payment)
                                    <tr>
                                        <td>
                                            <a href="{{route('admin.payment.show',$payment->id)}}">
                                                {{$payment->buyer_name}}
                                            </a>
                                        </td>
                                        <td>
                                            {{$payment->buyer_email}}
                                        </td>
                                        <td>
                                            {{$payment->transaction_id}}
                                        </td>
                                        <td>
                                            <i class="fas fa-rupee-sign"></i> {{$payment->transaction_amount}}
                                        </td>
                                        <td class="project-state">
                                            @if($payment->status =='Pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($payment->status =='Success')
                                                <span class="badge badge-success">Success</span>
                                            @elseif($payment->status =='Cancel')
                                                <span class="badge badge-danger">Cancel</span>
                                            @endif
                                        </td>
                                        <td class="project-actions text-right">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                                    data-bs-toggle="dropdown">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item small"
                                                       href="{{route('admin.payment.show',$payment->id)}}">
                                                        <i class="fa fa-eye"> </i> View
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
                            {{ $payments->links() }}
                        </div>
                        <div class="clear-btn">
                            @if(request('search') != '' || request('status') != '')
                                <i class="fa fa-filter"></i> {{ $payments->total()}} Records Match
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
            $('#status').change(function () {
                $('.search').trigger('click');
            });
            $('#btn-clear-filters').click(function () {
                $('#search').val('');
                $('#status').val('');
                $('.search').trigger('click');
            })
        });
    </script>
@endsection
