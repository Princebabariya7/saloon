<div class="form-group ">
    <label for="inputStatus">Service</label>
    <div class="select2-primary">
        {!! Form::select('service_id[]', $service,null , ['class' => 'form-control form-control-sm custom-select-sm select2', 'id' => 'service', 'multiple'=>'multiple', 'data-placeholder'=>"Select a Category", 'data-dropdown-css-class'=>"select2-primary", 'style'=>'"width: 100%;"']) !!}
    </div>
</div>

<script>
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
</script>
