@if(session()->has('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

<table id="" class="table table-striped">
    <thead>
    <tr>
        <th>Id Customer</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>City</th>
        <th>Postcode</th>
        <th>Country</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
        @foreach($customers as $customer)
        <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->firstName }}</td>
            <td>{{ $customer->lastName }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->address }}</td>
            <td>{{ $customer->city }}</td>
            <td>{{ $customer->postcode }}</td>
            <td>{{ $customer->country }}</td>
            <td><a href="{{ route("customers-show", ["id" => $customer->id]) }}" class="btn btn-info waves-effect btn-xs"><i class="material-icons">edit</i></a></td>
            <td><a href="{{ route("customers-destroy", ["id" => $customer->id]) }}" class="btn btn-danger waves-effect btn-xs"><i class="material-icons">delete</i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>
