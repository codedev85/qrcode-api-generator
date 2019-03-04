@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">
            Account :{{$account->id}}
        <small>  
                 @if($account->applied_for_payouts == 1)
                  Payout request pending
                  @endif
       </small>
        </h1>
        <h1 class="pull-right">
        @if(Auth::user()->id == $account->user_id && $account->applied_for_payouts != 1)
           
             {!! Form::open(['route' => ['accounts.apply_for_payout'], 'method' => 'post' , 'class'=>'pull-left']) !!}
                     <input type="hidden" value="{{$account->id}}" name="apply_for_payout"/>
                    {!! Form::button('<i class="fa fa-credit-card"></i> Apply for Payout', ['type' => 'submit', 'class' => 'btn btn-success', 'onclick' => "return confirm('Are you sure you wish to apply for payout?')"]) !!}
             {!! Form::close() !!}

        @endif
        @if(Auth::user()->role_id < 3 && $account->paid != 1)
              {!! Form::open(['route' => ['accounts.mark_as_paid'], 'method' => 'post', 'class'=>'pull-right', 'style'=>'margin-left:10px']) !!}
                     <input type="hidden" value="{{$account->id}}" name="mark_as_paid"/>
                    {!! Form::button('<i class="fa fa-credit-card"></i> Marked as paid', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you wish to mark as paid?')"]) !!}
                {!! Form::close() !!}
         @endif

        </h1>
    </section>
    <div class="content">
    <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('accounts.show_fields')
                    {{-- <a href="{!! route('accounts.index') !!}" class="btn btn-default">Back</a> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
