@extends('master')
@section('main-content')
    <!--**********************************
                        Content body start
                    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="mb-sm-3 d-flex flex-wrap align-items-center text-head">
                <h2 class="mb-3 me-auto">Dashboard</h2>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    </ol>
                </div>
            </div>

            <div class="row gx-2">
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <div class="media ai-icon">
                                <span class="me-3 bgl-primary text-primary">
                                    <!-- <i class="ti-user"></i> -->
                                    <svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30"
                                        height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Enquiry</p>
                                    <h4 class="mb-0">
                                        {{ $data['enquiry'] >= 10 ? $data['enquiry'] : '0' . $data['enquiry'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <div class="media ai-icon">
                                <span class="me-3 bgl-primary text-primary">
                                    <!-- <i class="ti-user"></i> -->
                                    <svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30"
                                        height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Leads</p>
                                    <h4 class="mb-0">{{ $data['leads'] >= 10 ? $data['leads'] : '0' . $data['leads'] }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <div class="media ai-icon">
                                <span class="me-3 bgl-primary text-primary">
                                    <!-- <i class="ti-user"></i> -->
                                    <svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30"
                                        height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Approved Leads</p>
                                    <h4 class="mb-0">
                                        {{ $data['approved'] >= 10 ? $data['approved'] : '0' . $data['approved'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <div class="media ai-icon">
                                <span class="me-3 bgl-primary text-primary">
                                    <!-- <i class="ti-user"></i> -->
                                    <svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30"
                                        height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Pending Leads</p>
                                    <h4 class="mb-0">
                                        {{ $data['pending'] >= 10 ? $data['pending'] : '0' . $data['pending'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <div class="media ai-icon">
                                <span class="me-3 bgl-primary text-primary">
                                    <!-- <i class="ti-user"></i> -->
                                    <svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30"
                                        height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Rejected Leads</p>
                                    <h4 class="mb-0">{{ $leadcount['rejected'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @role('Superadmin')
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="widget-stat card">
                            <div class="card-body">
                                <div class="media ai-icon">
                                    <span class="me-3 bgl-primary text-primary">
                                        <!-- <i class="ti-user"></i> -->
                                        <svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30"
                                            height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    </span>
                                    <div class="media-body">
                                        <p class="mb-1">Total Employees</p>
                                        <h4 class="mb-0">{{ $employees }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endrole
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 ">
                    <div class="card">
                        <div class="card-header border-1 flex-wrap pb-0">
                            <div class="mb-sm-0 mb-2">
                                <h4 class="fs-20">Today’s Overview</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="enquiry"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-6 ">
                    <div class="card">
                        <div class="card-header border-1 flex-wrap pb-0">
                            <div class="mb-sm-0 mb-2">
                                <h4 class="fs-20">Exployee's Today Overview</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="leads"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Monthly Leads</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="barreport"></canvas>
                        </div>
                    </div>
                </div>

                {{-- //enquiry chart data --}}
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Monthly Enquiries</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="linereport"></canvas>
                        </div>
                    </div>
                </div>

                {{-- Employee chart --}}
                <div class="col-lg-6 col-md-6 col-sm-6 ">
                    <div class="card">
                        <div class="card-header border-1 flex-wrap pb-0">
                            <div class="mb-sm-0 mb-2">
                                <h4 class="fs-20">Approved Leads</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="checking"></div>
                        </div>
                    </div>
                </div>

                {{-- leads chart --}}
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Rejected Leads</h4>
                        </div>
                        <div class="card-body">
                            <div id="rejected"></div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pending Leads</h4>
                        </div>
                        <div class="card-body">
                            <div id="pending"></div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!--**********************************
                        Content body end
                    ***********************************-->

    <!-- Modal -->
    <div class="modal fade" id="notificationPermissionModal" tabindex="-1" role="dialog"
        aria-labelledby="notificationPermissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationPermissionModalLabel">Notification Permission</h5>
                </div>
                <div class="modal-body">
                    <p>Do you allow us to send you notifications?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()"
                        data-dismiss="modal">Deny</button>
                    <button type="button" class="btn btn-primary" onclick="startFCM()"
                        id="allowNotificationBtn">Allow</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js"></script>
    <script>
        $(document).ready(function() {
            var deviceToken = '{{ Auth::user()->device_token }}';
            if (!deviceToken) {
                $('#notificationPermissionModal').modal('show');
            }
        });

        var firebaseConfig = {
            apiKey: "AIzaSyB9FzIUo3bBKunVLVqi1o0M9gVqeX_VoHo",
            authDomain: "laravelpushnotification-78b76.firebaseapp.com",
            projectId: "laravelpushnotification-78b76",
            storageBucket: "laravelpushnotification-78b76.appspot.com",
            messagingSenderId: "724240981380",
            appId: "1:724240981380:web:e5272851af03d4c37e51d1",
            measurementId: "G-TSQ5CB26NT"
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        function startFCM() {
            messaging
                .requestPermission()
                .then(function() {
                    return messaging.getToken()
                }).then(function(response) {
                    console.log(response);
                    $('#notificationPermissionModal').modal('hide');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    $.ajax({
                        url: '{{ route('saveToken') }}',
                        type: 'POST',
                        data: {
                            notify_token: response
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(error) {
                            console.log(error);
                        },
                    });
                }).catch(function(error) {
                    alert(error);
                });
        }

        function closeModal() {
            $('#notificationPermissionModal').modal('hide');
        }
    </script>


    <script>
        todayEnquiry = {{ $data['todayenquiry'] }};
        todayleads = {{ $data['todayleads'] }};
        todayapprovedleads = {{ $data['todayapprovedleads'] }};
        todayrejectedleads = {{ $data['todayrejectedleads'] }};
        todaypendingleads =  {{ $data['todaypendingleads'] }};
        console.log(todaypendingleads);
        if (todayEnquiry === 0 && todayleads === 0 && todayapprovedleads === 0 && todayrejectedleads === 0 && todaypendingleads  === 0) {
            document.querySelector("#enquiry").innerHTML = "No new data available for today";
        } else {
            var options = {
                series: [todayEnquiry, todayleads, todayapprovedleads,todaypendingleads, todayrejectedleads],
                colors:['#008ffb', '#d96ad5', '#00e396','#feb019','#FF1752'],
                labels: ['Enquiry', 'Converted to Leads', 'Approved Leads', 'Pending', 'Rejected Leads'],
                chart: {
                    type: 'pie',
                    sparkline: {
                        enabled: true
                    },
                    width: '100%',
                    height: 400,
                },
                stroke: {
                    width: 1
                },
                tooltip: {
                    fixed: {
                        enabled: false
                    },
                },
                fill:{
                    opacity:1,
                },
                legend: {
                    show: true,
                    position: 'bottom',
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 100
                        },
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#enquiry"), options);
            chart.render();
        }
    </script>

    <script>
        var options = {
            series: [
                { name: 'Today Leads', data: @php echo $totalLeadsJson; @endphp }, 
                { name: 'Approved Leads',data: @php echo $totalApprovedLeadsJson; @endphp}, 
                { name: 'Rejected Leads', data: @php echo $totalRejectedLeadsJson; @endphp}
            ],
            colors:['#008ffb','#00e396','#FF1752'],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '20%',
                    endingShape: 'rounded',
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: @php
                    echo $usernamesJson;
                @endphp,
            },
            yaxis: {
                title: {
                    text: 'Leads'
                }
            },
            fill: {
                opacity: 1,
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " Leads"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#leads"), options);
        chart.render();
    </script>




    <script>
        //bar chart
        const barChart_1 = document.getElementById("barreport").getContext('2d');
        const months = [
            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
            'November', 'December'
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
                datasets: [{
                    label: "Leads",
                    data: leaddata,
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
            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
            'November', 'December'
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

    <script>
        const leadmonth = {};
        const leadsapproved = @php echo $leadsapproved @endphp;
        leadsapproved.forEach(data => {
            const monthName = new Date(data.month + '-01').toLocaleString('default', {
                month: 'long'
            });
            leadmonth[monthName] = data.count;
        });

        // Creating labels and data arrays for the chart
        const apprleadlabels = [];
        const apprleaddata = [];
        const approvedmonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
            'October', 'November', 'December'
        ];
        approvedmonths.forEach(month => {
            apprleadlabels.push(month);
            apprleaddata.push(leadmonth[month] || 0);
        });

        // ApexCharts options
        var options4 = {
            series: [{
                name: 'Approved Leads',
                data: apprleaddata
            }],
            chart: {
                type: 'bar',
                height: 250
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '30%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: apprleadlabels,
            },
            yaxis: {
                title: {
                    text: 'Approved Leads'
                }
            },
            fill: {
                opacity: 1,
                colors: ['#00e396']
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " leads"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#checking"), options4);
        chart.render();
    </script>

    {{-- Rejected leads chart script --}}
    <script>
        const rejected_leadmonth = {};
        const leadsrejected = @php echo $leadsrejected @endphp;
        leadsrejected.forEach(data => {
            const rejected_monthName = new Date(data.month + '-01').toLocaleString('default', {
                month: 'long'
            });
            rejected_leadmonth[rejected_monthName] = data.count;
        });

        const rejected_leadlabels = [];
        const rejected_leaddata = [];
        const rejected_months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
            'October', 'November', 'December'
        ];
        rejected_months.forEach(month => {
            rejected_leadlabels.push(month);
            rejected_leaddata.push(rejected_leadmonth[month] || 0);
        });

        // ApexCharts options
        var options5 = {
            series: [{
                name: 'Rejected Leads',
                data: rejected_leaddata
            }],
            chart: {
                type: 'bar',
                height: 250
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '30%',
                    endingShape: 'rounded',
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: rejected_leadlabels,
            },
            yaxis: {
                title: {
                    text: 'Rejeceted Leads'
                }
            },
            fill: {
                opacity: 1,
                colors: ['#FF1752']
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " leads"
                    }
                }
            }
        };

        // Rendering the chart
        var chart2 = new ApexCharts(document.querySelector("#rejected"), options5);
        chart2.render();
    </script>

    <script>
        const pending_leadmonth = {};
        const leadspending = @php echo $leadspending @endphp;
        leadspending.forEach(data => {
            const pending_monthName = new Date(data.month + '-01').toLocaleString('default', {
                month: 'long'
            });
            pending_leadmonth[pending_monthName] = data.count;
        });

        const pending_leadlabels = [];
        const pending_leaddata = [];
        const pending_months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
            'October', 'November', 'December'
        ];
        pending_months.forEach(month => {
            pending_leadlabels.push(month);
            pending_leaddata.push(pending_leadmonth[month] || 0);
        });

        var options6 = {
            series: [{
                name: 'Pending Leads',
                data: pending_leaddata
            }],
            chart: {
                type: 'bar',
                height: 250
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '30%',
                    endingShape: 'rounded',
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: pending_leadlabels,
            },
            yaxis: {
                title: {
                    text: 'Pending Leads'
                }
            },
            fill: {
                opacity: 1,
                colors: ['#feb019']
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " leads"
                    }
                }
            }
        };
        var chart3 = new ApexCharts(document.querySelector("#pending"), options6);
        chart3.render();
    </script>
@endpush
