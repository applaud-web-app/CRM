@extends("master")
@section('main-content')
<section class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class=" d-flex flex-wrap align-items-center text-head">
            <h2 class="mb-3 me-auto">Add Employee</h2>
        
        </div>
        <form class="row" method="POST" action="{{route("postaddemployee")}}">@csrf
            <div class="col-lg-12">

                <div class="card h-auto">
                    <div class="card-header">
                        <h4 class="card-title">Employee Information</h4>
                       
                    </div>
                    <div class="card-body">
                       
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12 mb-3">
                                <label class="" for="Staff_image">Profile Image</label>
                                <span class="text-danger">*</span>
                                <div class="input-group">
                                    <div class="form-file">
                                        <input type="file" name="profile_img"  id="Staff_image" accept="image/*"
                                            class="form-file-input form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="firstname">First Name</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="first_name"  placeholder="Enter Name">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="firstname">Last Name</label>
                                    <input type="text" class="form-control" name="last_name"  placeholder="Enter Name">
                                </div>
                            </div>


                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="empcode">Employee Code</label> <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="emp_code" placeholder="Enter Employee Code">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="doj">Date of Joining</label>
                                    <input type="date" class="form-control" name="joining_date"
                                    placeholder="Enter Date of Joining">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label> <span class="text-danger">*</span>
                                    <input type="date" class="form-control" name="dob" 
                                    placeholder="Enter Date of Birth">
                                </div>
                            </div>
                           
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="role">Role</label> <span class="text-danger">*</span>
                                    <select name="role" id="" class="form-control">
                                        @foreach ($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="department">Department</label> <span class="text-danger">*</span>
                                    <select name="department" class="form-control" >
                                        <option value="">Choose</option>
                                        <option value="UI/UX" >UI/UX</option>
                                        <option value="Support" >Support</option>
                                        <option value="HR" >HR</option>
                                        <option value="Engineering" >Engineering</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="" class="form-control"> <span class="text-danger">*</span>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        <option value="O">Others</option>
                                    </select>
                                </div>
                            </div>
                          
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="blood_group">Blood Group</label> <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="blood_group"  placeholder="Enter Blood Group">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12 mb-3">
                                <div class="form-group">
                                    <label for="address">Address</label> <span class="text-danger">*</span>
                                    <textarea name="address" class="form-control" placeholder="Enter Full Address"
                                        style="height:100px;"></textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="card h-auto">
                        <div class="card-header">
                            <h4 class="card-title">Account Information</h4>
                        </div>
                        <div class="card-body">
                        <div class="row">
                        <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="phone">Mobile Number</label> <span class="text-danger">*</span>
                                    <input type="number" class="form-control" name="phone"
                                       
                                    placeholder="Enter mobile number">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="email">Email</label> <span class="text-danger">*</span>
                                    <input type="email" class="form-control" name="email"
                                   
                                    placeholder="Enter email address">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="username">Username</label> <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="username"
                                         
                                    placeholder="Enter username">
                                </div>
                            </div>
                             <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="lastname">Password</label> <span class="text-danger">*</span>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Enter password ">
                                    <i class="toggle-password far fa-fw fa-eye-slash"></i>
                                </div>
                            </div>
                            
                            <div class="col-lg-12 col-md-12 col-12">
                                <label class="" for="Staff_image">Status</label>
                                <div class=" custom-radio  justify-content-start  ">
                                    <label class="mb-1">
                                        <input type="radio" name="status" value="1">
                                        <span>Enable </span>
                                    </label>
                                    <label class="mb-1">
                                        <input type="radio" value="0" name="status">
                                        <span>Disable </span>
                                    </label>
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
    $("form").each(function(){
     $($(this)).validate({
         rules: {
             profile_img:{
                required: true
            },
             first_name: {
                 required: true
             },
             last_name: {
                 required: true
             },
             username:{
                required:true,
             },
             address:{
                required:true,
             },
             dob:{
                required:true
             },
             phone: {
                 required: true,
                 number: true,
                 maxlength: 10,
                 minlength: 10
             },
             email: {
                 required: true,
                 email: true,
             },
             emp_code: {
                 required: true
             },
             password: {
                 required: true,
                 minlength: 8
             },
             department: {
                 required: true
             },
             role:{
                required:true
             },
             gender:{
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