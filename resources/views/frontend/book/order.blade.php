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
            <div class="ap_form">
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
                    <label>Preferred booking date</label>

                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        {!! Form::text('date',($editMode) ? $date : null, ['class' => 'form-control datetimepicker-input', 'data-target' => '#reservationdate' , 'autocomplete' => 'off']) !!}
                        <div class="input-group-append" data-target="#reservationdate"
                             data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputStatus">Time Slot</label>
                    <div class="input-group date" id="appointmentTime" data-target-input="nearest">
                        {!! Form::text('time', ($editMode) ? $timeSlot : null, ['id' => 'selectedTimeSlot', 'class' => 'form-control ', 'data-target' => '#customTimeSlotModal','data-toggle'=>'modal', 'autocomplete' => 'off']) !!}
                        <div class="input-group-append" data-target="#customTimeSlotModal"
                             data-toggle="modal">
                            <div class="input-group-text item"><i class="fa fa-clock"></i></div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="customTimeSlotModal" tabindex="-1" role="dialog" aria-labelledby="timeSlotModalLabel" aria-hidden="true">

                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h5 class="modal-title" id="timeSlotModalLabel">Select Time Slot</h5>
                            </div>
                            <div class="modal-body">
                                @php
                                    $timeSlots = ['9:00 AM - 10:00 AM','10:00 AM - 11:00 AM','11:00 AM - 12:00 PM','12:00 PM - 1:00 PM','1:00 PM - 2:00 PM','2:00 PM - 3:00 PM','3:00 PM - 4:00 PM','4:00 PM - 5:00 PM','5:00 PM - 6:00 PM','6:00 PM - 7:00 PM','7:00 PM - 8:00 PM','8:00 PM - 9:00 PM', ];
                                @endphp
                                <ul class="list-group">
                                    @foreach($timeSlots as $timeSlot)
                                        <li class="list-group-item" onclick="selectTimeSlot('{{ $timeSlot }}')">
                                            {{ $timeSlot }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
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

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L',
                minDate: moment(),

            });
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
                                .addClass('options-'+key)
                                .text(value));

                            @if($editMode)
                            if (key == {{$service_id}})
                            {
                                service_dom.find('.options-'+key).attr('selected', 'selected')
                            }
                            @endif
                        });
                    }).fail(function () {
                    alert("error");
                })
            });

            @if($editMode)
            $('#categories').trigger('change')
            @endif

            $('#appointmentTime').on('click', function () {
                // Open the time slot modal
                $('#timeSlotModal').modal('show');
            });
        });

        function selectTimeSlot(timeSlot)
        {
            // Set the selected time slot to the input field
            $('#selectedTimeSlot').val(timeSlot);

            // Set the selected time slot to the hidden field (you can use this hidden field to submit the value to the server)
            $('#selectedTimeSlotHidden').val(timeSlot);

            // Close the modal
            $('#timeSlotModal').modal('hide');
        }
    </script>
@endsection
