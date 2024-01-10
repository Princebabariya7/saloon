@extends ('Backend.layout.index')
@section("title")
    Package
@endsection
@section("content")
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <h1><i class="fas fas fa-box"></i> Packages </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard.index')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Packages</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline">
                    <div class="card-header">

                        {!! Form::open(['route' => ['admin.package.index'], 'method'=>'get', 'id' => 'filter', 'class' => 'form-inline m-0', 'autocomplete' => 'off']) !!}

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

                            <li class="nav-item mt-1 mb-1 mr-1">
                                <a class="btn btn-primary btn-sm float-right"
                                   href="{{route('admin.package.create')}}">
                                    <i class="fa fa-plus">
                                    </i>
                                    Add
                                </a>
                            </li>

                        </ul>

                        {!! Form::close() !!}
                    </div>

                    <div class="card-body table-responsive p-0 ">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    Detail
                                </th>
                                <th>
                                    Duration
                                </th>
                                <th class="text-center">
                                    Status
                                </th>
                                <th class="text-right">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            @if(count($packages) > 0)
                                <tbody>
                                @foreach($packages as $package)
                                    <tr>
                                        <td>
                                            <a href="{{route('admin.package.edit',$package->id)}}">
                                            {{$package->name}}
                                            </a>
                                        </td>
                                        <td>
                                            {{$package->price}}
                                        </td>
                                        <td class="detail">
                                            {{$package->detail}}

                                        </td>
                                        <td>
                                            {{$package->duration}}
                                        </td>
                                        <td class="project-state">

                                            @if($package->status =='Active')

                                                <span class="badge badge-success">Active</span>

                                            @else
                                                <span class="badge badge-danger">Inactive</span>

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
                                                       href="{{route('admin.package.show',$package->id)}}">
                                                        <i class="fa fa-eye"> </i> View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item  small "
                                                       href="{{route('admin.package.edit',$package->id)}}">
                                                        <i class="fa fa-pen"> </i> Edit
                                                    </a>
                                                </li>
                                                <li class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item small package-delete text-danger"
                                                       href="#"
                                                       data-href="{{route('admin.package.delete',$package->id)}}">
                                                        <i class="fa fa-trash"> </i> Delete
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
                            {{ $packages->links() }}
                        </div>
                        <div class="clear-btn">
                            @if(request('search') != '' || request('status') != '')
                                <i class="fa fa-filter"></i> {{ $packages->total()}} Records Match

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
            $('.package-delete').click(function () {
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
            $('#status').change(function () {
                $('.search').trigger('click');
            });
            $('#btn-clear-filters').click(function () {
                $('#search').val('');
                $('#status').val('');
                $('.search').trigger('click');
            })
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
