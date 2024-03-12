@extends('master')
@section('main-content')
    <section class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row ">

                <div class="col-lg-12 col-md-12 col-12">
                    <div class="custom-tab-1 bg-white mb-2 pt-1">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="{{ route('viewLeaddata', $id) }}" class="nav-link "><i class="la la-home me-2"></i>
                                    Profile
                                    Details</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link "><i class="la la-user me-2"></i> Documents</a>
                            </li>
                            <li class="nav-item">
                                <a href="lead-follow-up.php" class="nav-link"><i class="la la-phone me-2"></i> Follow Up</a>
                            </li>

                        </ul>



                    </div>
                    <div class="card h-auto">
                        <div class="card-header">
                            <h4 class="card-title">Documents</h4>
                            {{-- <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#documentModal"
                      class="btn btn-primary btn-md"><i class="fas fa-plus"></i> Add New</a> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table display table-bordered ">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="100">#</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Documents</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1; @endphp
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $item->document_name }}</td>
                                                <td>{{ $item->visa_type }}</td>
                                                <td>

                                                    @if (in_array($item->document_id,$documents))
                                                        {{"Uploaded"}}{{$item->document}}
                                                    @else
                                                    {{"NOT UPLOADED"}}
                                                    @endif
                                                </td>
                                                <td>
                                                    
                                                    <a href="{{ asset('documents/'.$item->document) }}" onclick="openImageInNewTab(event)" class="btn btn-secondary btn-sm">View</a>
                                                    <a href="" class="btn btn-danger btn-sm">Delete</a>
                                                    @if (!in_array($item->document_id,$documents))
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#documentModal"
                                                        class="btn btn-primary btn-sm upload-files"
                                                        data-name="{{ $item->document_name }}"
                                                        data-type="{{ $item->visa_type }}"
                                                        data-doc_id="{{$item->document_id}}"><i
                                                            class="fas fa-plus"></i>Upload</a>
                                                    @endif                                                    
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div>
                                <a href="javascript:void(0);" class="btn btn-secondary  "><i
                                        class="far fa-check-circle me-2"></i>Send For Approval</a>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <div class="modal fade " id="documentModal" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" id="uploadmodal" action="{{ route('postadddocuments', $id) }}" enctype="multipart/form-data">@csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Add Document</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group mb-3">
                                <label class="form-label" for="document" >Document Name</label>
                                <input type="text" class="form-control" id="document_name_input" name="document_name"
                                    placeholder="Enter name ">
                            </div>
                            <input type="text" hidden name="document_type">
                            <input type="text" name="document_id" hidden>
                            <div class="form-group">
                                <label class="" for="documentimage">Document Image</label>
                                <div class="input-group">
                                    <div class="form-file">
                                        <input type="file" name="document" id="document" accept="image/*"
                                            class="form-file-input form-control">
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary"><i class="far fa-check-square"></i>
                                Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $("form").each(function() {
            $($(this)).validate({
                rules: {
                    document_name: {
                        required: true
                    },
                    document: {
                        required: true
                    },
                },
                messages: {
                    document_name: "Please enter your name.",
                    image: "Please select your Documents."
                },
            });
        });
    </script>


    <script>
        $(document).on('click', '.upload-files', function() {
            console.log("success");
            var document_name = $(this).data('name');
            var document_type = $(this).data('type');
            var document_id = $(this).data('doc_id');
            $('#uploadmodal input[name="document_name"]').val(document_name);
            $('#uploadmodal input[name="document_type"]').val(document_type);
            $('#uploadmodal input[name="document_id"]').val(document_id);
        });
    </script>
    <!-- Your anchor tag -->


<script>
function openImageInNewTab(event) {
    event.preventDefault();
    var imageUrl = event.target.href; // Get the URL of the image from the anchor tag's href attribute
    window.open(imageUrl, '_blank'); // Open the image URL in a new tab
}
</script>

@endpush
