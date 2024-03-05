@extends('master')
@section('main-content')
    <!--**********************************
   Content body start
   ***********************************-->
   <section class="content-body">
      <!-- row -->
      <div class="container-fluid">
         <div class="d-flex flex-wrap align-items-center text-head">
            <h2 class="mb-3 me-auto">Account Settings</h2>
         </div>
         <div class="row ">
         <div class="col-lg-12 col-md-12 col-12">
               <form class="card" action="{{route('accountSetting')}}" method="POST" enctype="multipart/form-data" id="accountSetting">
                     @csrf
                     <div class="card-body">
                        <div class="form-group mb-3">
                           <label for="firstname">First Name <span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="firstname" id="firstname" value="@isset($user->first_name) {{$user->first_name}} @endisset" placeholder="Enter first name" required>
                        </div>
                        <div class="form-group mb-3">
                           <label for="lastname">Last Name</label>
                           <input type="text" class="form-control" name="lastname" value="@isset($user->last_name) {{$user->last_name}} @endisset" placeholder="Enter last name" >
                        </div>
                        <div class="form-group mb-3">
                           <label for="email">Email <span class="text-danger">*</span></label>
                           <input type="email" class="form-control" name="email" id="email" value="@isset($user->email) {{$user->email}} @endisset" placeholder="Enter email address" required>
                        </div>
                        <div class="form-group mb-3">
                           <label for="number">Mobile Number <span class="text-danger">*</span></label>
                           <input type="number" class="form-control" value="@isset($user->phone){{$user->phone}}@endisset" name="number" id="number" placeholder="Enter mobile number" required>
                        </div>
                        <div class="form-group mb-3">
                           <label for="gender">Gender <span class="text-danger">*</span></label>
                           <select name="gender" id="gender" class="form-control">
                              @php $gender = NULL; @endphp
                              @isset($user->gender)
                               @php $gender = $user->gender;  @endphp
                              @endisset
                              <option value="M" {{$gender == "M" ? "selected" : ""}}>Male</option>
                              <option value="F" {{$gender == "F" ? "selected" : ""}}>Female</option>
                              <option value="O" {{$gender == "O" ? "selected" : ""}}>Others</option>
                           </select>
                        </div>
                        <div class="form-group">
                        <label class="" for="profile_image">Profile Image <code>Img type must be : JPG, JPEG & PNG</code></label><br>
                           @isset($user->profile_img)
                              <img src="{{asset('/uploads/users/'.$user->profile_img.'')}}" alt="user_img" height="100px">
                           @endisset
                           <div class="input-group">
                              <div class="form-file">
                                 <input type="file" name="profile_image" id="profile_image" accept="image/*" class="form-file-input form-control">
                              </div>
                           </div>
                        </div>
                  </div>
                  <div class="card-footer">
                     <div class="text-end">
                        <button type="submit" class="btn btn-primary" id="submitBtn"><i class="far fa-check-square pe-2"></i>Save</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
   <!--**********************************
      Content body end
   ***********************************-->
@endsection
@push('scripts')
   <script>
      $("#accountSetting").validate({
            rules: {
               firstname: {
                    required: true,
                },
                email: {
                    required: true,
                },
                number: {
                    required: true,
                },
                gender: {
                    required: true,
                },
            },
            errorElement: 'div',
            highlight: function(element, errorClass) {
                $(element).css({ border: '1px solid #f00' });
            },
            unhighlight: function(element, errorClass) {
                $(element).css({ border: '1px solid #c1c1c1' });
            },
            submitHandler: function(form,event) {
               event.preventDefault();
               $("#submitBtn").attr('disabled','disabled').text('Processing...');
               document.getElementById("accountSetting").submit();
            }
        });
   </script>
@endpush
