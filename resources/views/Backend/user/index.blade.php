@extends ('Backend.layout.index')
@section("title")
    Users
@endsection
@section("content")
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <h1><i class="fas fa-users"></i> Users </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard.index')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        {!! Form::open(['route' => ['admin.user.index'], 'method'=>'get', 'id' => 'filter', 'class' => 'form-inline m-0', 'autocomplete' => 'off']) !!}
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
                                {!! Form::select('status',[''=>'Please select', 'Admin'=>'Admin', 'User'=>'User'], request('status'),['class'=>'form-control form-control-sm', 'id'=>'status']) !!}
                            </li>
                        </ul>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-body table-responsive p-0 ">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th>
                                    @sortablelink('firstname','First Name')
                                </th>
                                <th>
                                    @sortablelink('lastname','Last Name')
                                </th>
                                <th>
                                    @sortablelink('email','Email')
                                </th>
                                <th>
                                    @sortablelink('mobile','Mobile')
                                </th>
                                <th class="text-center">
                                    @sortablelink('status','Status')
                                </th>
                                <th class="text-end action">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            @if(count($users) > 0)
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <a href="{{route('admin.user.show',$user->id)}}">
                                                {{$user->firstname}}
                                            </a>

                                        </td>
                                        <td>
                                            {{$user->lastname}}
                                        </td>
                                        <td>
                                            {{$user->email}}
                                        </td>
                                        <td>
                                            {{$user->mobile}}
                                        </td>
                                        <td class="project-state">
                                            @if($user->user_status =='Admin')
                                                <span class="badge badge-danger">Admin</span>
                                            @else
                                                <span class="badge badge-primary">User</span>
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
                                                       href="{{route('admin.user.show',$user->id)}}">
                                                        <i class="fa fa-eye"> </i> View
                                                    </a>
                                                </li>
                                                <li class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item small"
                                                       href="{{route('admin.user.edit',$user->id)}}">
                                                        <i class="fa fa-pen"> </i> Edit
                                                    </a>
                                                </li>
                                                @if($user->user_status !='Admin')
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item small user-delete text-danger"
                                                           data-href="{{route('admin.user.delete',$user->id)}}">
                                                            <i class="fa fa-trash"> </i> Delete
                                                        </a>
                                                    </li>
                                                @endif
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
                            {{ $users->appends(request()->input())->links() }}
                        </div>
                        <div class="clear-btn">
                            @if(request('search') != '' || request('status') != '')
                                <i class="fa fa-filter"></i> {{ $users->total()}} Records Match

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
        $(document).ready(function () {
            $('.user-delete').click(function () {
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
    </script>
@endsection
