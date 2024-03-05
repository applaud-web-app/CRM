@extends('master')
@section('main-content')
    <!--**********************************
       Content body start
       ***********************************-->
    <section class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center text-head">
                <h2 class="mb-3 me-auto">Password Settings</h2>
            </div>
            <div class="row ">
                <div class="col-lg-12 col-md-12 col-12">
                    <form class="card" action="{{route('userpassword')}}" method="POST" id="updatePass">
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="new_password">Create New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter New Password">
                                <i class="toggle-password far fa-fw fa-eye-slash"></i>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm New Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password">
                                <i class="toggle-password far fa-fw fa-eye-slash"></i>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary"><i class="far fa-check-square pe-2"></i>Save</button>
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
        $('#updatePass').validate({
            rules: {
                new_password: {
                    required: true,
                    minlength: 6,
                },
                confirm_password: {
                    minlength: 6,
                    required: true,
                    equalTo: "#new_password"
                },
            },
            messages:{
                confirm_password:{
                    equalTo:"New Password & Confirm Password Not Match",
                }
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
               document.getElementById("updatePass").submit();
            }
        });
    </script>
@endpush
