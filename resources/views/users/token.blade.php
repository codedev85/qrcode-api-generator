


@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            API Clients
        </h1>

    </section>
    <div class="content">
      <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body" id="app">
                <div class="row" style="padding-left: 20px">
                        <passport-clients></passport-clients>
                        <passport-authorized-clients></passport-authorized-clients>
                        <passport-personal-access-tokens></passport-personal-access-tokens>
                </div>
            </div>
        </div>
    </div>
@endsection
