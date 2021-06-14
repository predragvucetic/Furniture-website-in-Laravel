@if(session()->has('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <p class="lead">Add new collection</p>
        <form action="{{ route("collections-store") }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="form-line">
                    <input name="name" type="text" class="form-control" placeholder="Collection Name">
                </div>
            </div>
            <div class="form-group">
                <p><i>Categories:</i></p>
                @foreach($categories as $category)
                    <input id="category{{$category->id}}" name="idCategory" class="chk-col-deep-purple" value="{{ $category->id }}" type="radio">
                    <label for="category{{$category->id}}"> {{ $category->name }} </label>
                @endforeach
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary waves-amber" value="Add">
                <a href="{{ route("collections-index") }}" class="btn btn-warning waves-effect">Cancel</a>
            </div>
        </form>
    </div>
</div>
