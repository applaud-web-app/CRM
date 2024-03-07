@extends("master")
@section('main-content')
<section class="content-body">
    <!-- row -->
    <div class="container-fluid">
    <div class="d-flex flex-wrap align-items-center text-head">
       <h2 class="mb-3 me-auto">All Leads</h2>
       <div>
          <ol class="breadcrumb">
             <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
             </li>
             <li class="breadcrumb-item">
                <a href="javascript:void(0)">Leads</a>
             </li>
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
             
                 <a href="create-lead.php" class="btn btn-primary  mb-sm-0 mb-2"><i class="fas fa-plus pe-2"></i>Add New</a>
             </div>
         </div>
    <div class="row">
       <div class="col-xl-12">
          <div class="card">
             <div class="card-body p-3">
                <div class="table-responsive">
                   <table class="table  display" id="example5">
                      <thead>
                         <tr>
                            <th >
                             #
                            </th>
                            <th>Name</th>
                            
                            <th>Contact Info</th>
                            <th>Value</th>
                            <th>Assigned</th>
                            <th>Source</th>
                           
                            <th>Created</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                         </tr>
                      </thead>
                      <tbody>
                        @php
                            $i=1;
                        @endphp
                       @foreach ($leads as $lead)
                           
                       
                         <tr>
                            <td >
                                {{$i}}
                            </td>
                            <td>
                               <!-- if requested by -->
                               
                               
                               <p class="mb-0 text-muted">{{$lead->name}}</p>
                            </td>
                         
                           
                            <td><p class="mb-0">{{$lead->email}}</p><p class="mb-0">{{$lead->mobile}}</p></td>
                          
                            <td>{{$lead->price}}</td>
                            <td>{{$lead->employee->first_name}}</td>
                            <td>Google</td>
                         
                            <td>12-105-2024</td>
                            <td>
                               <select name="" class="form-select" id="">
                                  <option value="">Hot Lead</option>
                                  <option value="">Warm Lead</option>
                                  <option value="">Cold Lead</option>
                                  
                               </select>
                            </td>
                            <td>
                               <select name="" class="form-select" id="">
                                  <option value="">Generated</option>
                                  <option value="">Qualified</option>
                                  <option value="">Initial Contact</option>
                                  <option value="">Schedule Appointemnt</option>
                                  <option value="">Proposal Sent</option>
                                  <option value="">Open</option>
                                  <option value="">Close</option>
                               </select>
                            </td>
                            <td>
                               <div class="dropdown text-sans-serif">
                                  <button class="btn btn-primary light sharp" type="button" id="order-dropdown-0" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                     <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                              <rect x="0" y="0" width="24" height="24"></rect>
                                              <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                              <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                              <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                           </g>
                                        </svg>
                                     </span>
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="order-dropdown-0">
                                     <div class="py-2">
                                        <a class="dropdown-item" href="lead-profile.php"><i class="far fa-eye"></i> View</a>  
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-edit"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="fas fa-trash-alt"></i> Delete</a>
                                     
                                     
                                        <div class="dropdown-divider"></div>
                                           <a class="dropdown-item text-success" href="javascript:void(0);"><i class="fas fa-paper-plane"></i> Send For Approval</a>
                                           <a class="dropdown-item text-warning" href="javascript:void(0);"><i class="fas fa-hourglass-start"></i> Approval Pending</a>
                                    
                                     </div>
                                  </div>
                            </td>
                         </tr>
                         @php
                             $i++;
                         @endphp
                         @endforeach
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