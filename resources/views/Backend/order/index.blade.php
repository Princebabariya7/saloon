@extends ('Backend.layout.index')
@section("title")
    Order
@endsection

@section("content")
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <h1><i class="fas fa-shopping-cart"></i> Orders </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard.index')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline">
                    <div class="card-header">

                        {!! Form::open(['route' => ['admin.order.index'], 'method'=>'get', 'id' => 'filter', 'class' => 'form-inline m-0', 'autocomplete' => 'off']) !!}

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
                                {!! Form::select('status',[''=>'Please select', 'Active'=>'Active', 'Inactive'=>'Inactive'], request('status'),['class'=>'form-control form-control-sm', 'id'=>'status']) !!}
                            </li>
                        </ul>

                        {!! Form::close() !!}
                    </div>

                    <div class="card-body table-responsive p-0 ">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th>
                                    Id
                                </th>
                                <th>
                                    Data/Time
                                </th>
                                <th>
                                    Customer
                                </th>
                                <th>
                                    Address
                                </th>
                                <th>
                                    Service
                                </th>
                                <th>
                                    Mode
                                </th>
                                <th class="text-center">
                                    Amount
                                </th>
                                <th class="text-center">
                                    Status
                                </th>
                                <th class="text-end">
                                    Action
                                </th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <td colspan="8" class="text-center">
                                    <h5 class="text-danger text-bold">No Data Found</h5>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

