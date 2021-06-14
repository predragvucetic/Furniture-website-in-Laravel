<div class="row">

    <div class="col-md-4 col-md-offset-4">

        <p class="lead">Edit Customer</p>

        <form action="{{ route("customers-update", ["id" => $customer->id]) }}" method="POST">

            {{ csrf_field() }}

            <div class="form-group">

                <div class="form-line">

                    <input name="firstName" type="text" value="{{ $customer->firstName }}" class="form-control" placeholder="First Name">

                </div>

            </div>

            <div class="form-group">

                <div class="form-line">

                    <input name="lastName" type="text" value="{{ $customer->lastName }}" class="form-control" placeholder="Last Name">

                </div>

            </div>

            <div class="form-group">

                <div class="form-line">

                    <input name="email" type="text" value="{{ $customer->email }}" class="form-control" placeholder="Email">

                </div>

            </div>

            <div class="form-group">

                <div class="form-line">

                    <input name="address" type="text" value="{{ $customer->address }}" class="form-control" placeholder="Address">

                </div>

            </div>

            <div class="form-group">

                <div class="form-line">

                    <input name="city" type="text" value="{{ $customer->city }}" class="form-control" placeholder="City">

                </div>

            </div>

            <div class="form-group">

                <div class="form-line">

                    <input name="postcode" type="text" value="{{ $customer->postcode }}" class="form-control" placeholder="Postcode">

                </div>

            </div>

            <div class="form-group">

                <div class="form-line">

                    <input name="country" type="text" value="{{ $customer->country }}" class="form-control" placeholder="Country">

                </div>

            </div>

            <div class="form-group">

                <input type="submit" class="btn btn-primary waves-amber" value="Edit">

                <a href="{{ route("customers-index") }}" class="btn btn-warning waves-effect">Cancel</a>

            </div>

        </form>

    </div>

</div>
