<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
                <img height="30" src="{{ asset('img/logo_white.png')}}" class="header-brand-img" title="yene app"> 
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $segment1 = request()->segment(1);
        $segment2 = request()->segment(2);
    @endphp
    
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment2 == 'inventory') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="fas fa-tachometer-alt"></i><span>{{ __('Dashboard')}}</span></a>
                </div>

                <!-- start inventory pages -->
                <div class="nav-item {{ ($segment1 == 'pos') ? 'active' : '' }}">
                    <a href="{{route('sales.pos.dashboard')}}"><i class="ik ik-printer"></i><span>{{ __('POS')}}</span> </a>
                </div>
                @can('admin')
                <div class="nav-item {{ ($segment1 == 'products') ? 'active open' : '' }} ">
                    <a href="{{route('product.index')}}"><i class="ik ik-headphones"></i><span>{{ __('Products')}}</span></a>
                    
                </div>
                @endcan
                <div class="nav-item {{ ($segment1 == 'sales') ? 'active open' : '' }} ">
                    <a href="{{route('sales.index')}}"><i class="ik ik-shopping-cart"></i><span>{{ __('Sales')}}</span></a>
                </div>
                @can('admin')
                <div class="nav-item {{ ($segment1 == 'purchases') ? 'active open' : '' }} ">
                    <a href="{{route('purchases.index')}}"><i class="ik ik-truck"></i><span>{{ __('Purchases')}}</span></a>
                </div>
                @endcan
                <div class="nav-item {{ ($segment1 == 'services' || $segment2 == 'services') ? 'active open' : '' }} ">
                    <a href="{{route('service.index')}}" ><i  class="fa fa-wrench" aria-hidden="true"></i><span>{{ __('Services')}}</span></a>
                    {{-- <div class="submenu-content">
                        <a href="{{route('service.pendingServices')}}" class="menu-item {{ ($segment1 == 'suppliers') ? 'active' : '' }}">Pending Services</a>
                        <a   class="menu-item {{ ($segment1 == 'customers') ? 'active' : '' }}">Service List</a>
                    </div> --}}
                </div>
                
                <div class="nav-item {{ ($segment1 == 'Debit/Credit') ? 'active' : '' }}">
                    <a href="{{route('debit_credit.index')}}"><i class="fa fa-university" aria-hidden="true"></i><span>{{ __('Debit/Credit')}}</span></a>
                </div>

                <div class="nav-item {{ ($segment1 == 'Expenses') ? 'active' : '' }}">
                    <a href="{{route('expense.index')}}"><i class="fa fa-book" aria-hidden="true"></i><span>{{ __('Expenses')}}</span></a>
                </div>
               
                @can('admin')
                <div class="nav-item {{ ($segment1 == 'reports') ? 'active' : '' }}">
                    <a href="{{route('reports.index')}}"><i class="fa fa-calculator"></i><span>{{ __('Reports')}}</span></a>
                </div>
                @endcan

                <!-- end inventory pages -->

                
        </div>
    </div>
</div>