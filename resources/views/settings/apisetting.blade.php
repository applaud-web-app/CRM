@extends('master')
@section('main-content')
    <section class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center text-head">
                <a class="backbtn mb-3 mx-2" href="{{url()->previous()}}"><i class="fa fa-arrow-left"></i></a>
                <h2 class="mb-3 me-auto">API Settings</h2>

            </div>
            <div class="row ">
                <div class="col-lg-12 col-md-12 col-12">
                    <form class="card h-auto" method="POST" action="{{route('updategoogleapi')}}">
                        @csrf 
                        <div class="card-header">
                            <h4 class="card-title">Google API Key</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group mb-3">
                                <label for="publickey">Public Key</label>
                                <input type="text" class="form-control" value="@isset($data->google_api_key){{$data->google_api_key}} @endisset"
                                
                                name="google_api_key" placeholder="Enter Api Key">

                            </div>
                            <div class="form-group mb-3">
                                <label for="publickey">Secret Key</label>
                                <input type="text" class="form-control" value="@isset($data->google_api_secret){{$data->google_api_secret}} @endisset" name="google_api_secret" placeholder="Enter Api Key">

                            </div>




                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary"><i
                                        class="far fa-check-square pe-2"></i>Save</button>
                            </div>
                        </div>
                    </form>
                    <form class="card h-auto" method="POST" action="{{route('updatefbapi')}}" >
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title">Facebook API Key</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group mb-3">
                                <label for="publickey">Public Key</label>
                                <input type="text" class="form-control" value="@isset($data->fb_api_key){{$data->fb_api_key}} @endisset" name="fb_api_key" placeholder="Enter Api Key">

                            </div>
                            <div class="form-group mb-3">
                                <label for="publickey">Secret Key</label>
                                <input type="text" class="form-control" value="@isset($data->fb_api_secret){{$data->fb_api_secret}} @endisset" name="fb_api_secret" placeholder="Enter Api Key">

                            </div>




                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary"><i
                                        class="far fa-check-square pe-2"></i>Save</button>
                            </div>
                        </div>
                    </form>
                    <form class="card h-auto" method="POST" action="{{route('updatejustdialapi')}}">
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title">Justdial API Key</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group mb-3">
                                <label for="publickey">Public Key</label>
                                <input type="text" class="form-control" value="@isset($data->justdial_api_key){{$data->justdial_api_key}} @endisset" name="justdial_api_key" placeholder="Enter Api Key">

                            </div>
                            <div class="form-group mb-3">
                                <label for="publickey">Secret Key</label>
                                <input type="text" class="form-control" value="@isset($data->justdial_api_secret){{$data->justdial_api_secret}} @endisset" name="justdial_api_secret" placeholder="Enter Api Key">

                            </div>




                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary"><i
                                        class="far fa-check-square pe-2"></i>Save</button>
                            </div>
                        </div>
                    </form>
                    <form class="card h-auto" method="POST" action="{{route('updateinstagramapi')}}">
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title">Instagram API Key</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group mb-3">
                                <label for="publickey">Public Key</label>
                                <input type="text" class="form-control" value="@isset($data->instagram_api_key){{$data->instagram_api_key}} @endisset" name="instagram_api_key" placeholder="Enter Api Key">

                            </div>
                            <div class="form-group mb-3">
                                <label for="publickey">Secret Key</label>
                                <input type="text" class="form-control" value="@isset($data->instagram_api_secret){{$data->instagram_api_secret}} @endisset" name="instagram_api_secret" placeholder="Enter Api Key">

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
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
        integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
       $("form").each(function(){
    $($(this)).validate({
        rules: {
            instagram_api_key: {
                required: true
            },
            instagram_api_secret: {
                required: true,
            },
            justdial_api_key: {
                required: true
            },
            justdial_api_secret: {
                required: true,
            },
            fb_api_key: {
                required: true
            },
            fb_api_secret: {
                required: true,
            },
            google_api_key: {
                required: true
            },
            google_api_secret: {
                required: true,
            }
        },
        messages: {
            api_key: "Api Key required",
            api_secret: "API Secret required",
        },
    });
   })
    </script>
@endpush

