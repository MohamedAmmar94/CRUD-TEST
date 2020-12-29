<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            CRUD
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                Dashboard
            </a>
        </li>


        <li class="c-sidebar-nav-item">
            <a href="{{ route("categories.index") }}" class="c-sidebar-nav-link {{ request()->is("categories/*") ? "c-active" : "" }}">
                <i class="fa-fw fas fa-calendar-alt c-sidebar-nav-icon">

                </i>
                Categories
            </a>
        </li>
        <li class="c-sidebar-nav-item">
                <a href="{{ route("products.index") }}" class="c-sidebar-nav-link {{  request()->is("products/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-calendar-alt c-sidebar-nav-icon">
                    </i>
                    Products
                </a>
            </li>

    </ul>

</div>
