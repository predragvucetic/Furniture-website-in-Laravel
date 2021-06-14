<table id="" class="table table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Icon</th>
        <th>Url</th>
        <th>Edit</th>
        <th>Delete</th>
    </thead>
    <tbody>
    @foreach($social_networks as $sn)
        <tr>
            <td>{{ $sn->name }}</td>
            <td><i class="fa fa-3x fa-{{ $sn->icon }}"></i></td>
            <td>{{ $sn->url }}</td>
            <td><a href="{{ route("social.show", ['id' => $sn->id]) }}" class="btn btn-info waves-effect btn-xs"><i class="material-icons">edit</i></a></td>
            <td><a href="{{ route("social.delete", ['id' => $sn->id]) }}" class="btn btn-danger waves-effect btn-xs"><i class="material-icons">delete</i></a></td>
        </tr>
    @endforeach
    </tbody>
</table>