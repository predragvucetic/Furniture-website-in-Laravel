<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
@include("admin.components.common.user_info")
<!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="{{ route("home-page") }}">
                    <i class="material-icons">home</i>
                    <span>Back to website</span>
                </a>
            </li>
            <li class="active">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">person</i>
                    <span>Users</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="{{ route("users-create") }}">Add</a>
                    </li>
                    <li>
                        <a href="{{ route("users-index") }}">Show</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">admin_panel_settings</i>
                    <span>Roles</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="{{ route("roles-create") }}">Add</a>
                    </li>
                    <li>
                        <a href="{{ route("roles-index") }}">Show</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">border_color</i>
                    <span>Products</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="{{ route('products-create') }}">Add</a>
                    </li>
                    <li>
                        <a href="{{ route("products-index") }}">Show</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">style</i>
                    <span>Collections</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="{{ route("collections-create") }}">Add</a>
                    </li>
                    <li>
                        <a href="{{ route("collections-index") }}">Show</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">category</i>
                    <span>Categories</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="{{ route("categories-create") }}">Add</a>
                    </li>
                    <li>
                        <a href="{{ route("categories-index") }}">Show</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">person</i>
                    <span>Customers</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="{{ route("customers-create") }}">Add</a>
                    </li>
                    <li>
                        <a href="{{ route("customers-index") }}">Show</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">shopping_cart</i>
                    <span>Cart</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="{{ route("orders-create") }}">Add</a>
                    </li>
                    <li>
                        <a href="{{ route("orders-index") }}">Show</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>
<!-- #END# Left Sidebar -->
