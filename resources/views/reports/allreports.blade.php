@extends('master')
@section('main-content')
    <section class="content-body">
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
                <div class="col-12">
                    <div class="row">
                        {{-- leads chart data of user --}}
                        <div class="col-xl-6 col-lg-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Leads</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="barreport"></canvas>
                                </div>
                            </div>
                        </div>

                        {{-- //enquiry chart data --}}
                        <div class="col-xl-6 col-lg-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Enquiries</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="linereport"></canvas>
                                </div>
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
        //bar chart
        const barChart_1 = document.getElementById("barreport").getContext('2d');
        const months = [
            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
        ];

        const monthdata = {};
        @foreach ($leadsData as $data)
            var month = "{{ date('F', strtotime($data->month)) }}";
            if (monthdata.hasOwnProperty(month)) {
                monthdata[month] += {{ $data->count }};
            } else {
                monthdata[month] = {{ $data->count }};
            }
        @endforeach

        console.log(monthdata);
        const leadlabels = [];
        const leaddata = [];
        months.forEach(month => {
            leadlabels.push(month);
            leaddata.push(monthdata[month] || 0); 
        });
        new Chart(barChart_1, {
				type: 'bar',
				data: {
					defaultFontFamily: 'Poppins',
					labels: months,
					datasets: [
						{
							label: "Leads",
							data: leaddata,
							borderColor: 'rgba(253, 104, 62, 1)',
							borderWidth: "0",
							backgroundColor: 'rgba(253, 104, 62, 1)'
						}
					]
				},
				options: {
					legend: false, 
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true
							}
						}],
						xAxes: [{
							barPercentage: 0.5
						}]
					}
				}
			});
        // bar chart ends here




        // basic line chart
        const lineChart_1 = document.getElementById("linereport").getContext('2d');
        lineChart_1.height = 100;
        const allMonths = [
            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
        ];

        const monthcount = {};
        @foreach ($enquirydata as $data)
            monthcount["{{ date('F', strtotime($data->month)) }}"] = {{ $data->count }};
        @endforeach

        const labels = [];
        const data = [];
        allMonths.forEach(month => {
            labels.push(month);
            data.push(monthcount[month] || 0); 
        });
        new Chart(lineChart_1, {
            type: 'line',
            data: {
                defaultFontFamily: 'Poppins',
                labels: allMonths,
                datasets: [{
                    label: "Enquiries Generated",
                    data: data,
                    borderColor: 'rgba(253, 104, 62, 1)',
                    borderWidth: "2",
                    backgroundColor: 'transparent',
                    pointBackgroundColor: 'rgba(253, 104, 62, 1)'
                }]
            },
            options: {
                legend: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            min: 0,
                            stepSize: 5,
                            padding: 10
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            padding: 5
                        }
                    }]
                }
            }
        });
        // line chart ends here

    </script>
@endpush
