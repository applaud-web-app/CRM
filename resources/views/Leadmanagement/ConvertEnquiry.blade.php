@extends('master')
@section('main-content')
    <section class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class=" d-flex flex-wrap align-items-center text-head">
                <h2 class="mb-3 me-auto">Lead Name (#4553545)</h2>

            </div>
            <form class="row" method="POST" action="{{ route('leadgenerate', $data->id) }}">@csrf
                <div class="col-lg-12">

                    <div class="card h-auto">
                        <div class="card-header">
                            <h4 class="card-title">Lead Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" value="{{ $data->name }}"
                                            name="name" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="lcode">Code</label>
                                        <input type="text" class="form-control" value="" name="code"
                                            placeholder="Enter Lead Code">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="age">Candidate Age</label>
                                        <input type="text" class="form-control" value="" name="age"
                                            placeholder="Enter Value">
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
                                        <label for="emailaddress">Email Address</label>
                                        <input type="email" class="form-control" value="{{ $data->email }}"
                                            name="email" placeholder="Enter Email Address">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="emailaddress">Mobile number</label>
                                        <input type="number" class="form-control" value="{{ $data->mobile }}"
                                            name="mobile" placeholder="Enter Mobile number">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" class="form-control" value="" name="dob"
                                            placeholder="Enter Date of Birth">
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
                                        <label for="address">Address</label>
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
                                        <label for="type">Type</label>
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
                                        <label for="source">Sources</label>
                                        <select name="source" class="form-control">
                                            <option value="Google" @if ($data->source == 'Google') selected @endif>Google
                                            </option>
                                            <option value="Facebook" @if ($data->source == 'Facebook') selected @endif>
                                                Facebook</option>
                                            <option value="Instagram" @if ($data->source == 'Instagram') selected @endif>
                                                Instagram</option>
                                            <option value="Offline" @if ($data->source == 'Offline') selected @endif>
                                                Offline</option>
                                            <option value="Justdial" @if ($data->source == 'Justdial') selected @endif>
                                                Justdial</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="assignedto">Assigned To</label>
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
                                        <input type="date" class="form-control" name="contacted_date"
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
    </script>
@endpush
