<div class="row">

    <div class="col-md-4 col-md-offset-4">

        <p class="lead">Edit Role</p>

        <form action="{{ route("roles-update", ["id" => $role->id ]) }}" method="POST">

            {{ csrf_field() }}

            <div class="form-group">
                <div class="form-line">
                    <input name="name" type="text" value="{{ $role->name }}" class="form-control" placeholder="Role Name">
                </div>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary waves-amber" value="Edit">
                <a href="{{ route("roles-index") }}" class="btn btn-warning waves-effect">Cancel</a>
            </div>

        </form>

    </div>

</div>
