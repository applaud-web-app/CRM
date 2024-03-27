@extends("master")
@section('main-content')
<section class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class=" d-flex flex-wrap align-items-center text-head">
            <a class="backbtn mb-3 mx-2" href="{{url()->previous()}}"><i class="fa fa-arrow-left"></i></a>
            <h2 class="mb-3 me-auto">Add Applicants</h2>
        </div>
        <form class="row" method="POST" action="{{route('postaddapplicant')}}" enctype="multipart/form-data">@csrf
            <div class="col-lg-12">
                <div class="card h-auto">
                    <div class="card-header">
                        <h4 class="card-title">Applicant Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12 mb-3">
                                <label class="" for="Applicants_image">Applicant Image<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="form-file">
                                        <input type="file" name="profile_img" id="Applicants_image"
                                            accept="image/*" class="form-file-input form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="Applicantname">Applicant Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Enter Applicant name">
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="phonenumber">Applicant Age<span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="age"
                                        placeholder="Enter mobile number">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="Leadvalue">Value(₹)</label>
                                    <input type="number" class="form-control" name="price" placeholder="Enter Value">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="lastname">Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Enter email address">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="phonenumber">Mobile Number<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="mobile" placeholder="Enter mobile number">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="dob">Date of Birth<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="dob" placeholder="Enter Date of Birth">
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="marital">Martial Status</label>
                                    <select name="marital_status" class="form-control">
                                        <option value="" selected>--Choose Option--</option>
                                        <option value="Married">Married</option>
                                        <option value="Unmarried">Unmarried</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12 mb-3">
                                <div class="form-group">
                                    <label for="address">Description</label>
                                    <textarea name="description" class="form-control" id="" placeholder="Enter Drescription" style="height:100px;"></textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="card h-auto">
                    <div class="card-header">
                        <h4 class="card-title">Address Information</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="address">Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address"
                                        placeholder="Enter Address">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="country">Country<span class="text-danger">*</span></label>
                                    <select name="country" onchange="getstates(this)" class="form-control">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="state">State<span class="text-danger">*</span></label>
                                    <select name="state" onchange="getcities(this)" id="states"
                                        class="form-control">
                                        <option value="" selected>--Choose Option--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">City</label>
                                    <select name="city" id="cities" class="form-control">
                                        <option value="" selected>--Choose Option--</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="zip">Zip Code</label>
                                    <input type="text" class="form-control" name="zipcode" placeholder="Enter Zip">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card h-auto">
                    <div class="card-header">
                        <h4 class="card-title">Source Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="type">Type <span class="text-danger">*</span></label>
                                    <select name="lead_type" class="form-control" required>
                                        <option value="Hot leads">Hot leads</option>
                                        <option value="Cold leads">Cold leads</option>
                                        <option value="Warm leads">Warm leads</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="source">Sources <span class="text-danger">*</span></label>
                                    <select name="source" class="form-control">
                                        <option value="Google">Google</option>
                                        <option value="Facebook">Facebook</option>
                                        <option value="Instagram">Instagram</option>
                                        <option value="Landing Page">Landing Page</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card h-auto">
                    <div class="card-header">
                        <h4 class="card-title">Interested</h4>
                    </div>
                    <div class="card-body" >
                        <div class="row" >
                            <div class="col-lg-4 col-md-4 col-sm-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="interested">Interested<span class="text-danger">*</span></label>
                                    @php
                                        $getInterestType = array_keys(\Common::immigration());
                                    @endphp
                                    <select name="interested" id="interested" onchange="getImmigrationLists(this)" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($getInterestType as $item)
                                            <option value="{{strtoupper($item)}}">{{strtoupper($item)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 mb-3" >
                                <div class="form-group" id="interestType">
                                    
                                </div>
                            </div>

                            <div class="row" id="fields"></div>
                            {{-- <div class="row" id="defaultfields"></div> --}}
                        </div>
                    </div>
                </div>

                {{-- VISA --}}
                <div class="card h-auto" id="VISA" style="display: none">
                    <div class="card-header">
                        <h4 class="card-title">VISA</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="contacted_date">Adhaar Card</label>
                                    <input type="input" class="form-control" name="Adhaar Card"
                                        placeholder="Enter date">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-3">
                                <label class="" for="Applicants_image">Pan Card</label>
                                <div class="input-group">
                                    <div class="form-group">
                                        <input type="file" name="pancard" id="Applicants_image"
                                            accept="image/*" class="form-file-input form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="contacted_date">Application Number</label>
                                    <input type="text" class="form-control" name="contacted_date"
                                        placeholder="Enter date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                {{-- IELTS --}}
                <div class="card h-auto" id="IELTS" style="display: none">
                    <div class="card-header">
                        <h4 class="card-title">IELTS</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="contacted_date">Graduation Degree</label>
                                    <input type="input" class="form-control" name="Adhaar Card"
                                        placeholder="Enter date">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-3">
                                <label class="" for="Applicants_image">Pan Card</label>
                                <div class="input-group">
                                    <div class="form-group">
                                        <input type="file" name="pancard" id="Applicants_image"
                                            accept="image/*" class="form-file-input form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="contacted_date">Marksheet</label>
                                    <input type="text" class="form-control" name="contacted_date"
                                        placeholder="Enter date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                {{-- PTE --}}
                <div class="card h-auto" id="PTE" style="display: none">
                    <div class="card-header">
                        <h4 class="card-title">PTE</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="contacted_date">Adhaar Card</label>
                                    <input type="input" class="form-control" name="Adhaar Card"
                                        placeholder="Enter date">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-3">
                                <label class="" for="Applicants_image">Pan Card</label>
                                <div class="input-group">
                                    <div class="form-group">
                                        <input type="file" name="pancard" id="Applicants_image"
                                            accept="image/*" class="form-file-input form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="contacted_date">Application Number</label>
                                    <input type="text" class="form-control" name="contacted_date"
                                        placeholder="Enter date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-12 ">
                <button type="submit" class="btn btn-primary  mb-2"><i
                        class="far fa-check-square pe-2"></i>Submit</button>
                <button type="button" class="btn btn-dark  mb-2"><i class="far fa-window-close pe-2"></i>Cancel
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
@push('scripts')
<script>
    function getstates(selectElement) {
        var countryId = selectElement.value;
        $.ajax({
            url: "{{ route('loadstates') }}",
            type: "POST",
            data: {
                id: countryId,
                _token: "{{ csrf_token() }}",
            },
            datatype: JSON,
            success: function(response) {
                var statesSelect = document.getElementById('states');
                statesSelect.innerHTML = '';
                response.forEach(state => {
                    var option = document.createElement('option');
                    option.value = state.id;
                    option.textContent = state.name;
                    statesSelect.appendChild(option);
                });
            }
        });
    }

    function getcities(selectElement) {
        var stateid = selectElement.value;
        $.ajax({
            url: "{{ route('loadcities') }}",
            type: "POST",
            data: {
                id: stateid,
                _token: "{{ csrf_token() }}",
            },
            datatype: JSON,
            success: function(response) {
                var citySelect = document.getElementById('cities');
                citySelect.innerHTML = '';
                response.forEach(city => {
                    var option = document.createElement('option');
                    option.value = city.id;
                    option.textContent = city.name;
                    citySelect.appendChild(option);
                });
            }
        });
    }

    let previousCardId = '';
    //get immigration lists
    function getImmigrationLists(selectElement)
    {
        // createfield();
        var immigration_type=selectElement.value;
        if (previousCardId) {
                document.getElementById(previousCardId).style.display = 'none';
            }
            if (immigration_type) {
                document.getElementById(immigration_type).style.display = 'block';
                previousCardId = immigration_type;
            }
        $.ajax({
            url: "{{ route('loadimmigrationtype') }}",
            type: "POST",
            data: {
                list_type: immigration_type,
                _token: "{{ csrf_token() }}",
            },
            datatype: JSON,
            success: function(response) {
                let label = "";
                    if (immigration_type === "IELTS") {
                        label = "Type of IELTS";
                    } else if (immigration_type === "PTE") {
                        label = "Type of PTE";
                    } else {
                        label = "Type of immigration";
                    }
                    let html = `<label class="form-label" for="">${label}<span class="text-danger">*</span></label>
                <select id="type_of_immigration" onchange="getfieldcount(this,'${immigration_type}')" name="type_of_immigration" class="form-control">
                    <option value="">Select</option>`;
                response.forEach(function(ele) {
                    html += `<option value="${ele.toUpperCase()}">${ele.toUpperCase()}</option>`;
                });
                html += `</select>`
                $('#interestType').html(html);
            }
        });
    }

    //get immigration->list->fields
    function getfieldcount(selectElement,immigrationType){
        var fieldlist=selectElement.value;
        $.ajax({
            url: "{{ route('documentnames') }}",
            type: "POST",
            data: {
                field_type:fieldlist,
                type_immigrant:immigrationType,
                _token: "{{ csrf_token() }}",
            },
            datatype: JSON,
            success: function(response) {
                let html=``;
                console.log(response);
                // response.forEach(function(ele) {
                //     html += `<div class="col-lg-6 col-md-6 col-12 mb-3">
                //                 <label class="" for="${ele}">${ele}</label>
                //                 <div class="input-group">
                //                     <div class="form-file">
                //                         <input type="file" name="document[${ele}]" class="form-file-input form-control">
                //                     </div>
                //                 </div>
                //             </div>`;
                // });

                $.each(response, function(key, value) {
                    console.log("Key: " + key + ", Value: " + value);
                    html += `<div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label class="" for="${value}">${value}</label>
                        <div class="input-group">
                            <div class="form-file">
                                <input type="file" name="document[${key}]" class="form-file-input form-control" required>
                            </div>
                        </div>
                    </div>`;
                });
                
                $.each(function(ele) {
                $("form").validate().settings.rules[ele] = {
                    required: true
                };
                $("form").validate().settings.messages[ele] = {
                    required: "Please upload the document for " + ele + "."
                };
            });
            $('#fields').html(html);
            $("form").valid();
            }
        });
    }

    // function createfield()
    // {
    //     let html=``;
    //     for(i=0;i<2;i++){
    //                     html += `<div class="col-lg-6 col-md-6 col-6 mb-3">
    //                                 <label class="" for="dasds">Fields</label>
    //                                 <div class="input-group">
    //                                     <div class="form-file">
    //                                         <input type="file" name="visa" id="passport" class="form-file-input form-control">
    //                                     </div>
    //                                 </div>
    //                             </div>`;
    //                         }
    //                 $('#defaultfields').html(html);
                    
    // }
</script>
<script>
    $("form").each(function() {
        $($(this)).validate({
            rules: {
                name: {
                    required: true
                },
                age:{
                    required:true
                },
                dob: {
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
                country: {
                    required: true
                },
                state: {
                    required: true
                },
                assigned_to: {
                    required: true
                },
                profile_img: {
                    required: true
                },
                address: {
                    required: true
                },
                interested:{
                    required:true
                },
                type_of_immigration:{
                    required:true
                },
                document:{
                    required:true
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
    });

    
</script>
@endpush