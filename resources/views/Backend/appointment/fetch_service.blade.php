<div class="form-group">
    <label for="inputStatus">Service</label>
    {!! Form::select('service_id', ['' => 'Select One'] + $service,null , ['class' => 'form-control custom-select-sm', 'id' => 'service']) !!}
</div>
