@extends('master')
@section('main-content')
    <section class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center text-head">
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
                                <input type="text" class="form-control" value="{{$data->google_api_key}}" name="api_key" placeholder="Enter Api Key">

                            </div>
                            <div class="form-group mb-3">
                                <label for="publickey">Secret Key</label>
                                <input type="text" class="form-control" value="{{$data->google_api_secret}}" name="api_secret" placeholder="Enter Api Key">

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
                                <input type="text" class="form-control" value="{{$data->fb_api_key}}" name="api_key" placeholder="Enter Api Key">

                            </div>
                            <div class="form-group mb-3">
                                <label for="publickey">Secret Key</label>
                                <input type="text" class="form-control" value="{{$data->fb_api_secret}}" name="api_secret" placeholder="Enter Api Key">

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
                                <input type="text" class="form-control" value="{{$data->justdial_api_key}}" name="api_key" placeholder="Enter Api Key">

                            </div>
                            <div class="form-group mb-3">
                                <label for="publickey">Secret Key</label>
                                <input type="text" class="form-control" value="{{$data->justdial_api_secret}}" name="api_secret" placeholder="Enter Api Key">

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
                                <input type="text" class="form-control" value="{{$data->instagram_api_key}}" name="api_key" placeholder="Enter Api Key">

                            </div>
                            <div class="form-group mb-3">
                                <label for="publickey">Secret Key</label>
                                <input type="text" class="form-control" value="{{$data->instagram_api_secret}}" name="api_secret" placeholder="Enter Api Key">

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
            api_key: {
                required: true
            },
            api_secret: {
                required: true,
            }
            // fb_api_key: {
            //     required: true
            // },
            // fb_api_secret: {
            //     required: true,
            // },
            // justdial_api_key: {
            //     required: true
            // },
            // justdial_api_secret: {
            //     required: true,
            // },
            // instagram_api_key: {
            //     required: true
            // },
            // instagram_api_secret: {
            //     required: true,
            // },
        },
        messages: {
            api_key: "Api Key required",
            api_secret: "API Secret required",
            // fb_api_key: "Api Key required",
            // fb_api_secret: "API Secret required.",
            // justdial_api_key: "Api Key required",
            // justdial_api_secret: "API Secret required."
            // instagram_api_key: "Api Key required",
            // instagram_api_secret: "API Secret required."
        },
    });
   })
    </script>
@endpush

