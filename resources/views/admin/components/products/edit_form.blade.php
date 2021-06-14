<div class="row">

    @if(session()->has('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif

    <div class="col-md-8 col-md-offset-2">

        <p class="lead">Edit Product</p>

        <form action="{{ route("products-update", ["id" => $product->id]) }}" method="post" enctype="multipart/form-data">

            @csrf

            @foreach($images as $image)
                <input type="hidden" name="hidden[]" value="{{ $image->id }}">
            @endforeach
            <div class="form-group">
                <div class="form-line">
                    <input name="name" type="text" value="{{ $product->name }}" class="form-control" placeholder="Name">
                </div>
            </div>

            <div class="form-group">
                <div class="form-line">
                    <textarea class="form-control" name="description" placeholder="Product Description">{{ $product->description }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="form-line">
                    <textarea class="form-control" name="size" placeholder="Product Size">{{ $product->dimensions }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="form-line">
                    <input name="price" type="text" value="{{ $product->price }}" class="form-control" placeholder="Product Price">
                </div>
            </div>

            <div class="form-group">
                <div class="form-line">
                    <input name="newPrice" type="text" value="{{ $product->newPrice }}" class="form-control" placeholder="Product Price On Sale">
                </div>
            </div>

            <div class="form-group">
                <p><i>Category:</i></p>
                <ul style="list-style: none">
                    @foreach($category_collection as $cc)
                        <li><input id="category{{$cc->id}}" name="category" class="chk-col-deep-purple" value="{{ $cc->id }}" {{ $cc->id == $product->idCategoryCollection ? "checked" : "" }} type="radio">
                            <label for="category{{$cc->id}}"> {{ $cc->collectionName . " " . $cc->categoryName }} </label></li>
                    @endforeach
                </ul>
            </div>

            <div class="form-group">
                <div class="form-line">
                    <label for="image">Product Pictures</label>
                    <input id="image" name="images[]" type="file" value="" class="form-control" multiple>
                    <br>
                    @foreach($images as $image)
                        <img class="img thumbnail" height="200px" style="display: inline" src="{{ asset('images/products/' . $image->url) }}" alt="">
                    @endforeach
                </div>
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-primary waves-amber" value="Edit">
                <a href="{{ route("products-index") }}" class="btn btn-warning waves-effect">Cancel</a>
            </div>

        </form>

    </div>

</div>
