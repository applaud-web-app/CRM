@extends("master")
@section('main-content')
@push('style')
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}">
@endpush
<section class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center text-head">
            <h2 class="mb-3 me-auto">Applicants</h2>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Applicants</a></li>
                </ol>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <div class="custom-search mb-2">
                                            <input type="text" class="form-control" id="input-search" placeholder="Search......">
                                            <button class="btn text-primary " type="button"><i class="far fa-search"></i>
                                            </button>
                                    </div>
            <div>
                <a href="{{route('addnewapplicant')}}" class="btn btn-primary  mb-sm-0 mb-2"><i class="fas fa-plus pe-2"></i>Add New</a>
            </div>
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
                                    
                                            {{-- <tr>
                                                <td>
												
												</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="images/user.jpg" alt="" class=" img-thumbnail rounded-circle me-1" width="50">
                                                        <a href="javascript:void(0);">
                                                            <h4 class="text-primary mb-0 ">Sunil Rawat</h4>
                                                            <span>(Applicant ID)</span>
                                                        </a>
                                                    </div>
                                                 
                                                </td>
                                                <td class="wspace-no">
                                                    <span class="d-block"><i class="fas fa-envelope pe-2"></i>KhadijahAJohnson@gmail.us</span>
                                                    <span class="d-block"><i class="fas fa-mobile pe-2"></i>440-250-8391</span>
                                                 </td>
                                                <td>
                                                    <span><i class="fas fa-calendar"></i> 12-12-2022</span>
                                                </td>
                                                <td>
                                                    <select name="" class="form-select" id="">
                                                        <option value="">New</option>
                                                        <option value="">Processing</option>
                                                        <option value="">Completed</option>
                                                       
                                                    </select>
                                                </td>
                                             
                                                <td>
                                                <div class="dropdown">
														<button type="button" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="false">
															<svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</button>
														<div class="dropdown-menu" style="margin: 0px;">
                                                            <a class="dropdown-item" href="applicants-detail.php"><i class="fas fa-eye pe-1"></i>View</a>
															<a class="dropdown-item" href="add-applicants.php"><i class="fas fa-edit pe-1"></i>Edit</a>
															<a class="dropdown-item" href="#"><i class="fas fa-trash pe-1"></i>Delete</a>
														</div>
													</div>
                                                </td>
                                               										
                                            </tr> --}}
                                        
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
                   name: 'name'
               },
               {
                   data: 'email',
                   name: 'email'
               },
               
               {
                   data: 'dob',
                   name: 'dob'
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