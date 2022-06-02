<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div style="width: 100%;" class="text-center">
        <img src="{{ asset('assets/frontend/images/logo.png') }}" class="mb-1 p-2 bg-white"
             style="max-width: 80%; height: auto;">
        <a class="navbar-brand" href="{{ route('dashboard') }}"><span>
                <p style="font-size: 12px; color:black;">Bangladesh Telecommunication <br> Regulatory Commission (BTRC)</p>
            </span>
        </a>
    </div>
    <div class="">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @can('my-dashboard')
                    <li><a class="waves-effect waves-dark" href="{{ route('dashboard') }}" aria-expanded="false"><i
                                class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a></li>
                @endcan
                @can('application')
                    <li><a class="waves-effect waves-dark" href="{{ route('application') }}" aria-expanded="false">
                            <i class="mdi mdi-file-document"></i><span class="hide-menu">Application</span></a></li>
                @endcan
                @can('operator')
                    <li><a class="waves-effect waves-dark" href="{{ route('operator') }}" aria-expanded="false"><i
                                class="mdi mdi-clipboard-account"></i><span class="hide-menu">Operator</span></a></li>
                @endcan
                @can('payment')
                    <li class="{{ request()->is('payment*') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('payment') }}" aria-expanded="false"><i
                                class="mdi mdi-cash"></i><span class="hide-menu">Collection</span></a></li>
                @endcan
                @can('document')
                    <li><a class="waves-effect waves-dark" href="{{ route('document') }}" aria-expanded="false"><i
                                class="mdi mdi-file-pdf"></i><span class="hide-menu">Document</span></a></li>
                @endcan
                @canany(['user', 'permission-management'])
                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                                class="mdi mdi-human-greeting"></i><span class="hide-menu">User Access</span></a>
                        <ul aria-expanded="false" class="collapse">
                            @can('user')
                                <li><a href="{{ route('user') }}">User</a></li>
                            @endcan
                            @can('permission-management')
                                <li><a href="{{ route('permission-management') }}">Permission Management</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['bank', 'fee-type', 'license-category', 'license-sub-category'])
                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                                class="mdi mdi-settings"></i><span class="hide-menu">Setting</span></a>
                        <ul aria-expanded="false" class="collapse">
                            @can('bank')
                                <li><a href="{{ route('bank') }}">Bank</a></li>
                            @endcan
                            @can('fee-type')
                                <li><a href="{{ route('fee-type') }}">Fee Type</a></li>
                            @endcan
                            @can('license-category')
                                <li><a href="{{ route('license-category') }}">Category</a></li>
                            @endcan
                            @can('license-sub-category')
                                <li><a href="{{ route('license-sub-sategory') }}">Sub-Category</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @can('report')
                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                                class="mdi mdi-file-find"></i><span class="hide-menu">Report</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('operator-wise-file-register') }}">Operator Wise File Register</a>
                            </li>
                            <li><a href="{{ route('operator-detail') }}">Operator Detail</a></li>
                            <li><a href="{{ route('vat-statement') }}">VAT Statement</a></li>
                            <li><a href="{{ route('due-statement') }}">Due Statement</a></li>
                            <li><a href="{{ route('revenue-sharing-statement') }}">Statement</a></li>
                        </ul>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
