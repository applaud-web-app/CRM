@extends('master')
@section('main-content')
    <section class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class=" d-flex flex-wrap align-items-center text-head">
                <h2 class="mb-3 me-auto">Create New Lead</h2>

            </div>
            <form class="row" method="POST" action="{{ route('newleadcreate') }}">@csrf
                <div class="col-lg-12">

                    <div class="card h-auto">
                        <div class="card-header">
                            <h4 class="card-title">Lead Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="age">Candidate Age <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="age" placeholder="Enter Value">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="Leadvalue">Lead Value(₹)</label>
                                        <input type="number" class="form-control" name="price" placeholder="Enter Value">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="emailaddress">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Enter Email Address">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="emailaddress">Mobile number <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="mobile"
                                            placeholder="Enter Mobile number">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="dob"
                                            placeholder="Enter Date of Birth">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="marital">Martial Status</label>
                                        <select name="marital_status" class="form-control">
                                            <option value="" selected>--Choose Option--</option>
                                            <option value="">Married</option>
                                            <option value="">Unmarried</option>
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
                                        <label for="country">Country</label>
                                        <select name="country" onchange="getstates(this)" class="form-control">
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <select name="state" onchange="getcities(this)" id="states"
                                            class="form-control">
                                            <option value="" selected>--Choose Option--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="">City</label>
                                        <select name="city" id="cities" class="form-control">
                                            <option value="" selected>--Choose Option--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="zip">Zip Code</label>
                                        <input type="text" class="form-control" name="zipcode"
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
                                        <label for="type">Type </label>
                                        <select name="lead_type" class="form-control">
                                            <option value="Hot leads">Hot leads</option>
                                            <option value="Cold leads">Cold leads</option>
                                            <option value="Warm leads">Warm leads</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="Generated">Generated</option>
                                            <option value="Qualified">Qualified</option>
                                            <option value="Initial">Initial Contact</option>
                                            <option value="Schedule Appointemnt">Schedule Appointemnt</option>
                                            <option value="Proposal Sent">Proposal Sent</option>
                                            <option value="Open">Open</option>
                                            <option value="Close">Close</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
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

                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="assigned_to">Assigned To <span class="text-danger">*</span></label>
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
                                        <label for="contacted_date">Contacted Date</label>
                                        <input type="datetime-local" class="form-control" name="contacted_date"
                                            placeholder="Enter date">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="close_date">Close Date</label>
                                        <input type="date" class="form-control" name="close_date"
                                            placeholder="Enter date">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card h-auto">
                        <div class="card-header">
                            <h4 class="card-title">Interested</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 mb-3">
                                    <div class="form-group">
                                        <label class="form-label" for="interested">Interested <span
                                                class="text-danger">*</span></label>
                                        @php
                                            $getInterestType = array_keys(\Common::immigration());
                                        @endphp
                                        <select name="interested" id="interested" onchange="getImmigrationLists(this)"
                                            class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($getInterestType as $item)
                                                <option value="{{ strtoupper($item) }}">{{ strtoupper($item) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 mb-3">
                                    <div class="form-group" id="interestType">

                                    </div>
                                </div>

                                <div class="row" id="fields"></div>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-lg-12 ">
            <button type="submit" class="btn btn-primary  mb-2"><i class="far fa-check-square pe-2"></i>Submit</button>
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
                    address: {
                        required: true
                    },
                    type_of_immigration: {
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

        //get immigration lists
        function getImmigrationLists(selectElement) {
            var immigration_type = selectElement.value;
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
                    let html = `<label class="form-label" for="">Type of Immigration <span class="text-danger">*</span></label>
                    <select id="type_of_immigration" onchange="getfieldcount(this, '${immigration_type}')" name="type_of_immigration" class="form-control">
                        <option value="">Select</option>`;
                    response.forEach(function(ele) {
                        html += `<option value="${ele.toUpperCase()}">${ele.toUpperCase()}</option>`;
                    });
                    html += `</select>`
                    console.log(html);
                    $('#interestType').html(html);
                }
            });
        }

        //get immigration->list->fields
        function getfieldcount(selectElement, immigrationType) {
            var fieldlist = selectElement.value;
            console.log(immigrationType);
            $.ajax({
                url: "{{ route('loadimmigrationtype') }}",
                type: "POST",
                data: {
                    fields: fieldlist,
                    field_type: immigrationType,
                    _token: "{{ csrf_token() }}",
                },
                datatype: JSON,
                success: function(response) {
                    let html = ``;
                    response.forEach(function(ele) {
                        html += `<div class="col-lg-4 col-md-6 col-12 mb-3"><div class="form-group"><label for="${ele}">${ele}</label>
                                        <input type="text" class="form-control mb-2" name="${ele}"
                                            placeholder="Enter Details"></div></div>`;
                    });
                    console.log(html);
                    $('#fields').html(html);
                }
            });
        }
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('#interested').change(function() {
                var selectedOption = $(this).val();
                $('#visa-options, #iets-options', '#type_of_pte').hide();
                if (selectedOption === 'VISA') {
                    $('#visa-options').show();
                    $('#iets-options').hide();
                    $('#pte-options').hide();
                } else if (selectedOption === 'IETS') {
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
    </script> --}}
@endpush
