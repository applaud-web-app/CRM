@extends('master')
@section('main-content')
    <section class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class=" d-flex flex-wrap align-items-center text-head">
                <h2 class="mb-3 me-auto">Lead Name (#4553545)</h2>

            </div>
            <form class="row" method="POST" action="{{route('leadgenerate',$data->id)}}">@csrf
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
                                        <input type="text" class="form-control" value="" name="lcode"
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
                                        <input type="text" class="form-control" name="Leadvalue"
                                            placeholder="Enter Value">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="emailaddress">Email Address</label>
                                        <input type="email" class="form-control" value="{{ $data->email }}"
                                            name="emailaddress" placeholder="Enter Email Address">
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
                                        <select name="marital" class="form-control">
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
                                            <select name="country" id="" class="form-control">
                                                <option value="" selected>--Choose Option--</option>

                                                <option value="Afghanistan">Afghanistan</option>
                                                <option value="Åland Islands">Åland Islands</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="American Samoa">American Samoa</option>
                                                <option value="Andorra">Andorra</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Anguilla">Anguilla</option>
                                                <option value="Antarctica">Antarctica</option>
                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <select name="state" id="" class="form-control">
                                                <option value="" selected>--Choose Option--</option>

                                                <option value="AP">Andhra Pradesh</option>
                                                <option value="AR">Arunachal Pradesh</option>
                                                <option value="AS">Assam</option>
                                                <option value="BR">Bihar</option>
                                                <option value="CT">Chhattisgarh</option>
                                                <option value="GA">Gujarat</option>
                                                <option value="HR">Haryana</option>
                                                <option value="HP">Himachal Pradesh</option>
                                                <option value="JK">Jammu and Kashmir</option>
                                                <option value="GA">Goa</option>
                                                <option value="JH">Jharkhand</option>
                                                <option value="KA">Karnataka</option>
                                                <option value="KL">Kerala</option>
                                                <option value="MP">Madhya Pradesh</option>
                                                <option value="MH">Maharashtra</option>
                                                <option value="MN">Manipur</option>
                                                <option value="ML">Meghalaya</option>
                                                <option value="MZ">Mizoram</option>
                                                <option value="NL">Nagaland</option>
                                                <option value="OR">Odisha</option>
                                                <option value="PB">Punjab</option>
                                                <option value="RJ">Rajasthan</option>
                                                <option value="SK">Sikkim</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="">City</label>
                                            <select name="" class="form-control">
                                                <option value="" selected>--Choose Option--</option>
                                                <option value="Alipur">Alipur</option>
                                                <option value="Bawana">Bawana</option>
                                                <option value="Central Delhi">Central Delhi</option>
                                                <option value="Delhi">Delhi</option>
                                                <option value="Deoli">Deoli</option>
                                                <option value="East Delhi">East Delhi</option>
                                                <option value="Karol Bagh">Karol Bagh</option>
                                                <option value="Najafgarh">Najafgarh</option>
                                                <option value="Nangloi Jat">Nangloi Jat</option>
                                                <option value="Narela">Narela</option>
                                                <option value="New Delhi">New Delhi</option>
                                                <option value="North Delhi">North Delhi</option>
                                                <option value="North East Delhi">North East Delhi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="zip">Zip Code</label>
                                            <input type="text" class="form-control" name="zip"
                                                placeholder="Enter Zip">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        {{-- <div class="card h-auto">
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
                                            <select name="country" id="" class="form-control">
                                                <option value="" selected>--Choose Option--</option>
                                                <option value="Afghanistan">Afghanistan</option>
                                                <option value="Åland Islands">Åland Islands</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="American Samoa">American Samoa</option>
                                                <option value="Andorra">Andorra</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Anguilla">Anguilla</option>
                                                <option value="Antarctica">Antarctica</option>
                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <select name="state" id="" class="form-control">
                                                <option value="" selected>--Choose Option--</option>

                                                <option value="AP">Andhra Pradesh</option>
                                                <option value="AR">Arunachal Pradesh</option>
                                                <option value="AS">Assam</option>
                                                <option value="BR">Bihar</option>
                                                <option value="CT">Chhattisgarh</option>
                                                <option value="GA">Gujarat</option>
                                                <option value="HR">Haryana</option>
                                                <option value="HP">Himachal Pradesh</option>
                                                <option value="JK">Jammu and Kashmir</option>
                                                <option value="GA">Goa</option>
                                                <option value="JH">Jharkhand</option>
                                                <option value="KA">Karnataka</option>
                                                <option value="KL">Kerala</option>
                                                <option value="MP">Madhya Pradesh</option>
                                                <option value="MH">Maharashtra</option>
                                                <option value="MN">Manipur</option>
                                                <option value="ML">Meghalaya</option>
                                                <option value="MZ">Mizoram</option>
                                                <option value="NL">Nagaland</option>
                                                <option value="OR">Odisha</option>
                                                <option value="PB">Punjab</option>
                                                <option value="RJ">Rajasthan</option>
                                                <option value="SK">Sikkim</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="">City</label>
                                            <select name="" class="form-control">
                                                <option value="" selected>--Choose Option--</option>
                                                <option value="Alipur">Alipur</option>
                                                <option value="Bawana">Bawana</option>
                                                <option value="Central Delhi">Central Delhi</option>
                                                <option value="Delhi">Delhi</option>
                                                <option value="Deoli">Deoli</option>
                                                <option value="East Delhi">East Delhi</option>
                                                <option value="Karol Bagh">Karol Bagh</option>
                                                <option value="Najafgarh">Najafgarh</option>
                                                <option value="Nangloi Jat">Nangloi Jat</option>
                                                <option value="Narela">Narela</option>
                                                <option value="New Delhi">New Delhi</option>
                                                <option value="North Delhi">North Delhi</option>
                                                <option value="North East Delhi">North East Delhi</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="zip">Zip Code</label>
                                            <input type="text" class="form-control" name="zip"
                                                placeholder="Enter Zip">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}


                        <div class="card h-auto">
                            <div class="card-header">
                                <h4 class="card-title">Source Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="type">Type</label>
                                            <select name="type" class="form-control">
                                                <option value="">Hot leads</option>
                                                <option value="">Cold leads</option>
                                                <option value="">Warm leads</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="">Started</option>
                                                <option value="">Processing</option>
                                                <option value="">Pending</option>
                                                <option value="">Hold</option>
                                                <option value="">Completed</option>
                                                <option value="">Rejected</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="source">Sources</label>
                                            <select name="source" class="form-control">
                                                <option value="Google" @if($data->source == 'Google') selected @endif>Google</option>
                                                <option value="Facebook" @if($data->source == 'Facebook') selected @endif>Facebook</option>
                                                <option value="Instagram" @if($data->source == 'Instagram') selected @endif>Instagram</option>
                                                <option value="Offline" @if($data->source == 'Offline') selected @endif>Offline</option>
                                                <option value="Justdial" @if($data->source == 'Justdial') selected @endif>Justdial</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="assignedto">Assigned To</label>
                                            <select name="leadassign" class="form-control">
                                                <option value="Sunil singh Rawat">Sunil singh Rawat</option>
                                                <option value="Himanshu Verma">Himanshu Verma</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="c_date">Contacted Date</label>
                                            <input type="datetime-local" class="form-control" name="c_date"
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
@push("scripts")
<script>
    $("form").each(function(){
     $($(this)).validate({
         rules: {
             name: {
                 required: true
             },
             age:{
                required:true,
             },
             Leadvalue:{
                required:true,
             },
             dob:{
                required:true
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
             leadassign:{
                required:true
             },
             lcode:{
                required:true
             },
             address:{
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