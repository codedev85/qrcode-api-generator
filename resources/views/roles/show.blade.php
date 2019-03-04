@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Role : {!! $role->admin !!}
             @if(Auth::user()->role_id < 3  )
              <a href="{!! route('roles.edit', [$role->id]) !!}" class='btn btn-primary pull-right'>Edit Role</a>
             @endif
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('roles.show_fields')
                    <a href="{!! route('roles.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
