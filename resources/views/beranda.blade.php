@extends('layouts.dashboard')
@section('content')
{{-- <div class="card mb-2">
    <div class="card-body">
        <h5 class="card-title">Welcome back</h5>
    </div>
</div> --}}
<div class="row">
    <div class="col-4">
        <div class="card bg-primary text-white">
            <div class="card-body"> stok barang yang kosong : {{ count($stockKosong) }}</div>
        </div>
    </div>
    <div class="col-4">
        <div class="card bg-warning text-white">
            <div class="card-body"> pesanan menunggu dicetak : {{ $menungguCetak }}</div>
        </div>
    </div>
    <div class="col-4">
        <div class="card bg-success text-white">
            <div class="card-body"> pesanan menunggu diambil : {{ $menungguDiambil }}</div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4 mt-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Kategori barang yang paling banyak terjual</h5>
                </div>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                        {{-- <a class="dropdown-item" href="javascript:void(0);">Select All</a> --}}
                        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                        {{-- <a class="dropdown-item" href="javascript:void(0);">Share</a> --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column align-items-center gap-1">
                        <h2 class="mb-2">{{ number_format($totalOrders) }}</h2>
                        <span>Total Orders</span>
                    </div>
                    <div id="orderChart"></div>
                </div>
                <ul class="p-0 m-0">
                    @foreach ($dataKategori as $index => $kategori)
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded 
                                    @switch($index)
                                        @case(0) bg-label-primary @break
                                        @case(1) bg-label-success @break
                                        @case(2) bg-label-info @break
                                        @default bg-label-secondary
                                    @endswitch">
                                <i class="bx bx-trophy"></i>
                            </span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">{{ $kategori->namaKategori }}</h6>
                            </div>
                            <div class="user-progress">
                                <small class="fw-semibold">{{ number_format($kategori->total_terjual) }}</small>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-8 col-xl-8 mb-4 mt-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Data Penjualan {{ date_create('now')->format('Y') }}</h5>
                </div>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                        {{-- <a class="dropdown-item" href="javascript:void(0);">Select All</a> --}}
                        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                        {{-- <a class="dropdown-item" href="javascript:void(0);">Share</a> --}}
                    </div>
                    
                </div>
            </div>
            <div class="card-body">
                <div id="salesLineChart"></div>
            </div>
        </div>
    </div>
</div>
@push('page-js')
<script>
    let cardColor, headingColor, axisColor, shadeColor, borderColor;
            
            cardColor = config.colors.white;
            headingColor = config.colors.headingColor;
            axisColor = config.colors.axisColor;
            borderColor = config.colors.borderColor;
            let chartLabels = @json($labels);
            let chartSeries = @json($series);
            let months = @json($months);
            let sales = @json($sales);
        
            let orderChartConfig = {
                chart: {
                    height: 165,
                    width: 130,
                    type: 'donut'
                },
                labels: chartLabels,
                series: chartSeries,
                colors: [config.colors.primary, config.colors.secondary, config.colors.info, config.colors.success],
                stroke: {
                    width: 5,
                    colors: cardColor
                },
                dataLabels: {
                    enabled: false,
                    formatter: function (val) {
                        return parseInt(val) + '%';
                    }
                },
                legend: { show: false },
                grid: {
                    padding: { top: 0, bottom: 0, right: 15 }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '75%',
                            labels: {
                                show: true,
                                value: {
                                    fontSize: '1.5rem',
                                    fontFamily: 'Public Sans',
                                    color: headingColor,
                                    offsetY: -15,
                                    formatter: function (val) {
                                        return parseInt(val) + '%';
                                    }
                                },
                                name: { offsetY: 20, fontFamily: 'Public Sans' },
                                total: {
                                    show: true,
                                    fontSize: '0.8125rem',
                                    color: axisColor,
                                    label: 'Total',
                                    formatter: function (w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0) + ' unit';
                                    }
                                }
                            }
                        }
                    }
                }
            };
            let salesLineConfig = {
            chart: {
            type: 'line',
            height: 350,
            toolbar: { show: false }
            },
            series: [{
            name: 'Total Penjualan',
            data: sales
            }],
            xaxis: {
            categories: months
            },
            colors: [config.colors.primary],
            stroke: {
            width: 3,
            curve: 'smooth'
            },
            markers: {
            size: 5,
            colors: config.colors.primary,
            strokeColors: '#fff',
            strokeWidth: 2,
            hover: { size: 7 }
            },
            dataLabels: { enabled: true },
            grid: { strokeDashArray: 4 },
            yaxis: {
            title: { text: 'Jumlah Order' }
            }
            };
        
            new ApexCharts(document.querySelector("#orderChart"), orderChartConfig).render();
            new ApexCharts(document.querySelector("#salesLineChart"), salesLineConfig).render();
</script>
@endpush
@endsection