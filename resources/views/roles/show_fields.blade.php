

<!-- Admin Field -->
{{-- <div class="form-group">
    {!! Form::label('admin', 'Admin:') !!}
    <p>{!! $role->admin !!}</p>
</div> --}}

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $role->created_at->format('D d ,M , Y') !!}</p>
</div>

<!-- Updated At Field -->
{{-- <div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $role->updated_at !!}</p>
</div> --}}
<h3 class="text-center text-info">The users that belongs to this table</h3>
@include('users.table')
