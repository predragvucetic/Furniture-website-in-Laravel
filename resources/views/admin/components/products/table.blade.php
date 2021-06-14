<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ $product->name }}
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{ route("products-show", ["id" => $product->id ]) }}">Edit</a></li>
                            <li><a href="{{ route("products-destroy", ["id" => $product->id ]) }}">Delete</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                    <li role="presentation" class="active"><a href="#home{{ $product->id }}" data-toggle="tab">Content</a></li>
                    <li role="presentation"><a href="#profile{{ $product->id }}" data-toggle="tab">Pictures</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home{{ $product->id }}">
                        <b>Description</b>
                        <p>
                            {{ $product->description }}
                        </p>
                        <b>Price</b>
                        <p>
                            {{ $product->price . " €"}}
                        </p>
                        <b>New Price</b>
                        <p>
                            @if($product->newPrice != null)
                            {{ $product->newPrice . " €" }}
                            @else
                            The product is not on sale
                            @endif
                        </p>
                        <b>Collection</b>
                        <p>
                            {{ $product->collectionName }}
                        </p>
                        <b>Category</b>
                        <p>
                            {{ $product->categoryName }}
                        </p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profile{{ $product->id }}">
                            @foreach($images as $image)
                                @if($image->idProduct == $product->id)
                                    <img src="{{ asset('images/products/' . $image->url) }}" style="height: 200px; width: 200px" alt="">
                                @endif
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

