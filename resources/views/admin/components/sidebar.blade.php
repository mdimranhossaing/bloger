<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('admin/dist/img/logo.jpg') }}" alt="{{ env('APP_NAME') }}"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('upload/' . auth()->user()->photo) }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                {{-- Dashboard Menu --}}
                <li class="nav-item {{ request()->segment('1') == 'dashboard' ? 'menu-open' : '' }}">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->segment('1') == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Dashboard
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"
                                class="nav-link {{ request()->segment('2') == 'home' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Home</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Posts Menu --}}
                <li class="nav-item {{ request()->segment(1) == 'posts' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.all-posts') }}"
                        class="nav-link {{ request()->segment(1) == 'posts' ? 'active' : '' }}">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Posts
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.all-posts') }}"
                                class="nav-link {{ request()->segment(2) == 'all-posts' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Posts</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('post.create') }}"
                                class="nav-link {{ request()->segment(2) == 'create' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New Post</p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->segment(2) == 'category' ? 'menu-open' : '' }}">
                            <a href="{{route('admin.all-categories')}}" class="nav-link  {{ request()->segment(2) == 'category' ? 'link-hover' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Categories
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.all-categories')}}" class="nav-link {{ request()->segment(3) == 'create' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Categories</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item {{ request()->segment(2) == 'tag' ? 'menu-open' : '' }}">
                            <a href="{{route('admin.all-tags')}}" class="nav-link  {{ request()->segment(2) == 'tag' ? 'link-hover' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Tags
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.all-tags')}}" class="nav-link {{ request()->segment(3) == 'all' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Tags</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>

                {{-- Users Menu --}}
                <li class="nav-item {{ request()->segment(1) == 'user' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.all-posts') }}"
                        class="nav-link {{ request()->segment(1) == 'user' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('user.profile') }}"
                                class="nav-link {{ request()->segment('2') == 'profile' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>My Profile</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('all.users') }}"
                                class="nav-link {{ request()->segment(2) == 'all-users' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Users</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('create.user') }}"
                                class="nav-link {{ request()->segment(2) == 'create-user' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New User</p>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
