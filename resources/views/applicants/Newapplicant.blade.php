@extends("master")
@section('main-content')
<section class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class=" d-flex flex-wrap align-items-center text-head">
            <h2 class="mb-3 me-auto">Add Applicants</h2>

        </div>
        <form class="row">
            <div class="col-lg-12">
                <div class="card h-auto">
                    <div class="card-header">
                        <h4 class="card-title">Applicant Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12 mb-3">
                                <label class="" for="Applicants_image">Applicant Image</label>
                                <div class="input-group">
                                    <div class="form-file">
                                        <input type="file" name="Applicants_image" id="Applicants_image"
                                            accept="image/*" class="form-file-input form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="Applicantname">Applicant Name</label>
                                    <input type="text" class="form-control" name="Applicantname"
                                        placeholder="Enter Applicant name">
                                </div>
                            </div>
                     
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="text" class="form-control" name="dob" placeholder="Enter Date of Birth">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="lastname">Email</label>
                                    <input type="email" class="form-control" name="lastname"
                                        placeholder="Enter email address">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="phonenumber">Mobile Number</label>
                                    <input type="tel" class="form-control" name="phonenumber"
                                        placeholder="Enter mobile number">
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
                            <div class="col-lg-12 col-md-12 col-12 mb-3">
                                <div class="form-group">
                                    <label for="street">Street</label>
                                    <input type="text" class="form-control" name="street" placeholder="Enter Street">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select name="country" onchange="getstates(this)" class="form-control">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="state">State</label>
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
                                    <input type="text" class="form-control" name="zip" placeholder="Enter Zip">
                                </div>
                            </div>




                        </div>
                    </div>
                </div>

                <div class="card h-auto">
                    <div class="card-header">
                        <h4 class="card-title">Documents Information</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                          
                            <div class="col-lg-12 col-md-12 col-12 mb-3">
                                <label class="" for="aadharcard">Aadhar card</label>
                                <div class="input-group">
                                    <div class="form-file">
                                        <input type="file" name="aadharcard" id="aadharcard"
                                            accept="image/*" class="form-file-input form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12 mb-3">
                                <label class="" for="pancard">Pan card </label>
                                <div class="input-group">
                                    <div class="form-file">
                                        <input type="file" name="pancard" id="pancard"
                                            accept="image/*" class="form-file-input form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12 mb-3">
                                <label class="" for="passport">Passport</label>
                                <div class="input-group">
                                    <div class="form-file">
                                        <input type="file" name="Applicants_image" id="passport"
                                            accept="image/*" class="form-file-input form-control">
                                    </div>
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

    //get immigration lists
    function getImmigrationLists(selectElement)
    {
        var immigration_type=selectElement.value;
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
                let html = `<label class="form-label" for="">Type of Immigration</label>
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
                                        placeholder="Enter Details"></div></div>`;
                });
                console.log(html);
                $('#fields').html(html);
            }
        });
    }

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
                },
                interested:{
                    required:true
                },
                type_of_immigration:{
                    required:true
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
@endpush