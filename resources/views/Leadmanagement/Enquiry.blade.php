@extends('master')
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
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Enquiries</a></li>
                </ol>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="custom-search mb-3">
                <input type="text" class="form-control" id="search" placeholder="Search......">
                <button class="btn text-primary " type="button"><i class="far fa-search"></i>
                </button>
            </div>
            <div class="">
            <a  href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#bulkUploadModal" class="btn btn-secondary mb-3"><i class="fas fa-upload pe-2"></i>Bulk Upload</a>
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal"
                    class="btn btn-primary   mb-3"><i class="fas fa-plus pe-2"></i>Add New</a>

            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="table-responsive ">
                            <table class="table display data-table" id="example5">
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
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">Bulk Upload</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">

                    <p class="mb-3 text-dark">To download a demo Excel file, just click the link below and download the
                        provided Excel file. Review any accompanying instructions to ensure proper formatting. Prepare
                        your data accordingly, then follow the platform's upload process, verifying success afterward.
                        <a href="images/Enquiry-Demo-File.xlsx" class="text-primary text-decoration-underline"
                            download><i class="fas fa-download"></i> Download Demo File(Excel)</a>
                    </p>

                    <div class="form-group mb-2">
                        <label class="form-label" for="title">Upload File (.xlsx)</label>
                        <input type="file" class="form-control form-file" name="title" placeholder="Enter email ">
                    </div>

                    <em class="text-dark">Note: Before uploading, make sure your data is formatted correctly.</em>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="far fa-check-square"></i>
                        Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade " id="enquiryModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="enquiryform" method="POST" action="{{ route('newenquiry') }}">@csrf
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
                                <input type="tel" class="form-control" name="mobile"
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

                        <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="interested">Interested</label>
                                <select name="interested" id="interested" class="form-control">
                                    <option value="">Select</option>
                                    <option value="VISA">VISA</option>
                                    <option value="IETS">IETS</option>
                                    <option value="PTE">PTE</option>
                                </select>
                            </div>
                        </div>

                        <!-- if Visa then show -->
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-3" id="visa-options" style="display: none;">
                            <div class="form-group">
                                <label class="form-label" for="type_of_visa">Type of Visa</label>
                                <select name="type_of_visa" id="type_of_visa" class="form-control">
                                    <option value="">Select Type of Visa</option>
                                    <option value="Transit Visa">Transit Visa</option>
                                    <option value="Tourist Visa">Tourist Visa</option>
                                    <option value="X Visa">X Visa</option>
                                    <option value="Business Visa">Business Visa</option>
                                    <option value="Employment Visa">Employment Visa</option>
                                    <option value="Student Visa">Student Visa</option>
                                </select>
                            </div>
                        </div>

                        <!-- if IETS then show -->
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-3" id="iets-options" style="display: none;">
                            <div class="form-group">
                                <label class="form-label" for="type_of_iets">Type of IETS</label>
                                <select name="type_of_iets" id="type_of_iets" class="form-control">
                                    <option value="">Select Type of IETS</option>
                                    <option value="Option 1">Option 1</option>
                                    <option value="Option 2">Option 2</option>
                                    <option value="Option 3">Option 3</option>
                                </select>
                            </div>
                        </div>

                        <!-- if PTE then show -->
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-3" id="pte-options" style="display: none;">
                            <div class="form-group">
                                <label class="form-label" for="type_of_pte">Type of PTE</label>
                                <select name="type_of_pte" id="type_of_pte" class="form-control">
                                    <option value="">Select Type of PTE</option>
                                    <option value="Option 1">Option 1</option>
                                    <option value="Option 2">Option 2</option>
                                    <option value="Option 3">Option 3</option>
                                </select>
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
@push('scripts')
    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $("#enquiryform").validate({
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
    </script>

    <script>
        $(document).ready(function() {
            $('#interested').change(function() {
                var selectedOption = $(this).val();
                $('#visa-options, #iets-options', '#type_of_pte').hide();
                if (selectedOption === 'VISA') {
                    $('#visa-options').show();
                    $('#iets-options').hide();
                    $('#pte-options').hide();
                } else if (selectedOption === 'IETS') {
                    $('#iets-options').show();
                    $('#visa-options').hide();
                    $('#pte-options').hide();
                } else if (selectedOption === 'PTE') {
                    $('#pte-options').show();
                    $('#iets-options').hide();
                    $('#visa-options').hide();
                }
            });
        });
    </script>


<script type="text/javascript">
    $(function () {
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          searching: false, 
          ajax: "{{ route('enquiry') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'mobile', name: 'mobile'},
              {data: 'email', name: 'email'},
              {data: 'interested', name: 'interested'},
              {data: 'created_at', name: 'created_at'},
              {data: 'type_of_immigration', name: 'type_of_immigration'},
              {data: 'action', name: 'action',orderable:true},
          ]
      });
      $('#search').on('keyup', function() {
        table.search(this.value).draw();
    });
    });
  </script>
@endpush