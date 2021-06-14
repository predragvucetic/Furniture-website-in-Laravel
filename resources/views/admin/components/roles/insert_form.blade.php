@if(session()->has('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <p class="lead">Add new role</p>
        <form action="{{ route("roles-store") }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="form-line">
                    <input type="text" class="form-control" name="name" placeholder="Role Name">
                </div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary waves-amber" value="Add">
                <a href="{{ route("roles-index") }}" class="btn btn-warning waves-effect">Cancel</a>
            </div>
        </form>
    </div>
</div>
