@extends('master')
@section('main-content')
    <section class="content-body">
        @push('style')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @endpush
        <!-- row -->
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center text-head">
                <h2 class="mb-3 me-auto">All Reports</h2>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3  col-lg-4 col-md-4 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body p-4">
                            <div class="media ai-icon">
                                <span class="me-3 bgl-primary text-primary">
                                    <i class="ti-user"></i>

                                </span>
                                <div class="media-body">
                                    <p class="mb-1 fs-14">Total Leads</p>
                                    <h4 class="mb-0">{{ $leadcount['total'] }}</h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3  col-lg-4 col-md-4 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body p-4">
                            <div class="media ai-icon">
                                <span class="me-3 bgl-primary text-primary">
                                    <i class="ti-user"></i>

                                </span>
                                <div class="media-body">
                                    <p class="mb-1 fs-14">Pending Leads</p>
                                    <h4 class="mb-0">{{ $leadcount['pending'] }}</h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3  col-lg-4 col-md-4 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body p-4">
                            <div class="media ai-icon">
                                <span class="me-3 bgl-primary text-primary">
                                    <i class="ti-user"></i>

                                </span>
                                <div class="media-body">
                                    <p class="mb-1 fs-14">Rejected Leads</p>
                                    <h4 class="mb-0">{{ $leadcount['rejected'] }}</h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3  col-lg-4 col-md-4 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body p-4">
                            <div class="media ai-icon">
                                <span class="me-3 bgl-primary text-primary">
                                    <i class="ti-user"></i>

                                </span>
                                <div class="media-body">
                                    <p class="mb-1 fs-14">Approved Leads</p>
                                    <h4 class="mb-0">{{ $leadcount['approved'] }}</h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Monthly Lead Reports</h4>
                        </div>
                        <div class="card-body">
                            <div class="chart_container">
                                <canvas id="myChart" ></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
@push('scripts')
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        ctx.height = 100;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($chartdata as $entry)
                        "{{ date('F', strtotime($entry->month)) }}",
                    @endforeach
                ],
                datasets: [{
                    label: 'Data by Month',
                    data: [
                        @foreach ($chartdata as $entry)
                            {{ $entry->count }},
                        @endforeach
                    ],
                    backgroundColor: 'red',
                    borderColor: 'rgba(253, 104, 62, 1)',
                    borderWidth: "0",
                    backgroundColor: 'rgba(253, 104, 62, 1)'
                }]
            },
            options: {
                legend: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1,
                            padding: 10
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 5,
                            barbarPercentage: 0.5
                        }
                    }]
                }
            }
        });
    </script>
@endpush
