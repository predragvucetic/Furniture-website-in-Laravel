<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <p class="lead">Add new customer</p>
        <form action="{{ route("customers-store") }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="form-line">
                    <input name="firstName" type="text" class="form-control" placeholder="First Name">
                </div>
            </div>
            <div class="form-group">
                <div class="form-line">
                    <input name="lastName" type="text" class="form-control" placeholder="Last Name">
                </div>
            </div>
            <div class="form-group">
                <div class="form-line">
                    <input name="email" type="text" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <div class="form-line">
                    <input name="address" type="text" class="form-control" placeholder="Address">
                </div>
            </div>
            <div class="form-group">
                <div class="form-line">
                    <input name="city" type="text" class="form-control" placeholder="City">
                </div>
            </div>
            <div class="form-group">
                <div class="form-line">
                    <input name="postcode" type="text" class="form-control" placeholder="Postcode">
                </div>
            </div>
            <div class="form-group">
                <div class="form-line">
                    <input name="country" type="text" class="form-control" placeholder="Country">
                </div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary waves-amber" value="Add">
                <a href="{{ route("customers-index") }}" class="btn btn-warning waves-effect">Cancel</a>
            </div>
        </form>
    </div>
</div>
