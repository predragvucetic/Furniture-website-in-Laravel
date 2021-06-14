<div class="row">

    <div class="col-md-4 col-md-offset-4">

        <p class="lead">Edit order</p>

        <form action="{{ route("orders-update", ["id" => $order[0]->orderId ]) }}" method="POST">

            {{ csrf_field() }}

            @foreach($order as $o)
                <input type="hidden" name="hidden[]" value="{{ $o->idOrderDetails }}">
            @endforeach

            <div class="form-group">
                <p><i>Select products:</i></p>
                <select name="ddlProducts[]" style="height: 500px" multiple>
                    @foreach($products as $product)
                        @if(empty($product->newPrice))
                            <option value="{{ $product->name . "->" .  $product->price . "->" . $product->id }}" @php foreach ($order as $o){ echo $o->productName == $product->name ? "selected" : "" ;} @endphp >{{ $product->name }}</option>
                        @else
                            <option value="{{ $product->name . "->" .  $product->newPrice . "->" . $product->id }}" @php foreach ($order as $o){ echo $o->productName == $product->name ? "selected" : "" ;} @endphp >{{ $product->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <p><i>Customers:</i></p>
                <ul style="list-style: none">
                    @foreach($customers as $customer)
                        <li>
                            <input id="customer{{ $customer->id }}" name="idCustomer" class="chk-col-deep-purple" value="{{ $customer->id }}" {{ $customer->id == $o->idCustomer ? "checked" : "" }} type="radio">
                            <label for="customer{{ $customer->id }}">{{ "Id: " . $customer->id . " - " . $customer->email }}</label>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="form-group">
                <p><i>Status:</i></p>
                @foreach($statuses as $status)
                    <input id="status{{$status->id}}" name="idStatus" class="chk-col-deep-purple" value="{{ $status->id }}" {{ $status->id == $o->idStatus ? "checked" : "" }} type="radio">
                    <label for="status{{$status->id}}"> {{ $status->status }} </label>
                @endforeach
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-primary waves-amber" value="Edit">
                <a href="{{ route("orders-index") }}" class="btn btn-warning waves-effect">Cancel</a>
            </div>

        </form>

    </div>

</div>
