<script>
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
</script>
<div class="form-group">
    <label>Select service</label>
    <div class="select2-secondary">
        {!! Form::select('service_id[]',$service, null,['class'=>'select2','multiple'=>'multiple', 'style'=>'width: 100%;']) !!}
    </div>
</div>
