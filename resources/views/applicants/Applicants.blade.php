@extends('master')
@section('main-content')
    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}">
    @endpush
    <section class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center text-head">
                <a class="backbtn mb-3 mx-2" href="{{url()->previous()}}"><i class="fa fa-arrow-left"></i></a>
                <h2 class="mb-3 me-auto">Applicants</h2>
                <div>
                    <a href="{{ route('addnewapplicant') }}" class="btn btn-primary  mb-sm-0 mb-2"><i
                            class="fas fa-plus pe-2"></i>Add New</a>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">

                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="display data-table" style="min-width: 100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                #
                                            </th>
                                            <th> Name</th>
                                            <th>Contact Info</th>
                                            <th>Date of Birth</th>
                                            <th>Status</th>
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
                pageLength: 10,
                language: {
                    paginate: {
                        previous: '<i class="fas fa-angle-double-left"></i>',
                        next: '<i class="fas fa-angle-double-right"></i>'
                    }
                },
                ajax: {
                    url: "{{ route('allapplicants') }}",
                },
                deferRender: true,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row, meta) {
                        if (type === 'display' && data) {
                             return '<img src="uploads/applicants/' + data.image + '" class="img-thumbnail rounded-circle me-1" style="width:50px;">' + " " + data.name;
                        } else {
                            return data.name;
                        }
                    }
                    },
                    {
                        data: 'email',
                        name: 'email',
                        render: function(data, type, full, meta) {
                            var dataArray = data.split(' ');
                            return '<span class="d-block"><i class="fas fa-envelope pe-2"></i>' +
                                dataArray[0] + '<br>' +
                                '<span class="d-block"><i class="fas fa-mobile pe-2"></i>' +
                                dataArray[1] + '</span>';

                        }
                    },

                    {
                        data: 'dob',
                        name: 'dob',
                        render:function(data)
                        {
                            var date = new Date(data);
                            var formattedDate = date.toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric' });
                            return '<span><i class="fas fa-calendar"></i> '+formattedDate+'</span>'
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, full, meta) {
                            if (full.proccess_status == 'approved') {
                                return '<span class="badge badge-success light">Approved</span>';
                            }
                        }
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
