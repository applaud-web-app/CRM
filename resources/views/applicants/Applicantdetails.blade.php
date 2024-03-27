@extends('master')
@section('main-content')
    <section class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center text-head">
                <a class="backbtn mb-3 mx-2" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i></a>
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
                                        <a class="nav-link" data-bs-toggle="tab" href="#documents"><i
                                                class="la la-user me-2"></i>
                                            Documents</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " data-bs-toggle="tab" href="#followup"><i
                                                class="la la-phone me-2"></i>
                                            Follow Up</a>
                                    </li>


                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="profile" role="tabpanel">
                                        <div class="pt-4">

                                            <div class="row">
                                                <div class="col-xl-6 col-md-6">
                                                    <ul class="list-style-1">
                                                        <li><label class="form-label mb-0 custom-label">Name :</label><p class="mb-0"> {{ $data->name }}</p></li>
                                                        <li><label class="form-label mb-0 custom-label">Mobile:</label>
                                                            <p class="mb-0"> {{ $data->mobile }}</p>
                                                        </li>
                                                        <li><label class="form-label mb-0 custom-label">Email:</label>
                                                            <p class="mb-0"> {{ $data->email }}</p>
                                                        </li>
                                                        <li><label class="form-label mb-0 custom-label">Age:</label>
                                                            <p class="mb-0"> {{ $data->age }} years</p>
                                                        </li>
                                                        <li><label class="form-label mb-0 custom-label">Price:</label>
                                                            <p class="mb-0">₹{{ $data->price }}</p>
                                                        </li>
                                                        <li><label class="form-label mb-0 custom-label">Type:</label>
                                                            <p class="mb-0"> {{ $data->lead_type }}</p>
                                                        </li>
                                                        <li><label class="form-label mb-0 custom-label">Source:</label>
                                                            <p class="mb-0">{{ $data->source }}</p>
                                                        </li>
                                                        <li><label class="form-label mb-0 custom-label">Contacted Date:</label>
                                                            <p class="mb-0"> {{ isset($data->contacted_date) ? $data->contacted_date : '--' }}</p>
                                                        </li>

                                                        <li><label class="form-label mb-0 custom-label">Close Date:</label>
                                                            <p class="mb-0">{{ isset($data->close_date) ? $data->close_date : '--' }}</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <ul class="list-style-1">
                                                        <li><label class="form-label mb-0 custom-label">D.O.B:</label>
                                                            <p class="mb-0"> {{ $data->dob }}</p>
                                                        </li>
                                                        <li><label
                                                                class="form-label mb-0 custom-label">Marital_status:</label>
                                                            <p class="mb-0"> {{ $data->marital_status }}</p>
                                                        </li>
                                                        <li><label class="form-label mb-0 custom-label">Source:</label>
                                                            <p class="mb-0"> {{ $data->source }}</p>
                                                        </li>
                                                        <li><label class="form-label mb-0 custom-label">Address:</label>
                                                            <p class="mb-0"> {{ $data->address }}</p>
                                                        </li>
                                                        <li><label class="form-label mb-0 custom-label">Country :</label>
                                                            <p class="mb-0"> {{ isset($data->country_name) ? $data->country_name : '--' }}</p>
                                                        </li>
                                                        <li><label class="form-label mb-0 custom-label">State:</label>
                                                            <p class="mb-0"> {{ isset($data->state_name) ? $data->state_name : '--' }}</p>
                                                        </li>
                                                        <li><label class="form-label mb-0 custom-label">City:</label>
                                                            <p class="mb-0">{{ isset($data->city_name) ? $data->city_name : '--' }}</p>
                                                        </li>
                                                        <li><label class="form-label mb-0 custom-label">Interested:</label>
                                                            <p class="mb-0">{{ $data->interested }}</p>
                                                        </li>
                                                        <li>
                                                            <label class="form-label mb-0 custom-label">Type
                                                                @if ($data->interested == 'IELTS')
                                                                    Of IELTS
                                                                @elseif ($data->interested == 'VISA')
                                                                    Of Immigration
                                                                @elseif($data->interested == 'PTE')
                                                                    Of PTE
                                                                @endif
                                                            </label>
                                                            <p class="mb-0">{{ $data->type_of_immigration }}</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="documents">
                                        <div class="pt-4">
                                            <div id="lightboxgallery" class="d-flex flex-wrap text-center">
                                                @foreach ($documents as $document)
                                                    <a href="{{ asset('uploads/docs/' . $document->document) }}"
                                                        target="_blank" class="border border-light p-2 m-1">
                                                        <span
                                                            class="d-block border-bottom text-black">{{ $document->document_name }}</span>
                                                        <img src="{{ asset('uploads/docs/' . $document->document) }}"
                                                            alt=""
                                                            style="width:150px;height:150px;object-fit:contain" />
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
                                                                <td>{{ $followup->serial_id }}</td>
                                                                <td class="wspace-no">
                                                                    <span>{{ $followup->notes }}</span>
                                                                </td>
                                                                <td class="wspace-no">
                                                                    <span>{{ $followup->next_followup }}</span></td>
                                                                <td class="wspace-no">{{ $followup->added_by }}</td>
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
                            <a href="javascript:void(0);" class="btn btn-primary btn-rounded"><i
                                    class="fas fa-check pe-2"></i>Mark as Complete</a>
                        </div>
                    </div>

                </div>
            </div>
    </section>
@endsection
