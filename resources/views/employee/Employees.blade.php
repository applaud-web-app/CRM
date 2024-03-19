@extends("master")
@section('main-content')
@push('style')
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}">
@endpush
<section class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class=" d-flex flex-wrap align-items-center text-head">
            <h2 class="mb-3 me-auto">Employees</h2>
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        
                <div>
                    <a href="{{route('addEmployee')}}" class="btn btn-primary  mb-sm-0 mb-2"><i class="fas fa-plus pe-2"></i>Add New</a>
                </div>
            </div>
        </div>
        
        

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="table-responsive ">
                            <table class="table display data-table" style="min-width: 100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Score</th>
                                        <th>Joining Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
@push('scripts')
<script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            pageLength:10,
            language: {
                paginate: {
                previous: '<i class="fas fa-angle-double-left"></i>',
                next: '<i class="fas fa-angle-double-right"></i>'
                }
            },
            ajax: {
                url: "{{ route('viewEmployee') }}",
            },
            deferRender: true,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id',
                    orderable: false,
                    searchable: false
                },
                {
                    data:'emp_code',
                    name:'code'
                },
                
                {
                    data: 'profile_img',
                    name: 'profile_img',
                    render: function(data, type, row, meta) {
                        if (type === 'display') {
                            if (data && data.trim() !== '') {
                                return '<img src="{{url("/")}}/uploads/users/' + data + '" class="rounded-circle" style="width:50px;height:50px;">' + " " + row.first_name;
                            } else {
                                return '<img src="assets/images/user.jpg" class="rounded-circle" style="width:50px;height:50px;">' + " " + row.first_name;
                            }
                        } else {
                            return row.first_name + ' ' + row.last_name;
                        }
                    }
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'score',
                    name: 'score'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true
                }
            ],
        });
    });
</script>

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

    

    messaging.onMessage(function(payload) {
        console.log(payload.notification.data.url);
        console.log(payload.notification.body);

        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            image: payload.notification.image,
        };
        new Notification(title, options);
    });
</script> 
@endpush    
