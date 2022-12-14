<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md bg-white">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header text-center" style="margin-bottom: -80px;">
            {{--<h4 class="text-center fw-bold">RMS</h4>--}}
            <img src="{{ asset('assets/frontend/images/logo.png') }}" class="mb-1 p-2 bg-white"
                 style="max-width: 80%; height: auto;">
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        {{--Use btrc class for topbar green--}}
        <div class="navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark"
                                        href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                <li class="nav-item"><a
                        class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark bg-white"
                        href="javascript:void(0)"><i class="icon-menu"></i></a></li>
            </ul>
            <!-- User profile and search -->
            <!-- ============================================================== -->
                <marquee width="100%" direction="left" class="fw-bold">
                    Bangladesh Telecommunication Regulatory Commission (BTRC)
                </marquee>
            <ul class="navbar-nav my-lg-0 bg-white">
                <li class="nav-item dropdown">
                    <a class="nav-link waves-effect dropdown-toggle waves-dark text-warning" href="{{ route('activity') }}?type=edit"> <i class="far fa-edit"></i> @if(edit_activity_count() > 0) {{ edit_activity_count() }}
                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div> @endif
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link waves-effect dropdown-toggle waves-dark text-danger" href="{{ route('activity') }}?type=delete"> <i class="fas fa-prescription-bottle-alt"></i> @if(delete_activity_count() > 0) {{ delete_activity_count() }}
                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div> @endif
                    </a>
                </li>
                <li class="nav-item dropdown" style="margin-right: 20px;">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-bs-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false"> <i class="ti-user"></i>
                        <div class="notify"><span class="heartbit"></span> <span class="point"></span></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end mailbox animated bounceInDown">
                        <ul>
                            <li>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 col-lg-3 text-center">
                                                <a href="{{ route('profile') }}"><img
                                                        src="{{ asset(auth()->user()->image ?? 'assets/images/users/2.jpg') }}"
                                                        width="90" alt="user" class="img-circle img-fluid"></a>
                                            </div>
                                            <div class="col-md-8 col-lg-9">
                                                <h3 class="box-title m-b-0">{{ auth()->user()->name }}</h3>
                                                <small>{{ auth()->user()->email }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="text-center">
                                @can('profile')
                                    <a class="nav-link text-center link" href="{{ route('profile') }}"> <strong>Profile
                                            Setting</strong> <i class="fa fa-angle-right"></i> </a>
                                @endcan
                                <a href="javascript:void(0);" class="btn btn-primary logout-btn">Logout</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
