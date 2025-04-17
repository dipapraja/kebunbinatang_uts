<div class="sidebar">
    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-otter"></i>
                    <p>Home</p>
                </a>
            </li>

            <!-- Data Master -->
            <li class="nav-header">Layanan Zoo🐾</li>
            <li class="nav-item">
                <a href="{{ url('/kandang') }}" class="nav-link {{ ($activeMenu == 'kandang') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Data Kandang</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/hewan') }}" class="nav-link {{ ($activeMenu == 'hewan') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-paw"></i>
                    <p>Data Hewan</p>
                </a>
            </li>
        </ul>
    </nav>
</div>