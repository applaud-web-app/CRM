@extends('master')
@section('main-content')
    <section class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class=" d-flex flex-wrap align-items-center text-head">
                <a class="backbtn mb-3 mx-2" href="{{url()->previous()}}"><i class="fa fa-arrow-left"></i></a>
                <h2 class="mb-3 me-auto">Add Employee</h2>

            </div>
            <form class="row" method="POST" action="{{ route('posteditemployee', $data->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="col-lg-12">
                    <div class="card h-auto">
                        <div class="card-header">
                            <h4 class="card-title">Employee Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12 mb-3">
                                    <label class="" for="Staff_image">Profile Image</label><br/>
                                    @isset($data->profile_img)
                                        <img src="{{asset('/uploads/user/'.$data->profile_img.'')}}" alt="">
                                    @endisset
                                    <div class="input-group">
                                        <div class="form-file">
                                            <input type="file" name="profile" id="Staff_image" accept="image/*"
                                                class="form-file-input form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="firstname">First Name</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" name="first_name"
                                            value="{{ $data->first_name }}" placeholder="Enter Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="firstname">Last Name</label>
                                        <input type="text" class="form-control" name="last_name"
                                            value="{{ $data->last_name }}" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="doj">Date of Joining</label>
                                        <input type="date" class="form-control" name="joining_date"
                                            @isset($data->joining_date)
                                    value="{{ \Carbon\Carbon::parse($data->joining_date)->format('Y-m-d') }}"
                                    @endisset
                                            placeholder="Enter Date of Joining" @required(true)>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="dob">Date of Birth</label> <span class="text-danger">*</span>
                                        <input type="date" class="form-control" name="dob"
                                            @isset($data->dob)
                                    value="{{ \Carbon\Carbon::parse($data->dob)->format('Y-m-d') }}"
                                    @endisset
                                            placeholder="Enter Date of Birth">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="role">Role</label> <span class="text-danger">*</span>
                                        <select name="role" id="" class="form-control">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="" class="form-control"> <span
                                                class="text-danger">*</span>
                                            <option value="M" @if ($data->gender == 'M') @endif>Male</option>
                                            <option value="F" @if ($data->gender == 'F') @endif>Female</option>
                                            <option value="O" @if ($data->gender == 'O') @endif>Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="blood_group">Blood Group</label></span>
                                        <input type="text" class="form-control" name="blood_group"
                                            value="{{ $data->blood_group }}" placeholder="Enter Blood Group">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="address">Address</label> <span class="text-danger">*</span>
                                        <textarea name="address" class="form-control" placeholder="Enter Full Address" style="height:100px;">{{ $data->address }}</textarea>
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
                                            value="{{ $data->phone }}" placeholder="Enter mobile number">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="email">Email</label> <span class="text-danger">*</span>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $data->email }}" placeholder="Enter email address">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="username">Username</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control" name="username"
                                            value="{{ $data->username }}" placeholder="Enter username">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="lastname">Password</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Enter last name">
                                        <i class="toggle-password far fa-fw fa-eye-slash"></i>
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
                    first_name: {
                        required: true
                    },
                    username: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    joining_date: {
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
                    emp_code: {
                        required: true
                    },
                    department: {
                        required: true
                    },
                    role: {
                        required: true
                    },
                    gender: {
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
@endpush
