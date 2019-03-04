<!-- Id Field -->
{{-- <div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $account->id !!}</p>
</div> --}}

<!-- User Id Field -->
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('user_id', 'User:') !!}
        <p>{!! $account->user['name'] !!} : {!! $account->user['email'] !!}</p>
    </div>

    <!-- Balance Field -->
    <div class="form-group">
        {!! Form::label('balance', 'Balance:') !!}
        <p>${!! number_format( $account->balance) !!}</p>
    </div>

    <!-- Total Credit Field -->
    <div class="form-group">
        {!! Form::label('total_credit', 'Total Credit:') !!}
        <p>${!! number_format($account->total_credit) !!}</p>
    </div>

    <!-- Total Debit Field -->
    <div class="form-group">
        {!! Form::label('total_debit', 'Total Debit:') !!}
        <p>${!! number_format($account->total_debit) !!}</p>
    </div>

    <!-- Paid Field -->
    {{-- <div class="form-group">
        {!! Form::label('paid', 'Paid:') !!}
        <p>{!! number_format($account->paid) !!}</p>
    </div> --}}

    <!-- Withrawal Method Field -->
    <div class="form-group">
        {!! Form::label('withrawal_method', 'Withrawal Method:') !!}
        <p>{!! $account->withrawal_method !!}</p>
    </div>

    <!-- Applied For Payouts Field -->
    {{-- <div class="form-group">
        {!! Form::label('applied_for_payouts', 'Applied For Payouts:') !!}
        <p>
        @if($account->applied_for_payouts == 1)
        Yes
        @else
        No
        @endif
        </p>
    </div> --}}

    <!-- Last Date Applied Field -->
    @if($account->last_date_applied != 0)
    <div class="form-group">
        {!! Form::label('last_date_applied', 'Last Date Applied:') !!}
        <p>{!! $account->last_date_applied->format('D d,M,Y H:i') !!}</p>
    </div>
    @else
    {!! Form::label('last_date_applied', 'Last Date Applied:') !!}
    <p class="text-green">Yet to apply for payout</p>
    @endif

    <!-- Last Date Paid Field -->
    <div class="form-group">
        {!! Form::label('last_date_paid', 'Last Date Paid:') !!}
        <p>{!! $account->last_date_paid!!}</p>
    </div>



    <!-- Payment Email Field -->
    <div class="form-group">
        {!! Form::label('payment_email', 'Payment Email:') !!}
        <p>{!! $account->payment_email !!}</p>
    </div>

    <!-- Bank Name Field -->
    <div class="form-group">
        {!! Form::label('bank_name', 'Bank Name:') !!}
        <p>{!! $account->bank_name !!}</p>
    </div>

    <!-- Bank Branch Field -->
    <div class="form-group">
        {!! Form::label('bank_branch', 'Bank Branch:') !!}
        <p>{!! $account->bank_branch !!}</p>
    </div>
</div>
<div class="col-md-6">
    <!-- Bank Account Field -->
    <div class="form-group">
        {!! Form::label('bank_account', 'Bank Account:') !!}
        <p>{!! $account->bank_account !!}</p>
    </div>

    <!-- Country Field -->
    <div class="form-group">
        {!! Form::label('country', 'Country:') !!}
        <p>{!! $account->country !!}</p>
    </div>




<!-- Other Details Field -->
<div class="form-group">
    {!! Form::label('other_details', 'Other Details:') !!}
    <p>{!! $account->other_details !!}</p>
</div>

<!-- Payment Details Field -->
<div class="form-group">
    {!! Form::label('payment_details', 'Payment Details:') !!}
    <p>{!! $account->payment_details !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $account->deleted_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $account->created_at->format('D d,M,Y H:i')  !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $account->updated_at->format('D d,M,Y H:i')  !!}</p>
</div>

</div>
<div class="col-md-12 text-center">
<h2>Account History</h2>
@include('account_histories.table');
</div>
