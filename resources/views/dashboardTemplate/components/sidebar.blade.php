<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('dashboard.index') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ asset('dist/../../dist/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">IMineApp</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column">
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ Route::current()->getName() === 'dashboard.index' ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @can('read_role_management')
                    <li class="nav-item">
                        <a href="javascript:void(0)"
                            class="nav-link {{ Route::current()->getName() === 'role_management.index' ? 'active' : '' }}">
                            <i class="nav-icon bi bi-pencil-square"></i>
                            <p>
                                Role Managements
                            </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route('order_vehicle.index') }}"
                        class="nav-link {{ Route::current()->getName() === 'order_vehicle.index' ? 'active' : '' }}">
                        <i class="nav-icon bi bi-pencil-square"></i>
                        <p>
                            Order Vehicle
                        </p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
