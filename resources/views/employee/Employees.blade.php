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
                                        <th>#</th>
                                           
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Score </th>
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
                    data: 'profile_img', 
                    name: 'profile_img',
                    render: function(data, type, row, meta) {
                        if (type === 'display' && data) {
                            return '<img src="assets/images/' + data + '" class="rounded-circle" style="width:50px;height:50px;">'+" "+row.first_name ;
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
@endpush    
