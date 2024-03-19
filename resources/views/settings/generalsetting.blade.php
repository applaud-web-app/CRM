@extends('master')
@section('main-content')
<section class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class=" d-flex flex-wrap align-items-center text-head">
            <h2 class="mb-3 me-auto">General Information</h2>

        </div>
        <div class="row">
            <div class="col-xl-12">
                <form class="card" id='generalform' action="{{ route('generalupdate') }}" method="POST">@csrf

                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="site_name">Site Name<span class="text-danger">*</span></label>
                                <input type="text" name="site_name" value="@isset($data->site_name){{$data->site_name}}@endisset" id="site_name" class="form-control "
                                    placeholder="Site name">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="site_title">Site Title<span class="text-danger">*</span></label>
                                <input type="text" name="site_title" value="@isset($data->site_title){{$data->site_title}}@endisset" id="site_title" class="form-control "
                                    placeholder="Site title">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="company">Company<span class="text-danger">*</span></label>
                                <input type="text" name="company" value="@isset($data->company){{$data->company}}@endisset" id="company" class="form-control "
                                    placeholder="Company name">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <input type="text" name="email" value="@isset($data->email){{$data->email}}@endisset" id="email" class="form-control "
                                    placeholder="abc@gmail.com">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="phone">Phone<span class="text-danger">*</span></label>
                                <input type="number" name="phone" value="@isset($data->phone){{$data->phone}}@endisset" id="phone" class="form-control "
                                    placeholder="Enter phone number">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="address">Address<span class="text-danger">*</span></label>
                                <textarea name="address" id="address" class="form-control" placeholder="Enter Full Address" style="height: 100px;">@isset($data->address){{$data->address}}@endisset</textarea>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary"><i
                                    class="far fa-check-square pe-2"></i>Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
    
@endsection
<!--**********************************
   Content body start
   ***********************************-->

<!--**********************************
    Content body end
    ***********************************-->
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
        integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#generalform").validate({
            rules: {
                site_name: {
                    required: true
                },
                site_title: {
                    required: true
                },
                company:{
                    required:true
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    number: true,
                    minlength:10
                }
            },
            messages: {
                site_name:"Site name is required",
                site_title:"site title is required",
                company:"Company name is required",
                email: "Email is required",
                phone: {
                    required: "Phone number is required",
                    minlength: "Phone number must be at least 10 digits"
                }
            },
        });
    </script>
@endpush



</script>
