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
                                    <h4 class="mb-0">{{ $data['enquiry'] >= 10 ? $data['enquiry'] : '0' . $data['enquiry'] }}</h4>
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
                                    <h4 class="mb-0">{{ $data['leads'] >= 10 ? $data['leads'] : '0' . $data['leads'] }}</h4>
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
                                    <h4 class="mb-0">{{ $data['approved'] >= 10 ? $data['approved'] : '0' . $data['approved'] }}</h4>
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
                                    <h4 class="mb-0">{{ $data['pending'] >= 10 ? $data['pending'] : '0' . $data['pending'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                                <h4 class="fs-20">Exployee's Overview</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="leads"></div>
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
        todayEnquiry={{$data['todayenquiry']}};
        todayleads={{$data['todayleads']}};
        todayapprovedleads={{$data['todayapprovedleads']}};
        todayrejectedleads={{$data['todayrejectedleads']}};
        if (todayEnquiry === 0 && todayleads === 0 && todayapprovedleads === 0 && todayrejectedleads === 0) {
            document.querySelector("#enquiry").innerHTML = "No new data available for today";
        } else {
          var options = {
          series: [todayEnquiry,todayleads,todayapprovedleads,todayrejectedleads],
          labels: ['Enquiry', 'Converted to Leads', 'Approved Leads', 'Rejected Leads'],
          chart: {
          type: 'pie',
            sparkline: {
            enabled: true
            },
            width: '100%', // Adjust the width of the chart
            height: 400,
            },
            stroke: {
            width:1
            },
            tooltip: {
            fixed: {
                enabled: false
            },
            },
            fill: {
            opacity: 1
            },
            legend: {
                show: true,
                position:'bottom'
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
          series: [{
          name: 'Today Leads',
          data: @php
              echo $totalLeadsJson;
          @endphp
        }, {
          name: 'Approved Leads',
          data: @php
              echo $totalApprovedLeadsJson;
          @endphp
        }, {
          name: 'Rejected Leads',
          data: @php
              echo $totalRejectedLeadsJson;
          @endphp
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '20%',
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
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return  val + " Leads"
            }
          }
        }
        };


        var chart = new ApexCharts(document.querySelector("#leads"), options);
        chart.render();
    </script>
@endpush
