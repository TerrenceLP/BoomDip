<!-- Role Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role_id', 'Role Id:') !!}
    {!! Form::number('role_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Permission Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('permission_id', 'Permission Id:') !!}
    {!! Form::number('permission_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('roleHasPermissions.index') !!}" class="btn btn-default">Cancel</a>
</div>
