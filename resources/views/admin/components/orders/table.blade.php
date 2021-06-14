@if(session()->has('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

<table id="" class="table table-striped">
    <thead>
    <tr>
        <th>Id</th>
        <th style="padding-left: 70px">Product Names</th>
        <th>Product Price</th>
        <th style="padding-left: 25px">Creation Date</th>
        <th>Status</th>
        <th>Id Customer</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->orderId }}</td>
            <td>
                <ul style="list-style: none">
                    @foreach($order_details as $od)
                        @if($order->orderId == $od->idOrder)
                        <li style="margin-left: 40px">{{ $od->productName }}</li>
                        @endif
                    @endforeach
                </ul>
            </td>
            <td>
                <ul style="list-style: none">
                    @foreach($order_details as $od)
                        @if($order->orderId == $od->idOrder)
                            <li style="margin-left: 20px">{{ $od->productPrice }}</li>
                        @endif
                    @endforeach
                </ul>
            </td>
            <td>{{ $order->creationDate }}</td>
            <td>{{ $order->status }}</td>
            <td><a href="{{ route("customers-index") }}" style="margin-left: 25px">{{ $order->idCustomer }}</a></td>
            <td><a href="{{ route("orders-show", ["id" => $order->orderId ]) }}" class="btn btn-info waves-effect btn-xs"><i class="material-icons">edit</i></a></td>
            <td><a href="{{ route("orders-destroy", ["id" => $order->orderId ]) }}" class="btn btn-danger waves-effect btn-xs"><i class="material-icons">delete</i></a></td>
        </tr>
    @endforeach
    </tbody>
</table>
