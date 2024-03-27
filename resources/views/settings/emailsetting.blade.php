@extends('master')
@section('main-content')
<section class="content-body">
    <!-- row -->
    <div class="container-fluid">
       <div class="d-flex flex-wrap align-items-center text-head">
         <a class="backbtn mb-3 mx-2" href="{{url()->previous()}}"><i class="fa fa-arrow-left"></i></a>
          <h2 class="mb-3 me-auto">Email Settings</h2>
         
       </div>
       <div class="row ">
       <div class="col-lg-12 col-md-12 col-12">
             <form class="card" id="emailsetting" action="{{route('update_email_setting')}}" method="POST">
                @csrf
                <div class="card-body">
                   
                   <div class="mb-3">
                      <div class="form-group">
                         <label for="smtpHost">SMTP Host<span class="text-danger">*</span></label>
                         <input type="text" name="smtp_host" value="@isset($data->smtp_host){{$data->smtp_host}} @endisset" id="smtp_host" class="form-control">
                      </div>
                   </div>
                   <div class="mb-3">
                      <div class="form-group">
                         <label for="smtp_port">SMTP Port<span class="text-danger">*</span></label>
                         <input type="number" name="smtp_port" value="@isset($data->smtp_port){{$data->smtp_port}}@endisset" id="smtp_port" class="form-control" >
                      </div>
                   </div>
                   <div class="mb-3">
                      <div class="form-group">
                         <label for="smtp_security">SMTP Security</label>
                         <select name="smtp_security" class="form-control">
                           @php $smtp = NULL;@endphp
                           @isset($data->smtp_security)
                              @php $smtp = $data->smtp_security; @endphp
                           @endisset
                            <option value="TLS" @if($smtp === "TLS") selected @endif>TLS</option>
                            <option value="SSL" @if($smtp === "SSL") selected @endif>SSL</option>
                            
                         </select>
                      </div>
                   </div>
                   <div class="mb-3">
                      <div class="form-group">
                         <label for="smtpUsername">SMTP Username<span class="text-danger">*</span></label>
                         <input type="text" name="username" value="@isset($data->username){{$data->username}} @endisset" id="smtpUsername" class="form-control">
                      </div>
                   </div>
                   <div class="">
                      <div class="form-group">
                         <label for="smtpPassword">SMTP Password<span class="text-danger">*</span></label>
                         <input type="text" name="smtppassword" value="@isset($data->smtppassword){{$data->smtppassword}} @endisset" id="smtpPassword" class="form-control">
                      </div>
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
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
        integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#emailsetting").validate({
            rules: {
                smtp_host: {
                    required: true
                },
                smtp_port: {
                    required: true
                },
                smtp_security:{
                    required:true
                },
                username: {
                    required: true,
                },
                smtppassword: {
                    required: true,
                    minlength:8
                }
            },
            messages: {
                smtpHost:"SMTP HOST name is required",
                smtp_port:"SMTP PORT is required",
                smtp_security:"Select SMTP Security type",
                smtpUsername: "Username is required",
                password: {
                    required: "Password is required",
                    minlength: "Password must be at least 8 characteres long"
                }
            },
        });
    </script>
@endpush
