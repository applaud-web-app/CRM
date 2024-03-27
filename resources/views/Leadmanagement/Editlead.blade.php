@extends('master')
@section('main-content')
    <section class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class=" d-flex flex-wrap align-items-center text-head">
                <a class="backbtn mb-3 mx-2" href="{{url()->previous()}}"><i class="fa fa-arrow-left"></i></a>
                <h2 class="mb-3 me-auto">Edit Lead</h2>
            </div>
            <form class="row" method="POST" action="{{ route('updatelead', $data->id) }}">@csrf
                <div class="col-lg-12">

                    <div class="card h-auto">
                        <div class="card-header">
                            <h4 class="card-title">Lead Information</h4>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="name">Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name"
                                            @isset($data->name)
                                    value="{{ $data->name }}"
                                    @endisset
                                            placeholder="Enter Name">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="age">Candidate Age<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="age"
                                            @isset($data->age)
                                    value="{{ $data->age }}"
                                    @endisset
                                            placeholder="Enter Value">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="Leadvalue">Lead Value(₹)<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="price"
                                            @isset($data->price)
                                    value="{{ $data->price }}"
                                    @endisset
                                            placeholder="Enter Value">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="emailaddress">Email Address<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email"
                                            @isset($data->email)
                                    value="{{ $data->email }}"
                                    @endisset
                                            placeholder="Enter Email Address">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="emailaddress">Mobile number<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="mobile"
                                            @isset($data->mobile)
                                    value="{{ $data->mobile }}"
                                    @endisset
                                            placeholder="Enter Mobile number">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="dob">Date of Birth<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="dob"
                                            @isset($data->dob)
                                    value="{{ \Carbon\Carbon::parse($data->dob)->format('Y-m-d') }}"
                                    @else
                                        value="{{ date('Y-m-d') }}" 
                                    @endisset
                                            placeholder="Enter Date of Birth">
                                    </div>
                                </div>




                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="marital">Martial Status</label>
                                        <select name="marital_status" class="form-control">
                                            <option value="">--Choose Option--</option>
                                            <option value="Married" @if ($data->marital_status == 'Married') selected @endif>
                                                Married</option>
                                            <option value="Unmarried" @if ($data->marital_status == 'Unmarried') selected @endif>
                                                Unmarried</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="address">Description</label>
                                        <textarea name="description" class="form-control" id="" placeholder="Enter Drescription" style="height:100px;">@isset($data->description){{ $data->description }}@endisset
                                        </textarea>
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
                                        <label for="address">Address<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="address"
                                            @isset($data->address)
                                        value="{{ $data->address }}"
                                    @endisset
                                            placeholder="Enter Address">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <select name="country" onchange="getstates(this)" id=""
                                            class="form-control">
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    @isset($data->country)
                                                    {{ $data->country == $country->id ? 'selected' : '' }} @endisset>
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


                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="zip">Zip Code</label>
                                        <input type="text" class="form-control" name="zipcode"
                                            @isset($data->zipcode)
                                    value="{{ $data->zipcode }}"
                                    @endisset
                                            placeholder="Enter Zip">
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
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="type">Type<span class="text-danger">*</span></label>
                                        <select name="lead_type" class="form-control" required>
                                            <option value="Hot leads" @if ($data->lead_type == 'Hot leads') selected @endif>
                                                Hot Lead</option>
                                            <option value="Warm leads" @if ($data->lead_type == 'Warm leads') selected @endif>
                                                Warm Lead</option>
                                            <option value="Cold leads" @if ($data->lead_type == 'Cold leads') selected @endif>
                                                Cold Lead</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control" required>
                                            <option value="Generated" @if ($data->status == 'Generated') selected @endif>
                                                Generated</option>
                                            <option value="Qualified" @if ($data->status == 'Qualified') selected @endif>
                                                Qualified</option>
                                            <option value="Initial Contact"
                                                @if ($data->status == 'Pending') selected @endif>Pending</option>
                                            <option value="Schedule Appointemnt"
                                                @if ($data->status == 'Schedule Appointemnt') selected @endif>Schedule Appointemnt
                                            </option>
                                            <option value="Proposal Sent"
                                                @if ($data->status == 'Proposal Sent') selected @endif>Proposal Sent</option>
                                            <option value="Open" @if ($data->status == 'Open') selected @endif>Open
                                            </option>
                                            <option value="Close" @if ($data->status == 'Close') selected @endif>
                                                Close</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="source">Sources<span class="text-danger">*</span></label>
                                        <select name="source" class="form-control">
                                            <option value="">--Choose Option---</option>
                                            <option value="Google" @if ($data->source == 'Google') selected @endif>
                                                Google</option>
                                            <option value="Facebook" @if ($data->source == 'Facebook') selected @endif>
                                                Facebook</option>
                                            <option value="Instagram" @if ($data->source == 'Instagram') selected @endif>
                                                Instagram</option>
                                            <option value="Landing Page"
                                                @if ($data->source == 'Landing Page') selected @endif>Landing Page</option>
                                            <option value="Others" @if ($data->source == 'Others') selected @endif>
                                                Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="assigned_to">Assigned To<span class="text-danger">*</span></label>
                                        <select name="assigned_to" class="form-control">
                                            @isset($users)
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="contacted_date">Contacted Date<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="contacted_date"
                                            
                                    value="@isset($data->contacted_date){{ \Carbon\Carbon::parse($data->contacted_date)->format('Y-m-d') }}@endisset" 
                                    placeholder="Select date">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="close_date">Close Date</label>
                                        <input type="date" class="form-control" name="close_date"
                                            
                                    value="@isset($data->close_date){{ \Carbon\Carbon::parse($data->close_date)->format('Y-m-d') }}@endisset"
                                    placeholder="Select date">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card h-auto">
                        <div class="card-header">
                            <h4 class="card-title">Interested Information type</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-label" for="interested">Interested<span class="text-danger">*</span></label>
                                        @php
                                        $getInterestType = array_keys(\Common::immigration());
                                    @endphp
                                    <select name="interested" id="interested" onchange="getImmigrationLists(this,'{{ $data->interested }}')" class="form-control">
                                        @foreach ($getInterestType as $item)
                                            <option value="{{strtoupper($item)}}" @if ($data->interested == strtoupper($item)) selected @endif>{{strtoupper($item)}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 mb-3" >
                                    <div class="form-group" id="interestType">
                                        
                                    </div>
                                </div>

                                <div class="row" id="fields"></div>
                        </div>
                    </div>
                </div>

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
        $("form").each(function() {
            $($(this)).validate({
                rules: {
                    name: {
                        required: true
                    },
                    age: {
                        required: true,
                    },
                    Leadvalue: {
                        required: true,
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
                    source: {
                        required: true
                    },
                    assigned_to: {
                        required: true
                    },
                    code: {
                        required: true
                    },
                    address: {
                        required: true
                    }
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
        })
    </script>

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
        // get immigration lists
        function getImmigrationLists(selectElement,preselectedValue)
        {
            var immigration_type=selectElement.value;
            console.log(immigration_type);
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
                    <select id="type_of_immigration" onchange="getfieldcount(this, '${immigration_type}')" name="type_of_immigration" class="form-control">
                        <option value="">Select</option>`;
                    response.forEach(function(ele) {
                        html += `<option value="${ele.toUpperCase()}" ${ele.toUpperCase() === '{{ $data->type_of_immigration }}' ? 'selected' : ''}>${ele.toUpperCase()}</option>`;
                    });
                    html += `</select>`
                    console.log(html);
                    $('#interestType').html(html);
                    $('#type_of_immigration').trigger('change');
                }
            });
        }

        // get immigration->list->fields
        function getfieldcount(selectElement,immigrationType){
            var fieldlist=selectElement.value;
            console.log(immigrationType);
            $.ajax({
                url: "{{ route('loadimmigrationtype') }}",
                type: "POST",
                data: {
                    fields: fieldlist,
                    field_type:immigrationType,
                    _token: "{{ csrf_token() }}",
                },
                datatype: JSON,
                success: function(response) {
                    let html=``;
                    response.forEach(function(ele) {
                        html += `<div class="col-lg-4 col-md-6 col-12 mb-3"><div class="form-group"><label for="${ele}">${ele}</label>
                                        <input type="text" class="form-control mb-2" name="${ele}"
                                            placeholder="Enter Zip"></div></div>`;
                    });
                    console.log(html);
                    $('#fields').html(html);
                }
            });
        }
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

            } else if (selectedOption === 'IELTS') {
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


    
@endpush
