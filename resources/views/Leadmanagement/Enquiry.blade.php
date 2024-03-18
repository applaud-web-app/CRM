@extends('master')
@section('main-content')
    <!--**********************************
                    Content body start
        ***********************************-->
    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}">
    @endpush
    <section class="content-body">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center text-head">
                <h2 class="mb-3 me-auto">Enquiries</h2>
                <div class="">
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#bulkUploadModal"
                        class="btn btn-secondary mb-3"><i class="fas fa-upload pe-2"></i>Bulk Upload</a>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal"
                        class="btn btn-primary   mb-3"><i class="fas fa-plus pe-2"></i>Add New</a>

                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="table-responsive ">
                                <table class="table display data-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Enquiry Name</th>
                                            <th>Mobile No.</th>
                                            <th>Email Address</th>
                                            <th>Interest In</th>
                                            <th>Date</th>
                                            <th>Sources</th>
                                            <th width="100px">Action</th>
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

    <div class="modal fade " id="bulkUploadModal" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('bulkUploadEnquiry') }}" id="uploadExcel" method="POST" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Bulk Upload</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-3 text-dark">To download a demo Excel file, just click the link below and download the
                            provided Excel file. Review any accompanying instructions to ensure proper formatting. Prepare
                            your data accordingly, then follow the platform's upload process, verifying success afterward.
                            <a href="{{asset('/assets/images/Enquiry-Demo-File.xlsx')}}" class="text-primary text-decoration-underline"
                                download><i class="fas fa-download"></i> Download Demo File(Excel)</a>
                        </p>
                        <div class="form-group mb-2">
                            <label class="form-label" for="title">Upload File (.xlsx)</label>
                            <input type="file" class="form-control form-file" name="excel_file" id="excel_file"
                                placeholder="Upload File" required>
                        </div>

                        <em class="text-dark">Note: Before uploading, make sure your data is formatted correctly.</em>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="addExcel"><i class="far fa-check-square"></i>
                            Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade " id="enquiryModal" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="enquiryform" class=".enquiryform" method="POST" action="{{ route('newenquiry') }}">@csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Enquiry</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="title">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name ">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="mobile">Mobile Number</label>
                                    <input type="number" class="form-control" name="mobile"
                                        placeholder="Enter Mobile Number ">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="title">Email Address</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter email ">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="interested">Interested</label>
                                    @php
                                        $getInterestType = array_keys(\Common::immigration());
                                    @endphp
                                    <select name="interested" id="interested" onchange="getImmigrationLists(this)"
                                        class="form-control">
                                        <option value="">Select Option</option>
                                        @foreach ($getInterestType as $item)
                                            <option value="{{ strtoupper($item) }}">{{ strtoupper($item) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-4 mb-3">
                                <div class="form-group" id="interestType">

                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="date">Sources</label>
                                    <select name="source" id="" class="form-control">
                                        <option value="Google">Google</option>
                                        <option value="Facebook">Facebook</option>
                                        <option value="Instagram">Instagram</option>
                                        <option value="Justdial">Justdial</option>
                                        <option value="Offline">Offline</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary"><i class="far fa-check-square"></i>
                            Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- edit enquiry model -->
    <div class="modal fade " id="editenquiry" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="editenquiryform" class=".enquiryform" method="POST" action="{{ route('editenquiry') }}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Enquiry</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="id" hidden>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="title">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name ">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="mobile">Mobile Number</label>
                                    <input type="number" class="form-control" name="mobile"
                                        placeholder="Enter Mobile Number ">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="title">Email Address</label>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Enter email ">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="editinterested">Interested</label>
                                    @php $getInterestType = array_keys(\Common::immigration());@endphp
                                    <select name="interested" data-type="" id="editinterested" onchange="geteditImmigrationLists(this)" class="form-control">
                                        <option value="">Select Option</option>
                                        @foreach ($getInterestType as $item)
                                            <option value="{{strtoupper($item)}}">{{strtoupper($item)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-4 mb-3">
                                <div class="form-group" id="editinterestType">

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="date">Sources</label>
                                    <select name="source" id="" class="form-control">
                                        <option value="Google">Google</option>
                                        <option value="Facebook">Facebook</option>
                                        <option value="Instagram">Instagram</option>
                                        <option value="Justdial">Justdial</option>
                                        <option value="Offline">Offline</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="far fa-check-square"></i>
                            Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--**********************************
                        Content body end
        ***********************************-->
@endsection
@push('scripts')
    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $("form").each(function() {
            $($(this)).validate({
                rules: {
                    name: {
                        required: true
                    },
                    mobile: {
                        required: true,
                        number: true,
                        maxlength: 10,
                        minlength: 10
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    interested: {
                        required: true
                    },
                    type_of_visa: {
                        required: true,
                    },
                    source: {
                        required: true
                    },
                },
                messages: {
                    name: "Please enter your name.",
                    mobile: {
                        required: "Please enter your mobile number.",
                        number: "Please enter a valid mobile number.",
                        minlength: "Mobile number must be at least 10 digits.",
                        maxlength: "Mobile number can be max of 10 digits."
                    },
                    email: {
                        required: "Please enter your email address.",
                        email: "Please enter a valid email address."
                    },
                    interested: "Please specify your interest.",
                    type_of_visa: "Please select the type of visa.",
                    source: "Please specify your source."
                },
            });
        })
    </script>


    <script>
        function getImmigrationLists(selectElement) {
            var immigration_type = selectElement.value;
            $.ajax({
                url: "{{ route('loadimmigrationtype') }}",
                type: "POST",
                data: {
                    list_type: immigration_type,
                    choice: false,
                    _token: "{{ csrf_token() }}",
                },
                datatype: JSON,
                success: function(response) {
                    console.log(response);
                    let html = `<label class="form-label" for="">Type of Immigration</label>
                    <select id="type_of_immigration" name="type_of_immigration" class="form-control" required>
                        <option value="">Select</option>`;
                    response.forEach(function(ele) {
                        html += `<option value="${ele.toUpperCase()}">${ele.toUpperCase()}</option>`;
                    });
                    html += `</select>`
                    console.log(html);
                    $('#interestType').html(html);
                }
            });
        }

        function geteditImmigrationLists(selectElement) {
            var immigration_type = selectElement.value;
            var type = document.getElementById("editinterested").getAttribute('data-type');
            $.ajax({
                url: "{{ route('loadimmigrationtype') }}",
                type: "POST",
                data: {
                    list_type: immigration_type,
                    _token: "{{ csrf_token() }}",
                },
                datatype: JSON,
                success: function(response) {
                    console.log(immigration_type);
                    let html = `<label class="form-label" for="">Type of Immigration</label>
                    <select id="type_of_immigration" name="type_of_immigration" class="form-control" required>
                        <option value="">Select</option>`;
                    response.forEach(function(ele) {
                        html += `<option value="${ele.toUpperCase()}" ${type == ele.toUpperCase() ? 'selected' : ''}>${ele.toUpperCase()}</option>`;
                    });
                    html += `</select>`
                    console.log(html);
                    $('#editinterestType').html(html);
                }
            });
        }        
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit-enquiry', function() {
                var name = $(this).data('name');
                var mobile = $(this).data('mobile');
                var email = $(this).data('email');
                var interest = $(this).data('select');
                var source = $(this).data('source');
                var immigration = $(this).data('immigration');
                var enquiryid = $(this).data('id');
                $('#editenquiryform input[name="name"]').val(name);
                $('#editenquiryform input[name="mobile"]').val(mobile);
                $('#editenquiryform input[name="email"]').val(email);
                $('#editenquiryform input[name="id"]').val(enquiryid);
                $('#editenquiryform select[name="interested"]').val(interest);
                $('#editenquiryform select[name="source"]').val(source);
                $('#editinterested').attr('data-type',immigration);
                $('#editinterested').trigger('change');
            });
        });
    </script>

    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                pageLength: 10,
                language: {
                    paginate: {
                        previous: '<i class="fas fa-angle-double-left"></i>',
                        next: '<i class="fas fa-angle-double-right"></i>'
                    }
                },
                ajax: "{{ route('enquiry') }}",
                deferRender: true,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'interested',
                        name: 'interested'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'type_of_immigration',
                        name: 'type_of_immigration'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true
                    },
                ],
                // "pagingType": "full_numbers",
            });
        });
    </script>

    <script>
        $('#uploadExcel').validate({
            rules: {
                excel_file: {
                    required: true,
                },
            },
            errorElement: 'div',
            highlight: function(element, errorClass) {
                $(element).css({
                    border: '1px solid #f00'
                });
            },
            unhighlight: function(element, errorClass) {
                $(element).css({
                    border: '1px solid #c1c1c1'
                });
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                $("#addExcel").attr('disabled', 'disabled').text('Processing...');
                document.getElementById("uploadExcel").submit();
            }
        });
    </script>
@endpush
