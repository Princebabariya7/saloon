@extends('layout.master')
@section('title')
    appointment
@endsection
@section('mainContent')
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="login_logo font-weight-normal">Book Appointment</h1>
            </div>
        </div>
    </div>
    <div class="registration-form">
        @if($editMode)
            {!!  Form::model($appointment, ['route' => ['appointment.update', 'id' => $appointment->id], 'method'=>'put']) !!}
        @else
            {{ Form::open(['route' => ['appointment.info.store'], 'method'=>'post']) }}
        @endif
        <div class="ap_form>">
            <div class="form-group">
                <label for="inputStatus">Select package</label>
                {!! Form::select('package[]',['hair'=>'Hair','beard'=>'Beard','nail'=>'Nail','pedicure'=>'Pedicure'],($editMode) ? $package : null,['class'=>'select2','multiple'=>'multiple', 'style'=>'width: 100%;']) !!}
            </div>
            <div class="form-group">
                <label for="inputStatus">if possible, i prefer my appointment to be with</label>
                {!! Form::select('stylist', ['' => 'Select one', 'Alaska' => 'Alaska','California' => 'California','Delaware' => 'Delaware','Texas' => 'Texas',], null, ['class' => 'form-control custom-select']) !!}
            </div>
            <div class="form-group">
                <label>Preferred booking date and time</label>
                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                    {!! Form::text('appointment_time', ($editMode) ? $appointment_time : null, ['class' => 'form-control datetimepicker-input', 'data-target' => '#reservationdatetime']) !!}
                    <div class="input-group-append" data-target="#reservationdatetime"
                         data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-md simple_btn" type="submit">Book my appointment</button>
            </div>
            {!! Form::close() !!}
        </div>

        <div class="social-media">
            <label>Also Call Us For Appointment
                <br>
                +91 99952 52456</label>
        </div>
    </div>
@endsection
@section('custom_js')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

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
            $('#reservationdatetime').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });

            //Date range picker
            $('#reservation').daterangepicker()
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'YYYY-MM-DD hh:mm A'
                }
            })
        })
    </script>
    <script>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
        @endif
    </script>
@endsection
