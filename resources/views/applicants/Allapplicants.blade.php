@extends("master")
@section('main-content')
@push('style')
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}">
@endpush
<section class="content-body">
    <!-- row -->
    <div class="container-fluid">
    <div class="d-flex flex-wrap align-items-center text-head">
       <h2 class="mb-3 me-auto">Pending Applicants</h2>
       <div>
          <ol class="breadcrumb">
             <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
             </li>
             <li class="breadcrumb-item">
                <a href="javascript:void(0)">Pending Applicants</a>
             </li>
          </ol>
       </div>
    </div>
 
    <div class="row">
       <div class="col-xl-12">
          <div class="card">
             <div class="card-body p-3">
                <div class="table-responsive">
                   <table class="table display data-table" >
                      <thead>
                         <tr>
                            <th>
                             #
                            </th>
                            <th >Name</th>
                          
                            <th >Email </th>
                            <th >Phone </th>
                            <th>Value</th>
                            <th>Source</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Action</th>
                         </tr>
                      </thead>
                      <tbody>
                      
                         <tr>
                            <td >
                            </td>
                          
                            <td></td>
                            <td></td>
                        
                            <td>Google</td>
                          
                            <td>12-105-2024</td>
                                     
                            <td>
                               <span class="badge badge-warning light">Pending</span>
                            </td>
                            <td>
                               
                            </td>
                         </tr>

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
                    data: 'mobile',
                    name: 'mobile'
                },
                {
                    data: 'price',
                    name: 'price'
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
                    data: 'status',
                    name: 'status'
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