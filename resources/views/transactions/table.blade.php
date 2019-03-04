<table class="table table-responsive" id="transactions-table">
    <thead>
        <tr>
        <th>Product</th>
        <th>Buyer</th>
        <th>Method</th>
        <th>Amount</th>
        <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
             <td>
                <a href="{!! route('transactions.show', [$transaction->id]) !!}">
                {!! $transaction->qrcode['product_name'] !!}
                </a> |
                <span class="text-light">{{$transaction->created_at->format('D d,M,Y h i')}}</span>
             </td>
            <td>{!! $transaction->user['name'] !!}</td>
            <td>{!! $transaction->payment_method !!}</td>
            <td>${!! $transaction->amount !!}</td>
            <td>
                {!! $transaction->status !!}
                <br>
                <span class="text-light">{{$transaction->updated_at->format('D d,M,Y h i')}}</span>

            </td>

        </tr>
    @endforeach
    </tbody>
</table>
