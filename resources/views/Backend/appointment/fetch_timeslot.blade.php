@foreach($timeSlots as $key => $timeSlot)
    <li class="list-group-item">
        <label>
            <input type="radio" name="time_slot" value="{{ $key }}"
                   onclick="selectTimeSlot('{{ $timeSlot }}')">
            {{ $timeSlot }}
        </label>
    </li>
@endforeach
