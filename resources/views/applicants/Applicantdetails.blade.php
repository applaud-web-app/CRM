@extends("master")
@section('main-content')
<section class="content-body">
    <!-- row -->
    <div class="container-fluid">
       <div class="d-flex flex-wrap align-items-center text-head">
         <a class="backbtn mb-3 mx-2" href="{{url()->previous()}}"><i class="fa fa-arrow-left"></i></a>
          <h2 class="mb-3 me-auto">Applicants Name</h2>
 
       </div>
 
       <div class="row">
          <div class="col-xl-12">
             
             <div class="card">
                <div class="card-body">
                   <!-- Nav tabs -->
                   <div class="custom-tab-1">
                      <ul class="nav nav-tabs">
                         <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#profile"><i
                                  class="la la-home me-2"></i> Profile</a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#documents"><i class="la la-user me-2"></i>
                               Documents</a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link " data-bs-toggle="tab" href="#followup"><i class="la la-phone me-2"></i>
                               Follow Up</a>
                         </li>
                         
 
                      </ul>
                      <div class="tab-content">
                         <div class="tab-pane fade active show" id="profile" role="tabpanel">
                            <div class="pt-4">
 
                               <div class="row">
                                  <div class="col-xl-6 col-md-6">
                                     <ul class="list-style-1">
                                        <li><label class="custom-label w-50 mb-0">Full Name :</label>{{$data->name}}</li>
                                        <li><label class="custom-label w-50 mb-0">Code :</label>{{$data->code}}</li>
                                        <li><label class="custom-label w-50 mb-0">Age :</label>{{$data->age}} Yrs</li>
                                        <li><label class="custom-label w-50 mb-0">Address :</label>{{$data->address}}</li>
                                        <li><label class="custom-label w-50 mb-0">Country :</label>{{$data->country_name}}</li>
                                        <li><label class="custom-label w-50 mb-0">State :</label>{{$data->state_name}}</li>
                                        <li><label class="custom-label w-50 mb-0">City :</label>{{$data->city_name}}</li>
                                     </ul>
                                  </div>
                                  <div class="col-xl-6 col-md-6">
                                     <ul class="list-style-1">
                                        
                                        <li><label class="custom-label w-50 mb-0">Email :</label>{{$data->email}}</li>
                                        <li><label class="custom-label w-50 mb-0">Phone :</label>{{$data->mobile}}</li>
                                        
                                        <li><label class="custom-label w-50 mb-0">Date Of Birth :</label>{{$data->dob}}</li>
                                        <li><label class="custom-label w-50 mb-0">Marital Status :</label>{{$data->marital_status}}</li>
                                        <li><label class="custom-label w-50 mb-0">Permanent Address :</label>{{$data->country_name}}</li>
                                        <li><label class="custom-label w-50 mb-0">Zip code :</label>{{$data->zipcode}}</li>
                                        <li><label class="custom-label w-50 mb-0">Applied Method :</label>{{$data->interested}}</li>
                                     </ul>
                                  </div>
                               </div>
                            </div>
                         </div>
                         <div class="tab-pane fade" id="documents">
                            <div class="pt-4">
                                    <div id="lightboxgallery" class="d-flex flex-wrap text-center">
                                     @foreach ($documents as $document)
                                        <a href="{{asset('uploads/docs/'.$document->document)}}" target="_blank" class="border border-light p-2 m-1">
                                            <span class="d-block border-bottom text-black">{{$document->document_name}}</span>
                                            <img src="{{asset('uploads/docs/'.$document->document)}}" alt="" style="width:150px;height:150px;object-fit:contain"/>
                                     </a>
                                     @endforeach
                                 </div>
                             
                            </div>
                         </div>
                         <div class="tab-pane fade" id="followup">
                            <div class="pt-4">
                            <div class="table-responsive ">
                         <table class="table display table-striped table-bordered">
                                 <thead>
                                     <tr>
                                         <th>
                                            Serial No.
                                         </th>
                                         <th>Notes</th>
                                         <th>Next Follow Up</th>
                                         <th>Added By</th>
                                     
                                     
                                     </tr>
                                 </thead>
                                 <tbody>
                                   @foreach ($followupdata as $followup)
                                     <tr>
                                        <td>{{$followup->serial_id}}</td>
                                         <td class="wspace-no">
                                         <span >{{$followup->notes}}</span>
                                         </td>
                                         <td class="wspace-no"><span>{{$followup->next_followup}}</span></td>
                                         <td class="wspace-no">{{$followup->added_by}}</td>
                                     </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                            </div>
                            </div>
                         </div>
 
                      </div>
                   </div>
                </div>
                <div class="card-footer text-end">
                         <a href="javascript:void(0);"  class="btn btn-primary btn-rounded"><i class="fas fa-check pe-2"></i>Mark as Complete</a>
                 </div>
             </div>
        
          </div>
       </div>
 </section>    
@endsection