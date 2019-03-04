<!-- Admin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('admin', 'Admin:') !!}
    {!! Form::text('admin', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('roles.index') !!}" class="btn btn-default">Cancel</a>
</div>
