<div class="row">

    <div class="col-md-4 col-md-offset-4">

        <p class="lead">Add New Social Network</p>

        <form action="{{ route("social.store") }}" method="post">

            {{ csrf_field() }}

            <div class="form-group">

                <div class="form-line">

                    <input name="url" type="text" class="form-control" placeholder="Social Network Website">

                </div>

            </div>

            <div class="form-group">

                <div class="form-line">

                    <input name="name" type="text" class="form-control" placeholder="Social Network eg. Facebook">

                </div>

            </div>

            <div class="form-group">

                <div class="form-line">
                    <input name="icon" id="icon" type="text" class="form-control" placeholder="Font Awesome Icon">
                </div>
                <br>
                <span><i class="" id="fa-icon"></i></span>
            </div>


            <div class="form-group">

                <input type="submit" class="btn btn-primary waves-amber" value="Add">

                <a href="{{ route("social.index") }}" class="btn btn-warning waves-effect">Cancel</a>

            </div>

        </form>

    </div>

</div>