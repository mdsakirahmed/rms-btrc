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
        @foreach($cards as $card)
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box text-center" style="background-color: {{ $card->color }};">
                    <h1 class="font-light text-white">{{ $card->value }}</h1>
                    <h6 class="text-white">{{ $card->title }}</h6>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        @livewire('widget.chart1')
        @livewire('widget.chart2')
        @livewire('widget.chart3')
        @livewire('widget.chart4')
    </div>
</div>
