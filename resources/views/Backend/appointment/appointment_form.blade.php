@extends ('Backend.layout.index')
@section("title")
    Appointment Form
@endsection
@section("content")
    <section class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Appointment</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item text-secondary"><a href="{{route('admin.appointment.index')}}">
                                    Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.appointment.index')}}">
                                    Appointment</a>
                            </li>
                            <li class="breadcrumb-item text-secondary">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
            @if($editMode)
                {!!  Form::model($appointment, ['route' => ['admin.appointment.update', 'id' => $appointment->id], 'method'=>'put']) !!}
            @else
                {{ Form::open(['route' => ['admin.appointment.store'], 'method'=>'post']) }}
            @endif
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2">
                                <a class="btn btn-default btn-sm btn-block" href="{{route('admin.appointment.index')}}">
                                    Back
                                </a>
                            </li>
                            <li>
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Save</button>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>

        <div class="w-100">
            <div class="card  mx-3">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category</label>
                                {!! Form::text('categories', null,['class'=>' form-control form-control-sm','id'=>'cat_type' , 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputStatus">Service</label>
                                {!! Form::select('service', ['' => 'Select one', 'Haircut & Styling' => 'Haircut & Styling', 'Color & Highlights' => 'Color & Highlights', 'Facials & Skin Treatments' => 'Facials & Skin Treatments', 'Nail Art' => 'Nail Art', 'Beard Wash & Care' => 'Beard Wash & Care'], null, ['class' => 'form-control custom-select-sm']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputStatus">Type</label>
                                {!! Form::select('type', ['' => 'Select one', 'appointment' => 'appointment', 'order' => 'order'], ($editMode) ? $type : null, ['class' => 'form-control custom-select-sm']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date and Time</label>
                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                    {!! Form::text('date', ($editMode)?$date:null, ['class' => 'form-control form-control-sm datetimepicker-input', 'data-target' => '#reservationdatetime' , 'autocomplete' => 'off']) !!}
                                    <div class="input-group-append" data-target="#reservationdatetime"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputStatus">Status</label>
                                {!! Form::select('status', $status, null, ['class' => 'form-control form-control-sm']) !!}

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </section>

@endsection

@section('custom_js')
    <script>
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd H:i',
            autoclose: true
        });

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        //Date and time picker
        $('#reservationdatetime').datetimepicker({icons: {time: 'far fa-clock'}});

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'Y-m-d H:i:s'
            },
        });

        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
        @endif
    </script>
@endsection
