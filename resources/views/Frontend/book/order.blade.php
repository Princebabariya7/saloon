@extends('Frontend.layout.master')
@section('title')
    Online Booking
@endsection
@section('mainContent')
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h2 class="font-weight-normal">{{ Lang::get('saloon.online_booking') }}</h2>
            </div>
        </div>
    </div>
    <div class="container login-box  d-flex justify-content-center">
        <div class="registration-form">
            @if($editMode)
                {!! Form::model($appointments, ['route' => ['online.update', 'id' => $appointments->id], 'method'=>'put']) !!}
            @else
                {{ Form::open(['route' => ['online.info.store'], 'method'=>'post']) }}
            @endif
            <div class="ap_form">
                <div class="row">
                    <div class="cate col-md-12">
                        <div class="form-group">
                            <label>{{ Lang::get('saloon.category_select') }}</label>
                            <div class="select2-secondary">
                                {!! Form::select('categories[]', $category, ($editMode) ? $category_id : null , ['id'=>'categories', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 service-select">
                        <div class="form-group">
                            <label>{{ Lang::get('saloon.service_select') }}</label>
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
                    <label>{{ Lang::get('saloon.booking_type') }}</label>
                    <div class="col-md-12 text-center mx-auto">
                        <div class="form-check form-check-inline">
                            {{ Form::radio('type', 'Appointment', ($editMode && $type=='Appointment') ? true : null, ['class' => 'form-check-input', 'id' => 'inlineRadio1']) }}
                            <label class="form-check-label ml-2" for="inlineRadio1">{{ Lang::get('saloon.appointments') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            {{ Form::radio('type', 'HomeService', ($editMode && $type=='HomeService') ? true : null, ['class' => 'form-check-input', 'id' => 'inlineRadio2']) }}
                            <label class="form-check-label ml-2" for="inlineRadio2">{{ Lang::get('saloon.home_service') }}</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ Lang::get('saloon.booking_date_form') }}</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        {!! Form::text('date',($editMode) ? $date : null, ['class' => 'form-control appointment-date datetimepicker-input', 'data-target' => '#reservationdate' , 'autocomplete' => 'off']) !!}
                        <div class="input-group-append" data-target="#reservationdate"
                             data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputStatus">{{ Lang::get('saloon.booking_slot') }}</label>
                    <div class="input-group date" id="appointmentTime" data-target-input="nearest">
                        {!! Form::text('time', ($editMode) ? $timeSlot : null, ['id' => 'selectedTimeSlot', 'class' => 'form-control appointment_time', 'data-target' => '#appointmentTime', 'autocomplete' => 'off']) !!}
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="timeSlotModal" tabindex="-1" role="dialog"
                     aria-labelledby="timeSlotModalLabel"
                     aria-hidden="true">
                    {!! Form::hidden('time_slot',  ($editMode) ? $timeSlotid : null, ['id' => 'selectedTimeSlot', 'class' => 'form-control appointment_time', 'data-target' => '#appointmentTime', 'autocomplete' => 'off', 'readonly' => true]) !!}
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="timeSlotModalLabel">
                                    <i class="fa fa-clock"></i> {{ Lang::get('saloon.time_slot_select') }}
                                    <span class="badge badge-info slotDay"></span>
                                </h5>
                            </div>
                            <div class="modal-body" id="timeSlotModalBody">
                                <div class="list-group" id="date-slot">
                                    @if($timeSlots == null)
                                        <h6 class="modal-title text-danger font-weight-bold" id="timeSlotModalLabel">
                                            {{ Lang::get('saloon.select_book_date') }}</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" id="saveButton" class="btn btn-primary btn-sm simple_btn">{{ Lang::get('saloon.confirm_booking') }}
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('custom_js')
    <script>
        @if ($errors -> any())
        @foreach($errors -> all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
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
        $('#saveButton').on('click', function () {

            if ($(this).hasClass('disabled'))
            {
                return false;
            }
            $(this).addClass('disabled').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        });
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#categories').change(function () {
                $('#services').attr('disabled', false);
                var id = $(this).val();
                var url = "{{ route('online.fetch.services') }}";
                $.post(url, {id: id})
                    .done(function (data) {
                        var services = data.services;
                        let service_dom = $('#services');
                        service_dom.children().remove()
                        $.each(services, function (key, value) {
                            service_dom.append($("<option></option>")
                                .attr("value", key)
                                .addClass('options-' + key)
                                .text(value));
                            @if ($editMode)
                            if (key == {{$service_id}})
                            {
                                service_dom.find('.options-' + key).attr('selected', 'selected')
                            }
                            @endif
                        });
                    }).fail(function () {
                    alert("error");
                })
            });
            @if ($editMode)
            $('#categories').trigger('change')
            @endif
            $('#appointmentTime').on('click', function () {
                $('#timeSlotModal').modal('show');
                var currentTime = moment();
                var currentTimeformate = moment().format('MM/DD/YYYY');
                var date = $('.appointment-date').val();
                $('#timeSlotModalBody .time_remove').each(function () {
                    var timeSlot = $(this).text();
                    var slotTime = moment(timeSlot.split('-')[0].trim(), 'h:mm A');
                    if (date == currentTimeformate)
                    {
                        if (currentTime.isAfter(slotTime))
                        {
                            $(this).find('input').remove();
                            $(this).find('label').html('<i class="fa fa-ban text-danger"></i>' + $(this).find('label').text());
                        }
                    }
                });
            });
        });
        $(document).ready(function () {
            $("#reservationdate").on("change.datetimepicker", ({date, oldDate}) => {
                $('#selectedTimeSlot').val(null);
                AjaxTimeSlot();
            })
            @if ($editMode)
            AjaxTimeSlot();
            @endif
        });
        function AjaxTimeSlot()
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('online.fetch.timeslot') }}",
                data: {
                    date: $('.appointment-date').val()
                },
                success: function (data) {
                    $('#date-slot').empty().html(data.slotHtml)
                },
            });
        }
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
