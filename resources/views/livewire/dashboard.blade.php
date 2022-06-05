<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Dashboard</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard Data</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">2,064</h1>
                    <h6 class="text-white">Sessions</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-primary text-center">
                    <h1 class="font-light text-white">1,738</h1>
                    <h6 class="text-white">Users</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-success text-center">
                    <h1 class="font-light text-white">5963</h1>
                    <h6 class="text-white">Page Views</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-dark text-center">
                    <h1 class="font-light text-white">2.9s</h1>
                    <h6 class="text-white">Pages/Session</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-megna text-center">
                    <h1 class="font-light text-white">1.5s</h1>
                    <h6 class="text-white">Avg. Session</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white">10%</h1>
                    <h6 class="text-white">Bounce Rate</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @livewire('widget.chart1')
        @livewire('widget.chart2')
        @livewire('widget.chart3')
        @livewire('widget.chart4')
    </div>
</div>
