<div class="row">

    @if(session()->has('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif

    <div class="col-md-8 col-md-offset-2">

        <p class="lead">Add New Product</p>

        <form action="{{ route("products-store") }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <div class="form-line">
                    <input name="name" type="text" class="form-control" placeholder="Product Name">
                </div>
            </div>

            <div class="form-group">
                <div class="form-line">
                    <textarea class="form-control" name="description" placeholder="Product Description"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="form-line">
                    <textarea class="form-control" name="size" placeholder="Product Size"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="form-line">
                    <input name="price" type="text" class="form-control" placeholder="Product Price">
                </div>
            </div>

            <div class="form-group">
                <div class="form-line">
                    <input name="newPrice" type="text" class="form-control" placeholder="Product Price On Sale">
                </div>
            </div>

            <div class="form-group">
                <p><i>Category:</i></p>
                <ul style="list-style: none">
                    @foreach($category_collection as $cc)
                        <li><input id="category{{$cc->id}}" name="category" class="chk-col-deep-purple" value="{{ $cc->id }}" type="radio">
                            <label for="category{{$cc->id}}"> {{ $cc->collectionName . " " . $cc->categoryName }} </label></li>
                    @endforeach
                </ul>
            </div>

            <div class="form-group">
                <div class="form-line">
                    <label for="image">Product Pictures</label>
                    <input id="image" name="images[]" type="file" class="form-control" multiple>
                </div>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary waves-amber" value="Add">
                <a href="{{ route("products-index") }}" class="btn btn-warning waves-effect">Cancel</a>
            </div>

        </form>

    </div>

</div>
