@if(session()->has('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <p class="lead">Add new category</p>
        <form action="{{ route("categories-store") }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="form-line">
                    <input name="name" type="text" class="form-control" placeholder="Category Name">
                </div>
            </div>
            <div class="form-group">
                <p><i>Collections:</i></p>
                @foreach($collections as $collection)
                    <input id="collection{{$collection->id}}" name="idCollection" class="chk-col-deep-purple" value="{{ $collection->id }}" type="radio">
                    <label for="collection{{$collection->id}}"> {{ $collection->name }} </label>
                @endforeach
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary waves-amber" value="Add">
                <a href="{{ route("categories-index") }}" class="btn btn-warning waves-effect">Cancel</a>
            </div>
        </form>
    </div>
</div>
