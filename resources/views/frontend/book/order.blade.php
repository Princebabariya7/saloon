@extends('frontend.layout.master')
@section('title')
    order
@endsection
@section('mainContent')
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="font-weight-normal">Online Booking</h1>
            </div>
        </div>
    </div>
    <div class="container login-box  d-flex justify-content-center">
        <div class="registration-form">
            @if($editMode)
                {!!  Form::model($orders, ['route' => ['online.update', 'id' => $orders->id], 'method'=>'put']) !!}
            @else
                {{ Form::open(['route' => ['online.info.store'], 'method'=>'post']) }}
            @endif
            <div class="ap_form>">
                <div class="row">
                    <div class="cate col-md-12">
                        <div class="form-group">
                            <label>Select categories</label>
                            <div class="select2-secondary">
                                {!! Form::select('categories[]', $category, ($editMode) ? $category_id : null , ['id'=>'categories', 'class' => 'form-control']) !!}

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 service-select">
                        <div class="form-group">
                            <label>Select service</label>
                            @if($editMode)
                                <div class="select2-secondary">
                                    {!! Form::select('service_id[]', [],   $service_id, ['id'=>'services', 'class' => 'form-control', 'disabled'=>true]) !!}
                                </div>
                            @else
                                <div class="select2-secondary">
                                    {!! Form::select('service_id[]', [],  ($editMode) ? $service_id : null , ['id'=>'services', 'class' => 'form-control  custom-select-sm select2',  'multiple'=>'multiple', 'disabled'=>true]) !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="dropdown-divider"></div>

                <div class="form-group clearfix">
                    <label>Preferred booking type</label>
                    <div class="col-md-12 text-center mx-auto">
                        <div class="form-check form-check-inline">
                            {{ Form::radio('type', 'Appointment', false, ['class' => 'form-check-input', 'id' => 'inlineRadio1']) }}
                            <label class="form-check-label ml-2" for="inlineRadio1">Appointment</label>
                        </div>
                        <div class="form-check form-check-inline">
                            {{ Form::radio('type', 'HomeService', false, ['class' => 'form-check-input', 'id' => 'inlineRadio2']) }}
                            <label class="form-check-label ml-2" for="inlineRadio2">HomeService</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Preferred booking date and time</label>

                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                        {!! Form::text('date', ($editMode) ? $date : null, ['class' => 'form-control datetimepicker-input', 'data-target' => '#reservationdatetime','autocomplete'=>'off']) !!}
                        <div class="input-group-append" data-target="#reservationdatetime"
                             data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm simple_btn" type="submit">Confirm Booking</button>
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
        toastr.success('your order has been booked');
        {{\Session::forget('msg')}}
        @endif
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

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#categories').change(function () {

                $('#services').attr('disabled', false);

                var id = $(this).val();
                var url = "{{ route('admin.fetch.services') }}";

                $.post(url, {id: id})
                    .done(function (data) {
                        var services = data.services;
                        let service_dom = $('#services');
                        service_dom.children().remove()
                        $.each(services, function (key, value) {
                            service_dom.append($("<option></option>")
                                .attr("value", key)
                                .text(value));
                        });
                    }).fail(function () {
                    alert("error");
                })
            });
                @if($editMode)
            {
                $('#categories').trigger('change')
            }
            @endif
        });
    </script>
@endsection
