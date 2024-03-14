@extends("master")
@section('main-content')
<section class="content-body">
    <!-- row -->
    <div class="container-fluid">
       <div class="d-flex flex-wrap align-items-center text-head">
          <h2 class="mb-3 me-auto">Lead Applicants Name</h2>
 
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
                                        <li><label class="custom-label w-50 mb-0">Source :</label>{{$data->source}}</li>
                                        <li><label class="custom-label w-50 mb-0">Age :</label>{{$data->age}}</li>
                                        <li><label class="custom-label w-50 mb-0">Mobile.NO</label>{{$data->mobile}}</li>
                                        
                                        <li><label class="custom-label w-50 mb-0">Country :</label>{{$data->country_name}}</li>
                                        <li><label class="custom-label w-50 mb-0">State :</label>{{$data->state_name}}</li>
                                        <li><label class="custom-label w-50 mb-0">City :</label>{{$data->city_name}}</li>
                                        <li><label class="custom-label w-50 mb-0">Address :</label>{{$data->address}}</li>
                                     </ul>
                                  </div>
                                  <div class="col-xl-6 col-md-6">
                                     <ul class="list-style-1">
                                        <li><label class="custom-label w-50 mb-0">Email :</label>{{$data->email}}</li>
                                        <li><label class="custom-label w-50 mb-0">Date Of Birth :</label>{{date('Y-m-d', strtotime($data->dob))}}
                                        </li>
                                        <li><label class="custom-label w-50 mb-0">Marital Status :</label>{{$data->marital_status}}</li>
                                        <li><label class="custom-label w-50 mb-0">Zip code :</label>{{$data->zipcode}}</li>
                                     </ul>
                                  </div>
                               </div>
                            </div>
                         </div>
                         <div class="tab-pane fade" id="documents">
                            <div class="pt-4">
                               <div id="lightboxgallery" class="d-flex flex-wrap text-center">
                                 @foreach ($documents as $document)
                                 <a target="_blank" href="{{asset('uploads/docs/'.$document->document)}}" data-src="images/product.jpg" class="border border-light p-2 m-1">
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
                                     <td>{{$followup['serial_id']}}</td>
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
                         
                                 <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#requestModal" class="btn btn-secondary me-2 mb-1"><i class="far fa-edit me-1"></i>Request</a>
                                 <a href="{{route('approved',$data->id)}}" class="btn btn-primary me-2 mb-1"><i class="far fa-check-circle me-1"></i>Accept</a>
                                 <a href="{{route('rejectapproval',$data->id)}}" class="btn btn-danger me-2 mb-1"><i class="far fa-times-circle me-1"></i>Reject</a>
                             
                     </div>
             </div>
        
          </div>
       </div>
 </section>
     
@endsection