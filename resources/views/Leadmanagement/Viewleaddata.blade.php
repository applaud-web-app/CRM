@extends('master')
@section('main-content')
    <section class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row ">

                <div class="col-lg-12 col-md-12 col-12">


                    <div class="custom-tab-1 bg-white mb-2 pt-1">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#" class="nav-link active"><i class="la la-home me-2"></i> Profile
                                    Details</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('addleaddocument', $data->id) }}" class="nav-link "><i
                                        class="la la-user me-2"></i> Documents</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('followup', $data->id) }}" class="nav-link"><i
                                        class="la la-phone me-2"></i> Follow Up</a>
                            </li>

                        </ul>



                    </div>
                    <div class="card h-auto">
                        <div class="card-header d-block">
                            <h4 class="card-title mb-2"></h4>

                        </div>
                        <div class="card-body">
                            @isset($data->notes)
                            @if ($data->notes != "" && $data->notes != NULL)
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                    </button>
                                    <div class="media">
                                        <div class="media-body">
                                            
                                            <h5 class="mt-1 mb-1 text-danger fw-normal">Request</h5>
                                            <hr>
                                            <p class="mb-0">{{$data->notes}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @endisset
                            <h4 class="card-title mb-3">Personal Information</h4>


                            <div class="row mb-3">
                                <div class="col-xl-6">
                                    <ul class="list-style-1">
                                        <li><label class="form-label mb-0 custom-label">Name :</label>
                                            <p class="mb-0"> {{ $data->name }}</p>
                                        </li>
                                        <li><label class="form-label mb-0 custom-label">Mobile:</label>
                                            <p class="mb-0"> {{ $data->mobile }}</p>
                                        </li>
                                        <li><label class="form-label mb-0 custom-label">Email:</label>
                                            <p class="mb-0"> {{ $data->email }}</p>
                                        </li>
                                        <li><label class="form-label mb-0 custom-label">Age:</label>
                                            <p class="mb-0"> {{ $data->age }}</p>
                                        </li>
                                        <li><label class="form-label mb-0 custom-label">Price:</label>
                                            <p class="mb-0"> {{ $data->price }}</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xl-6">
                                    <ul class="list-style-1">
                                        <li><label class="form-label mb-0 custom-label">D.O.B:</label>
                                            <p class="mb-0"> {{ date('Y-M-d', strtotime($data->dob)) }}</p>
                                        </li>
                                        <li><label class="form-label mb-0 custom-label">Marital_status:</label>
                                            <p class="mb-0"> {{ $data->marital_status }}</p>
                                        </li>
                                        <li><label class="form-label mb-0 custom-label">Source:</label>
                                            <p class="mb-0"> {{ $data->source }}</p>
                                        </li>
                                        <li><label class="form-label mb-0 custom-label">Address:</label>
                                            <p class="mb-0"> {{ $data->address }}</p>
                                        </li>
                                        <li><label class="form-label mb-0 custom-label">Country :</label>
                                            <p class="mb-0"> {{ $data->country_name }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                              <div>
                                 <a href="{{route('applyapproval',$data->id)}}" class="btn btn-secondary  "><i class="far fa-check-circle me-2"></i>Send For Approval</a>
                              </div>
                           </div>
                            
                        </div>
                     </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
