<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Role Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('role_id', 'User Levels:') !!}
    {!! Form::number('role_id', null, ['class' => 'form-control']) !!}
</div> --}}
@if(Auth::user()->role_id < 3)
    <div class="form-group col-sm-6">
        <label for="">User Levels</label>
        
            <select class="form-control">
            <option value="{{$user->role['id']}}">{{$user->role['admin']}}</option>
            @foreach($roles as $role)
                <option value="{{$role['id']}}">{{$role['admin']}}</option>
            @endforeach
            </select>
        
    </div>
@endif

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Verified At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    {!! Form::date('email_verified_at', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Remember Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    {!! Form::text('remember_token', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>
