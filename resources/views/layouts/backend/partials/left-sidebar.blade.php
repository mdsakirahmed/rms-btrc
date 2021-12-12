<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User Profile-->
        <div class="user-profile">
            <div class="user-pro-body">
                <div><img src="assets/images/users/2.jpg" alt="user-img" class="img-circle"></div>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Steave Gection <span class="caret"></span></a>
                    <div class="dropdown-menu animated flipInY">
                        <!-- text-->
                        <a href="javascript:void(0)" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                        <!-- text-->
                        <a href="javascript:void(0)" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                        <!-- text-->
                        <a href="javascript:void(0)" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="javascript:void(0)" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
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
                <li class="nav-small-cap">--- BTRC</li>
                <li> <a class="waves-effect waves-dark" href="{{ route('dashboard') }}" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a></li>
                @can('manage user permission')
                <li> <a class="waves-effect waves-dark" href="{{ route('user-permission.index') }}" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">Role & Permission</span></a></li>
                <li> <a class="waves-effect waves-dark" href="{{ route('role.index') }}" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">Role Management</span></a></li>
                @endcan
                @can('product list')
                <li> <a class="waves-effect waves-dark" href="{{ route('product.index') }}" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">Product</span></a></li>
                @endcan  
                @can('user')
                <li> <a class="waves-effect waves-dark" href="{{ route('user') }}" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">User</span></a></li>
                @endcan  
                @can('document')
                <li> <a class="waves-effect waves-dark" href="{{ route('document') }}" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">Document</span></a></li>
                @endcan  
                @can('license category')
                <li> <a class="waves-effect waves-dark" href="{{ route('licenseCategory') }}" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">License Category</span></a></li>
                @endcan  
                @can('license sub category')
                <li> <a class="waves-effect waves-dark" href="{{ route('licenseSubCategory') }}" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">License Sub Category</span></a></li>
                @endcan  
                @can('operator')
                <li> <a class="waves-effect waves-dark" href="{{ route('operator') }}" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">Operator</span></a></li>
                @endcan  
                @can('receiver-fee')
                <li> <a class="waves-effect waves-dark" href="{{ route('receiver-fee') }}" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">Receiver-fee</span></a></li>
                @endcan  
                @can('receiver-period')
                <li> <a class="waves-effect waves-dark" href="{{ route('receiver-period') }}" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">Receiver-period</span></a></li>
                @endcan  
                @can('payment receive')
                <li> <a class="waves-effect waves-dark" href="{{ route('paymentReceive') }}" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">Payment Receive</span></a></li>
                @endcan  
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
