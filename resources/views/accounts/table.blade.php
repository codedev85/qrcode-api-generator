<table class="table table-responsive" id="accounts-table">
    <thead>
        <tr>
            <th>User</th>
            {{-- <th>Paid</th> --}}
        <th>Balance</th>
        <th>Total Credit</th>
        <th>Total Debit</th>
        {{-- <th>Applied For Payouts</th>
        <th>Last Date Applied</th>
        <th>Last Date Paid</th> --}}
        <th>Status</th>
       
        <th>Payment Details</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($accounts as $account)
        <tr>
            <td>
                <a href="{!! route('accounts.show', [$account->id]) !!}" class='btn btn-default btn-xs'>
                {!! $account->user['email'] !!}
                </a>
           </td>
            {{-- <td>{!! $account->paid !!}</td> --}}
            <td>${!! number_format($account->balance) !!}</td>
            <td>${!! number_format($account->total_credit) !!}</td>
            <td>${!! number_format($account->total_debit) !!}</td>
            <td>
               @if($account->applied_for_payouts == 1)
               Payment Pending
               @elseif($account->paid == 1)
               Paid
               @endif
            </td>
            {{-- <td>{!! $account->applied_for_payouts !!}</td>
            <td>{!! $account->last_date_applied !!}</td>
            <td>{!! $account->last_date_paid !!}</td> --}}
            <td>{!! $account->payment_details !!}</td>
            <td>
              
                <div class='btn-group'> 
                    <a href="{!! route('accounts.edit', [$account->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                </div>
              
            </td>
        </tr>
    @endforeach
    </tbody>
</table>