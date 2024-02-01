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
                                <label for="inputStatus">Category</label>
                                <div class="select2-primary">
                                    {!! Form::select('categories[]', $category, ($editMode) ? $category_id : null , ['id'=>'categories', 'class' => 'form-control form-control-sm']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputStatus">Service</label>
                                <div class="select2-primary">
                                    @if($editMode)
                                        {!! Form::select('service_id[]', [],  ($editMode) ? $service_id : null , ['id'=>'services', 'class' => 'form-control form-control-sm custom-select-sm',  'disabled'=>true]) !!}
                                    @else
                                        {!! Form::select('service_id[]', [],  null , ['id'=>'services', 'class' => 'form-control form-control-sm custom-select-sm select2',  'multiple'=>'multiple', 'disabled'=>true]) !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    {!! Form::text('date',($editMode) ? $date : null, ['class' => 'form-control form-control-sm appointment-date datetimepicker-input', 'data-target' => '#reservationdate' , 'autocomplete' => 'off']) !!}
                                    <div class="input-group-append" data-target="#reservationdate"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputStatus">Time Slot</label>
                                <div class="input-group date" id="appointmentTime" data-target-input="nearest">
                                    {!! Form::text('time', ($editMode) ? $timeSlot : null, ['id' => 'selectedTimeSlot', 'class' => 'form-control form-control-sm appointment_time', 'data-target' => '#appointmentTime', 'autocomplete' => 'off']) !!}
                                    <div class="input-group-append">
                                        <div class="input-group-text" style="cursor: pointer;"><i
                                                class="fa fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="timeSlotModal" tabindex="-1" role="dialog"
                             aria-labelledby="timeSlotModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="timeSlotModalLabel">Select Time Slot</h5>
                                    </div>
                                    <div class="modal-body" id="timeSlotModalBody">
                                        <ul class="list-group" id="date-slot">
                                            @if($timeSlots == null)
                                                <h6 class="modal-title text-danger" id="timeSlotModalLabel">Please
                                                    Select Date</h6>
                                            @endif
                                        </ul>

                                        <div class="fatch">
                                            {!! Form::hidden('time_slot',  ($editMode) ? $timeSlotid : null, ['id' => 'selectedTimeSlot', 'class' => 'form-control appointment_time fatch_data', 'data-target' => '#appointmentTime', 'autocomplete' => 'off', 'readonly' => true]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputStatus">Type</label>
                                {!! Form::select('type', ['' => 'Select one', 'Appointment' => 'Appointment', 'HomeService' => 'HomeService'], ($editMode) ? $type : null, ['class' => 'form-control custom-select-sm']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
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
        $('.select2').select2()

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L',
            minDate: moment(),

        });


        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
        @endif

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
                                .addClass('options-' + key)
                                .text(value));

                            @if($editMode)
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

            @if($editMode)
            $('#categories').trigger('change')
            @endif

            $('#appointmentTime').on('click', function () {
                // Open the time slot modal
                $('#timeSlotModal').modal('show');
                // Get the current time
                var currentTime = moment();
                var currentTimeformate = moment().format('MM/DD/YYYY');
                var date = $('.appointment-date').val();
                $('#timeSlotModalBody li').each(function () {
                    var timeSlot = $(this).text();

                    var slotTime = moment(timeSlot.split('-')[0].trim(), 'h:mm A');
                    if (date == currentTimeformate)
                    {
                        if (currentTime.isAfter(slotTime))
                        {
                            $(this).remove();
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

            @if($editMode)
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
                url: "{{ route('admin.fetch.timeslot') }}",
                data: {
                    date: $('.appointment-date').val()
                },
                success: function (data) {
                    $('#date-slot').empty().html(data.slotHtml)
                },
            });
        }

        function selectTimeSlot(timeSlot, key)
        {
            // Set the selected time slot to the input field
            $('#selectedTimeSlot').val(timeSlot);
            $('.fatch_data').val(key)
            // Set the selected time slot to the hidden field (you can use this hidden field to submit the value to the server)
            $('#selectedTimeSlotHidden').val(timeSlot);

            // Close the modal
            $('#timeSlotModal').modal('hide');
        }
    </script>
@endsection
