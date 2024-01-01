@extends('layout.master')
@section('title')
    order
@endsection
@section('mainContent')
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="login_logo font-weight-normal">Online Booking</h1>
            </div>
        </div>
    </div>
    <div class="container login-box  d-flex justify-content-center">
        <div class="registration-form">
            @if($editMode)
                {!!  Form::model($online, ['route' => ['online.update', 'id' => $online->id], 'method'=>'put']) !!}
            @else
                {{ Form::open(['route' => ['online.info.store'], 'method'=>'post']) }}
            @endif
            <div class="ap_form>">
                <div class="form-group">
                    <label>Select package</label>
                    {!! Form::select('package[]',['hair'=>'Hair','beard'=>'Beard','nail'=>'Nail','pedicure'=>'Pedicure'],($editMode) ? $package : null,['class'=>'select2','multiple'=>'multiple', 'style'=>'width: 100%;']) !!}
                </div>


                <div class="text-center">
                    <div class="form-group m-0">
                        <label>-OR-</label>
                    </div>
                </div>
                <div class="cate">
                    <div class="form-group">
                        <label>Select categories</label>
                        {!! Form::select('categories[]',['hair'=>'Hair','beard'=>'Beard','nail'=>'Nail','pedicure'=>'Pedicure'],($editMode) ? $categories : null,['class'=>'select2','multiple'=>'multiple', 'style'=>'width: 100%;']) !!}
                    </div>
                </div>
                <div class="ser">
                    <div class="form-group">
                        <label>Select service</label>
                        {!! Form::select('service[]',['hair'=>'Hair','beard'=>'Beard','nail'=>'Nail','pedicure'=>'Pedicure'],($editMode) ? $service : null,['class'=>'select2','multiple'=>'multiple', 'style'=>'width: 100%;']) !!}
                    </div>
                </div>
                <div class="dropdown-divider"> </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="inputDescription">Address</label>
                        {!! Form::textarea('address',null,['class'=>'form-control','rows'=>'4', 'style'=>'width: 100%;']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>City</label>
                            {!! Form::select('city', ['' => 'Select one', 'ahmedabad' => 'ahmedabad','rajkot' => 'rajkot'], null, ['class' => 'form-control select2bs4','style'=>'width: 100%;']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>State</label>
                            {!! Form::select('state', ['' => 'Select one', 'gujrat' => 'gujrat','pune' => 'pune'], null, ['class' => 'form-control select2bs4','style'=>'width: 100%;']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="zipcode">Zipcode</label>
                            {{--                            <input type="number" class="form-control" id="zipcode" placeholder="" name="zipcode">--}}
                            {!! Form::number('zipcode',  null, ['class' => 'form-control','style'=>'width: 100%;']) !!}
                        </div>
                    </div>
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
                    <button class="btn btn-primary btn-md simple_btn" type="submit">Confirm Booking</button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="social-media">
                <label>after sometime
                    <br>we send conformation mail</label>
            </div>
        </div>
    </div>
@endsection
@section('custom_js')
    <script>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
        @endif
        @if (\Session::has('msg'))
        Swal.fire({
            title: "Your order has been confirmed",
            text: " Check your email for more detail",
            icon: "success"
        });
        {{\Session::forget('msg')}}
        @endif
    </script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('Y-m-d', {
                'placeholder': 'Y-m-d'
            })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('Y-m-d', {
                'placeholder': 'Y-m-d'
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
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'Y-m-d H:i:s'
                }
            })

        })

    </script>
@endsection
