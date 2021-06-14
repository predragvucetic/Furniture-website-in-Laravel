<div class="row">

    <div class="col-md-4 col-md-offset-4">

        <p class="lead">Edit User</p>

        <form action="{{ route("users-update", ['id' => $user->id]) }}" method="POST">

            {{ csrf_field() }}

            <div class="form-group">

                <div class="form-line">

                    <input name="firstName" type="text" value="{{ $user->firstName }}" class="form-control" placeholder="First Name">

                </div>

            </div>

            <div class="form-group">

                <div class="form-line">

                    <input name="lastName" type="text" value="{{ $user->lastName }}" class="form-control" placeholder="Last Name">

                </div>

            </div>

            <div class="form-group">

                <div class="form-line">

                    <input name="username" type="text" value="{{ $user->username }}" class="form-control" placeholder="Username">

                </div>

            </div>

            <div class="form-group">

                <div class="form-line">

                    <input name="email" type="text" value="{{ $user->email }}" class="form-control" placeholder="Email">

                </div>

            </div>

            <div class="form-group">

                <div class="form-line">

                    <input name="password" type="password" value="{{ $user->password }}" class="form-control" placeholder="Password">

                </div>

            </div>

            <div class="form-group">

                <p><i>Roles:</i></p>
                @foreach($roles as $role)
                    <input id="role{{$role->id}}" name="idRole" class="chk-col-deep-purple" value="{{ $role->id }}" {{ $role->id == $user->idRole ? "checked" : "" }} type="radio">
                    <label for="role{{$role->id}}"> {{ $role->name }} </label>
                @endforeach

            </div>

            <div class="form-group">

                <input type="submit" class="btn btn-primary waves-amber" value="Edit">

                <a href="{{ route("users-index") }}" class="btn btn-warning waves-effect">Cancel</a>

            </div>

        </form>

    </div>

</div>
