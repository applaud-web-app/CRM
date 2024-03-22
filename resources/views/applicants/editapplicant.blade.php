@extends("master")
@section('main-content')
<section class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class=" d-flex flex-wrap align-items-center text-head">
            <h2 class="mb-3 me-auto">Edit Applicants Details</h2>

        </div>
        <form class="row" method="POST" action="{{route('posteditapplicant',$user->id)}}" enctype="multipart/form-data">@csrf
            <div class="col-lg-12">
                <div class="card h-auto">
                    <div class="card-header">
                        <h4 class="card-title">Applicant Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12 mb-3">
                                @isset($user->profile_img)
                                    <img src="{{asset('/uploads/applicants/'.$user->profile_img.'')}}" alt="user_img" height="100px">
                                @endisset
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
                                    <input type="text" class="form-control" name="name" value="@isset($user->name){{$user->name}} @endisset"
                                        placeholder="Enter Applicant name">
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="phonenumber">Applicant Age<span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="age" value="@isset($user->age){{$user->age}} @endisset"
                                        placeholder="Enter mobile number">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="Leadvalue">Value(₹)</label>
                                    <input type="number" class="form-control" name="price" value="@isset($user->price){{$user->price}} @endisset" placeholder="Enter Value">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="lastname">Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="@isset($user->email){{$user->email}} @endisset"
                                        placeholder="Enter email address">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="phonenumber">Mobile Number<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="mobile" value="@isset($user->mobile){{$user->mobile}}@endisset" placeholder="Enter mobile number">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="dob">Date of Birth<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="dob" value="@isset($user->dob){{\Carbon\Carbon::parse($user->dob)->format('Y-m-d')}}@endisset" placeholder="Enter Date of Birth">
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="marital">Martial Status</label>
                                    <select name="marital_status" class="form-control">
                                        <option value="" selected>--Choose Option--</option>
                                        <option value="Married" @if ($user->marital_status == 'Married') selected @endif>
                                            Married</option>
                                        <option value="Unmarried" @if ($user->marital_status == 'Unmarried') selected @endif>
                                            Unmarried</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12 mb-3">
                                <div class="form-group">
                                    <label for="address">Description</label>
                                    <textarea name="description" class="form-control" id="" placeholder="Enter Drescription" style="height:100px;">@isset($user->description){{ $user->description }}@endisset</textarea>
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
                                    <input type="text" class="form-control" name="address" value="@isset($user->address){{ $user->address }}@endisset"
                                        placeholder="Enter Address">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="country">Country<span class="text-danger">*</span></label>
                                    <select name="country" onchange="getstates(this)" class="form-control">
                                        @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    @isset($user->country){{ $user->country == $country->id ? 'selected' : '' }} @endisset>
                                                    {{ $country->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select name="state" onchange="getcities(this)" id="states"
                                        class="form-control">
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"
                                                @isset($data->state)
                                        {{ $data->state == $state->id ? 'selected' : '' }} @endisset>
                                                {{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">City</label>
                                    <select name="city" id="cities" class="form-control">
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                @isset($data->city)
                                        {{ $data->city == $city->id ? 'selected' : '' }} @endisset>
                                                {{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="zip">Zip Code</label>
                                    <input type="text" class="form-control" name="zipcode" value="@isset($user->zipcode){{$user->zipcode}}@endisset" placeholder="Enter Zip">
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
                                <select name="interested" id="interested" onchange="getImmigrationLists(this,'{{ $user->interested }}')" class="form-control">
                                    @foreach ($getInterestType as $item)
                                        <option value="{{strtoupper($item)}}" @if ($user->interested == strtoupper($item)) selected @endif>{{strtoupper($item)}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 mb-3" >
                                <div class="form-group" id="interestType">
                                    
                                </div>
                            </div>

                            <div class="row" id="fields"></div>
                            @isset($documentCategory)
                                @foreach ($documentCategory as $item)
                                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="zip">{{$item->name}}<span class="text-danger">*</span></label><br />
                                            @isset($item->docs->document)
                                                <img width="50px" height="50px" src="{{url('/uploads/docs/'.$item->docs->document.'')}}" alt="{{$item->docs->document_name}}">
                                            @endisset
                                            <input type="file" class="form-control" name="document[{{$item->id}}]" value="" {{$item->docs == NULL ? "required " : ""}}>
                                        </div>
                                    </div>                                
                                @endforeach
                            @endisset
                            
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
                                    <input type="input" class="form-control" 
                                        placeholder="Enter date">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-3">
                                <label class="" for="Applicants_image">Pan Card</label>
                                <div class="input-group">
                                    <div class="form-group">
                                        <input type="file"  id="Applicants_image"
                                            accept="image/*" class="form-file-input form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="contacted_date">Application Number</label>
                                    <input type="text" class="form-control" 
                                        placeholder="Enter date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                {{-- IETS --}}
                <div class="card h-auto" id="IETS" style="display: none">
                    <div class="card-header">
                        <h4 class="card-title">IETS</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="contacted_date">Graduation Degree</label>
                                    <input type="input" class="form-control" 
                                        placeholder="Enter date">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-3">
                                <label class="" for="Applicants_image">Pan Card</label>
                                <div class="input-group">
                                    <div class="form-group">
                                        <input type="file"  id="Applicants_image"
                                            accept="image/*" class="form-file-input form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="contacted_date">Marksheet</label>
                                    <input type="text" class="form-control" 
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
                                        <input type="file"  id="Applicants_image"
                                            accept="image/*" class="form-file-input form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="contacted_date">Application Number</label>
                                    <input type="text" class="form-control" 
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

    $(document).ready(function() {
            // Trigger the change event for the interested select element
            $('#interested').trigger('change');
        });
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
                    console.log(immigration_type);
                    let html = `<label class="form-label" for="">Interested</label>
                    <select id="type_of_immigration" onchange="getfieldcount(this, '${immigration_type}')" name="type_of_immigration" class="form-control">
                        <option value="">Select</option>`;
                    response.forEach(function(ele) {
                        html += `<option value="${ele.toUpperCase()}" ${ele.toUpperCase() === '{{ $user->type_of_immigration }}' ? 'selected' : ''}>${ele.toUpperCase()}</option>`;
                    });
                    html += `</select>`
                    console.log(html);
                    $('#interestType').html(html);
                    // $('#type_of_immigration').trigger('change');
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
                                <input type="file" name="document[${key}]" class="form-file-input form-control">
                            </div>
                        </div>
                    </div>`;
                });
                $('#fields').html(html);
                // response.forEach(function(ele) {
                // $("form").validate().settings.rules[ele] = {
                //     required: true
                // };
                // $("form").validate().settings.messages[ele] = {
                //     required: "Please upload the document for " + ele + "."
                // };
            // });

            // Trigger validation for the form after adding dynamic fields
            // $("form").valid();
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
                address: {
                    required: true
                },
                interested:{
                    required:true
                },
                type_of_immigration:{
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