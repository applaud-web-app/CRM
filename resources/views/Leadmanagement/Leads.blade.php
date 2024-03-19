@extends('master')
@section('main-content')
    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}">
    @endpush
    <section class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center text-head">
                <h2 class="mb-3 me-auto">All Leads</h2>
                <div class="">
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#bulkUploadModal" class="btn btn-secondary mb-3"><i class="fas fa-upload pe-2"></i>Bulk Upload</a>
                    <a href="{{ route('createlead') }}" class="btn btn-primary  mb-3"><i class="fas fa-plus pe-2"></i>Add New</a>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

            </div>


            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table display data-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Contact Info</th>
                                            <th>Value</th>
                                            <th>Assigned To</th>
                                            <th>Source</th>
                                            <th>Created</th>
                                            <th>Type</th>
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
    <script>
        function leaddata(e, leadid) {

            var selectedIndex = e.target.selectedIndex;
            var lead = e.target.options[selectedIndex].value;
            var url = "{{ route('updateleadtype', ':id') }}";
            url = url.replace(':id', leadid);
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    leadtype: lead,
                    _token: "{{ csrf_token() }}",
                },

                success: function(result) {
                    if (result === "success") {
                        iziToast.success({
                            message: 'Lead type changed',
                            position: 'topRight'
                        });
                    } else {
                        iziToast.error({
                            message: 'Lead type not changed',
                            position: 'topRight'
                        });
                    }
                }
            });
        }

        function statuschange(e, leadid) {
            var selectedIndex = e.target.selectedIndex;
            var status = e.target.options[selectedIndex].value;

            var url = "{{ route('updatestatustype', ':id') }}";
            url = url.replace(':id', leadid);
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    status: status,
                    _token: "{{ csrf_token() }}",
                },

                success: function(result) {
                    if (result === "success") {
                        iziToast.success({
                            message: 'Status type changed',
                            position: 'topRight'
                        });
                    } else {
                        iziToast.error({
                            message: 'Status type not changed',
                            position: 'topRight'
                        });
                    }
                }
            });
        }
    </script>

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
                    url: "{{ route('leads') }}",
                },
                deferRender: true,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data:'code',
                        name:'code'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        width: '100px',
                        render: function(data, type, full, meta) {
                            if (full.proccess_status == 'rejected') {
                                return data+'<span><i class="fa fa-circle text-danger ms-1 fs-12"></i></span> ';
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'employee.first_name',
                        name: 'employee.first_name'
                    },
                    {
                        data: 'source',
                        name: 'source'
                    },
                    {
                        data: 'contacted_date',
                        name: 'contacted_date'
                    },
                    {
                        data: 'lead_type',
                        name: 'lead_type'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true
                    }
                ],
                createdRow: function(row, data, dataIndex) {
                    var leadTypeSelect = '<select name="lead_type" onchange="leaddata(event,' + data
                        .id + ')" class="form-select" id="leads">' +
                        '<option value="Hot leads" ' + (data.lead_type === "Hot leads" ? "selected" :
                            "") + '>Hot Lead</option>' +
                        '<option value="Warm leads" ' + (data.lead_type === "Warm leads" ? "selected" :
                            "") + '>Warm Lead</option>' +
                        '<option value="Cold leads" ' + (data.lead_type === "Cold leads" ? "selected" :
                            "") + '>Cold Lead</option>' +
                        '</select>';
                    var statusSelect = '<select name="status" onchange="statuschange(event,' + data.id +
                        ')" class="form-select" id="status_type">' +
                        '<option value="Generated" ' + (data.status === "Generated" ? "selected" : "") +
                        '>Generated</option>' +
                        '<option value="Qualified" ' + (data.status === "Qualified" ? "selected" :
                            "") + '>Qualified</option>' +
                        '<option value="Initial Contact" ' + (data.status === "Initial Contact" ? "selected" : "") +
                        '>Initial Contact</option>' +
                        '<option value="Schedule Appointemnt" ' + (data.status === "Schedule Appointemnt" ? "selected" : "") +
                        '>Schedule Appointemnt</option>' +
                        '<option value="Proposal Sent" ' + (data.status === "Proposal Sent" ? "selected" : "") +
                        '>Proposal Sent</option>' +
                        '<option value="Open" ' + (data.status === "Open" ? "selected" : "") +
                        '>Open</option>' +
                        '<option value="Close" ' + (data.status === "Close" ? "selected" : "") +
                        '>Close</option>' +
                        '</select>';
                    $('td:eq(8)', row).html(leadTypeSelect);
                    $('td:eq(9)', row).html(statusSelect);
                },
            });
        });
    </script>
@endpush
