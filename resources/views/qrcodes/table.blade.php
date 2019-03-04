<table class="table table-responsive" id="qrcodes-table">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Website</th>
            <th>Ammount</th>
            <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($qrcodes as $qrcode)
        <tr>
            {{-- <td>{!! $qrcode->user_id !!}</td> --}}
            <td>
         
               <a href="{!! route('qrcodes.show', [$qrcode->id]) !!} ">
                 <b>{!! $qrcode->product_name !!}</b>
               </a>
            </td>
            <td>{!! $qrcode->website !!}</td>
            <td>${!! $qrcode->ammount !!}</td>
            <td>
                @if($qrcode->status == 1)
                    {{-- <b class="text-success">Active</b> --}}
                    <i class="fa fa-check-square text-success"></i>
                @else
                    <i class="fa fa-times-circle text-danger"></i>
                    {{-- <b class="text-danger">Inactive</b> --}}
                @endif
                {{-- {!! $qrcode->status !!} --}}
            
            </td>
            <td>
                {!! Form::open(['route' => ['qrcodes.destroy', $qrcode->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('qrcodes.show', [$qrcode->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('qrcodes.edit', [$qrcode->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
