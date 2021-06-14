@if(session()->has('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

<table id="" class="table table-striped">
    <thead>
    <tr>
        <th>Id</th>
        <th>Collection Name</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    @foreach($collections as $collection)
        <tr>
            <td>{{ $collection->id }}</td>
            <td>{{ $collection->name }}</td>
            <td><a href="{{ route("collections-show", ["id" => $collection->id ]) }}" class="btn btn-info waves-effect btn-xs"><i class="material-icons">edit</i></a></td>
            <td><a href="{{ route("collections-destroy", ["id" => $collection->id ]) }}" class="btn btn-danger waves-effect btn-xs"><i class="material-icons">delete</i></a></td>
        </tr>
    @endforeach
    </tbody>
</table>
