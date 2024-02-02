<div class="container">
    <div class="row">
        @foreach($timeSlots as $key => $timeSlot)
            <div class="col-md-6 mb-3 time_remove">
                <div class="list-group-item p-3">
                    <label class="m-0">
                        <input type="radio" name="time_slot" value="{{ $key }}"
                               onclick="selectTimeSlot('{{ $timeSlot }}','{{$key}}')">
                        {{ $timeSlot }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.slotDay').text('{{$slotDay}}');
    });
</script>
