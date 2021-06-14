@if(session()->has('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

<table id="" class="table table-striped">
    <thead>
    <tr>
        <th>Id</th>
        <th>Role</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr>
            <td>{{ $role->id }}</td>
            <td>{{ $role->name }}</td>
            <td><a href="{{ route("roles-show", ["id" => $role->id ]) }}" class="btn btn-info waves-effect btn-xs"><i class="material-icons">edit</i></a></td>
            <td><a href="{{ route("roles-destroy", ["id" => $role->id ]) }}" class="btn btn-danger waves-effect btn-xs"><i class="material-icons">delete</i></a></td>
        </tr>
    @endforeach
    </tbody>
</table>
