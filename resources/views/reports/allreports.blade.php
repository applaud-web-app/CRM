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
                        <button onclick="startFCM()" class="button "> Click</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        
        // const barChart_3 = document.getElementById("barreport").getContext('2d');
		// 	//generate gradient
			

		// 	new Chart(barChart_3, {
		// 		type: 'bar',
		// 		data: barChartData,
		// 		options: {
		// 			legend: {
		// 				display: false
		// 			}, 
		// 			title: {
		// 				display: false
		// 			},
		// 			tooltips: {
		// 				mode: 'index',
		// 				intersect: false
		// 			},
		// 			responsive: true,
		// 			scales: {
		// 				xAxes: [{
		// 					stacked: true,
		// 				}],
		// 				yAxes: [{
		// 					stacked: true
		// 				}]
		// 			}
		// 		}
		// 	});




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
    </script>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js"></script>
<script>
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
        </script>
@endpush
