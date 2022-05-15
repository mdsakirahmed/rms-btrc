<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User Profile-->
        <div class="user-profile">
            <div class="user-pro-body">
                <div><img src="{{ asset('assets/images/users/2.jpg') }}" alt="user-img" class="img-circle"></div>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}<span class="caret"></span></a>
                    <div class="dropdown-menu animated flipInY">
                        <!-- text-->
                        @can('profile')
                        <a href="{{ route('profile') }}" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                        @endcan
                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="javascript:void(0)" class="dropdown-item logout-btn"><i class="fa fa-power-off"></i> Logout</a>
                        <!-- text-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class="waves-effect waves-dark" href="{{ route('dashboard') }}" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a></li>
                @can('application')
                <li> <a class="waves-effect waves-dark" href="{{ route('application') }}" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">Application</span></a></li>
                @endcan
                @can('operator')
                <li> <a class="waves-effect waves-dark" href="{{ route('operator') }}" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">Operator</span></a></li>
                @endcan
                @can('payment')
                <li class="{{ request()->is('payment*') ? 'active' : '' }}"> <a class="waves-effect waves-dark {{ request()->is('payment*') ? 'active' : '' }}" href="{{ route('payment') }}" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">Payment</span></a></li>
                @endcan
                @can('document')
                <li> <a class="waves-effect waves-dark" href="{{ route('document') }}" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">Document</span></a></li>
                @endcan
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-media-right-alt"></i><span class="hide-menu">User Access</span></a>
                    <ul aria-expanded="false" class="collapse">
                        @can('user')
                        <li> <a href="{{ route('user') }}">User</a></li>
                        @endcan
                        @can('permission-management')
                        <li> <a href="{{ route('permission-management') }}">Permission management</a></li>
                        @endcan
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-media-right-alt"></i><span class="hide-menu">Setting</span></a>
                    <ul aria-expanded="false" class="collapse">
                        @can('bank')
                        <li> <a href="{{ route('bank') }}">Bank</a></li>
                        @endcan
                        @can('fee-type')
                        <li> <a href="{{ route('fee-type') }}">Fee type</a></li>
                        @endcan
                        @can('license-category')
                        <li> <a href="{{ route('license-category') }}">Category</a></li>
                        @endcan
                        @can('license-sub-category')
                        <li> <a href="{{ route('license-sub-sategory') }}">Sub-Category</a></li>
                        @endcan
                    </ul>
                </li>
                @can('report')
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-media-right-alt"></i><span class="hide-menu">Report</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a href="{{ route('operator-wise-file-register') }}">Operator wise file register</a></li>
                        <li> <a href="{{ route('operator-detail') }}">Operator detail</a></li>
                        <li> <a href="{{ route('vat-statement') }}">VAT statement</a></li>
                        <li> <a href="{{ route('due-statement') }}">Due statement</a></li>
                    </ul>
                </li>
                @endcan
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
