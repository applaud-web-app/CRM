@extends("master")
@section('main-content')
<section class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class=" d-flex flex-wrap align-items-center text-head">
            <h2 class="mb-3 me-auto">Edit Lead</h2>

        </div>
        <form class="row" method="POST" action="{{route('updatelead',$data->id)}}">@csrf
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
                                    <input type="text" class="form-control" name="name" 
                                    @isset($data->name)
                                    value="{{$data->name}}"
                                    @endisset placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="lcode">Code</label>
                                    <input type="text" class="form-control" name="code" 
                                    @isset($data->code)
                                    value="{{$data->code}}"
                                    @endisset
                                    placeholder="Enter Lead Code">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="age">Candidate Age</label>
                                    <input type="text" class="form-control" name="age"  
                                    @isset($data->age)
                                    value="{{$data->age}}"
                                    @endisset placeholder="Enter Value">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="Leadvalue">Lead Value(₹)</label>
                                    <input type="text" class="form-control" name="price" 
                                    @isset($data->price)
                                    value="{{$data->price}}"
                                    @endisset
                                    placeholder="Enter Value">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="emailaddress">Email Address</label>
                                    <input type="email" class="form-control" name="email"
                                    @isset($data->email)
                                    value="{{$data->email}}"
                                    @endisset    
                                    placeholder="Enter Email Address">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="emailaddress">Mobile number</label>
                                    <input type="tel" class="form-control" name="mobile"
                                    @isset($data->mobile)
                                    value="{{$data->mobile}}"
                                    @endisset  
                                    placeholder="Enter Mobile number">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
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
                                        <option value="Married" @if($data->marital_status) selected @endif>Married</option>
                                        <option value="Unmarried"  @if($data->marital_status) selected @endif>Unmarried</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12 mb-3">
                                <div class="form-group">
                                    <label for="address">Description</label>
                                    <textarea name="description" class="form-control" id=""
                                        placeholder="Enter Drescription" style="height:100px;">@isset($data->description){{$data->description}}@endisset</textarea>
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
                                    @isset($data->address)
                                        value="{{$data->address}}"
                                    @endisset 
                                    placeholder="Enter Address">
                                </div>
                            </div>




                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select name="country" id="" class="form-control">
                                        <option value="" selected>--Choose Option--</option>
                                        @isset($data->country)
                                        <option value="{{$data->country}}" selected>{{$data->country}}</option>
                                        @endisset
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
                                        @isset($data->state)
                                        <option value="{{$data->state}}" selected>{{$data->state}}</option>
                                        @endisset
                                        <option value="AP">Andhra Pradesh</option>
                                        <option value="AR">Arunachal Pradesh</option>
                                        <option value="AS">Assam</option>
                                        <option value="Bihar">Bihar</option>
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
                                    <select name="city" class="form-control">
                                        <option value="" selected>--Choose Option--</option>
                                        @isset($data->city)
                                        <option value="{{$data->city}}" selected>{{$data->city}}</option>
                                        @endisset
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
                                    <input type="text" class="form-control" name="zipcode"
                                    @isset($data->zipcode)
                                    value="{{$data->zipcode}}"
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
                                    <label for="type">Type</label>
                                    <select name="lead_type" class="form-control">
                                        <option value="Hot leads" @if($data->lead_type == 'Hot leads') selected @endif>Hot Lead</option>
                                        <option value="Warm leads" @if($data->lead_type == 'Warm leads') selected @endif>Warm Lead</option>
                                        <option value="Cold leads" @if($data->lead_type == 'Cold leads') selected @endif>Cold Lead</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="Started" @if($data->status == 'Started') selected @endif>Started</option>
                                        <option value="Processing" @if($data->status == 'Processing') selected @endif>Processing</option>
                                        <option value="Pending" @if($data->status == 'Pending') selected @endif>Pending</option>
                                        <option value="Hold" @if($data->status == 'Hold') selected @endif>Hold</option>
                                        <option value="Completed" @if($data->status == 'Completed') selected @endif>Completed</option>
                                        <option value="Rejected" @if($data->status == 'Rejected') selected @endif>Rejected</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="source">Sources</label>
                                    <select name="source" class="form-control">
                                        <option value="">--Choose Option---</option>
                                        <option value="Google"  @if($data->source == 'Google') selected @endif>Google</option>
                                        <option value="Facebook"  @if($data->source == 'Facebook') selected @endif>Facebook</option>
                                        <option value="Instagram"  @if($data->source == 'Instagram') selected @endif>Instagram</option>
                                        <option value="Landing Page"  @if($data->source == 'Landing Page') selected @endif>Landing Page</option>
                                        <option value="Others"  @if($data->source == 'Others') selected @endif>Others</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="assigned_to">Assigned To</label>
                                    <select name="assigned_to" class="form-control">
                                        @isset($users)
                                               @foreach ($users as $user)
                                               <option value="{{$user->id}}">{{$user->username}}</option>
                                               @endforeach
                                               @endisset
                                    </select>
                                </div>
                            </div>
                        
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="contacted_date">Contacted Date</label>
                                    <input type="datetime-local" class="form-control" name="contacted_date"
                                    @isset($data->contacted_date)
                                    value="{{ \Carbon\Carbon::parse($data->contacted_date)->format('Y-m-d') }}"
                                    @else
                                    value="{{ date('d-m-y') }}" 
                                    @endisset
                                        placeholder="Enter date">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="close_date">Close Date</label>
                                    <input type="date" class="form-control" name="close_date"
                                    @isset($data->close_date)
                                    value="{{ \Carbon\Carbon::parse($data->close_date)->format('Y-m-d') }}"
                                    @else
                                    value="{{ date('d-m-y') }}" 
                                    @endisset
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
             assigned_to:{
                required:true
             },
             code:{
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