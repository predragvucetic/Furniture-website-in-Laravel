<div class="row">

    @if(session()->has('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif

    <div class="col-md-4 col-md-offset-4">
        <p class="lead">Add new order</p>
        <form action="{{ route("orders-store") }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group">
                <p><i>Select products:</i></p>
                <select name="ddlProducts[]" style="height: 500px" multiple>
                    @foreach($products as $product)
                        @if(empty($product->newPrice))
                            <option value="{{ $product->name . "->" .  $product->price }}">{{ $product->name }}</option>
                        @else
                            <option value="{{ $product->name . "->" .  $product->newPrice }}">{{ $product->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <p><i>Customers:</i></p>
                <ul style="list-style: none">
                @foreach($customers as $customer)
                    <li>
                        <input id="customer{{ $customer->id }}" name="idCustomer" class="chk-col-deep-purple" value="{{ $customer->id }}" type="radio">
                        <label for="customer{{ $customer->id }}">{{ "Id: " . $customer->id . " - " . $customer->email }}</label>
                    </li>
                @endforeach
                </ul>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary waves-amber" value="Add">
                <a href="{{ route("orders-index") }}" class="btn btn-warning waves-effect">Cancel</a>
            </div>

        </form>
    </div>
</div>



