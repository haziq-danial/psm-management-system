<!-- Main Sidebar Container -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('../img/01-Logo UMP_Full Color.png') }}" class="img-size-32 elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ url('/') }}" class="d-block">PSMMS</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @hasanyrole('student|supervisor')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Manage Title
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('manage-title.view') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Title</p>
                                </a>
                            </li>
                        </ul>
                        @can('book title')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('manage-title.view-book') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Book Title</p>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                        @can('add title')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('manage-title.my-titles') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>My Titles</p>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                    </li>
                @endhasanyrole
                @hasanyrole('student|supervisor|coordinator')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-archive"></i>
                            <p>
                                Manage Proposal
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        @can('view all proposals')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('manage-proposal.view-all') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Proposals</p>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                        @can('view proposal')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('manage-proposal.view-one') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>My proposal</p>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                    </li>
                @endhasanyrole
                @hasanyrole('student|technician')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Manage Inventory
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        @can('view all items')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('manage-inventory.view-all') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All items</p>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                        @can('view item')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('manage-inventory.view-one') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>My items</p>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                    </li>
                @endhasanyrole
                <li class="nav-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
