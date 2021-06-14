<!DOCTYPE html>
<html>
    @include("admin.components.common.head")
    <body class="theme-red">
        @include("admin.components.common.loader")
        <div class="overlay"></div>
        @include("admin.components.common.nav")
        <section>
            @include("admin.components.common.sidebar")
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>

                                    <small></small>
                                </h2>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="">Show All</a></li>
                                            <li><a href="">Add New</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                @yield("content")
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    @include("admin.components.common.scripts")
    </body>
</html>
