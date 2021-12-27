<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User Profile-->
        <div class="user-profile">
            <div class="user-pro-body">
                <div><img src="assets/images/users/2.jpg" alt="user-img" class="img-circle"></div>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu"
                        data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Steave
                        Gection <span class="caret"></span></a>
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
                        <a href="javascript:void(0)" class="dropdown-item"><i class="ti-settings"></i> Account
                            Setting</a>
                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="javascript:void(0)" class="dropdown-item logout-btn"><i class="fa fa-power-off"></i>
                            Logout</a>
                        <!-- text-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">--- BTRC</li>
                <li> <a class="waves-effect waves-dark" href="{{ route('dashboard') }}" aria-expanded="false"><i
                            class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a></li>
                @can('user')
                <li> <a class="waves-effect waves-dark" href="{{ route('user') }}" aria-expanded="false"><i
                            class="far fa-circle text-info"></i><span class="hide-menu">User</span></a></li>
                @endcan
                @can('document')
                <li> <a class="waves-effect waves-dark" href="{{ route('document') }}" aria-expanded="false"><i
                            class="far fa-circle text-info"></i><span class="hide-menu">Document</span></a></li>
                @endcan

                @can('payment-receive')
                <li> <a class="waves-effect waves-dark" href="{{ route('payment-receive') }}" aria-expanded="false"><i
                            class="far fa-circle text-info"></i><span class="hide-menu">Payment Receive</span></a></li>
                @endcan
                @can('license')
                <li> <a class="waves-effect waves-dark" href="{{ route('license') }}" aria-expanded="false"><i
                            class="far fa-circle text-info"></i><span class="hide-menu">License</span></a></li>
                @endcan
                @can('permission-management')
                <li> <a class="waves-effect waves-dark" href="{{ route('permission-management') }}" aria-expanded="false"><i
                            class="far fa-circle text-info"></i><span class="hide-menu">Permission</span></a></li>
                @endcan
                @can('report')
                <li> <a class="waves-effect waves-dark" href="{{ route('report') }}" aria-expanded="false"><i
                            class="far fa-circle text-info"></i><span class="hide-menu">Report</span></a></li>
                @endcan
                @can('my-license')
                <li> <a class="waves-effect waves-dark" href="{{ route('my-license') }}" aria-expanded="false"><i
                            class="far fa-circle text-info"></i><span class="hide-menu">My-License</span></a></li>
                @endcan
                @can('payment')
                <li> <a class="waves-effect waves-dark" href="{{ route('payment') }}" aria-expanded="false"><i
                            class="far fa-circle text-info"></i><span class="hide-menu">Payment</span></a></li>
                @endcan
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                            class="ti-layout-media-right-alt"></i><span class="hide-menu">Setting</span></a>
                    <ul aria-expanded="false" class="collapse">
                        @can('payment-method')
                        <li> <a href="{{ route('payment-method') }}">Payment Method</a></li>
                        @endcan
                        @can('license-category')
                        <li> <a href="{{ route('license-category') }}">License Category</a></li>
                        @endcan
                        @can('license-sub-category')
                        <li> <a href="{{ route('license-sub-sategory') }}">License Sub Category</a></li>
                        @endcan
                        @can('operator')
                        <li> <a href="{{ route('operator') }}">Operator</a></li>
                        @endcan
                        @can('receiver-fee')
                        <li> <a href="{{ route('receiver-fee') }}">Receiver-fee</a></li>
                        @endcan
                        @can('receiver-period')
                        <li> <a href="{{ route('receiver-period') }}">Receiver-period</a></li>
                        @endcan
                        @can('git')
                        <li> <a href="{{ route('git') }}">Git</a></li>
                        @endcan
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
