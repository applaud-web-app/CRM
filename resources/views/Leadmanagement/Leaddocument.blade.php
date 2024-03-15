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
                                <a href="{{route('followup',$id)}}" class="nav-link"><i class="la la-phone me-2"></i> Follow Up</a>
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
                                            <th>Status</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1; @endphp
                                        @foreach ($data->documents as $item)
                                            <tr>
                                                <td>{{++$loop->index}}</td>
                                                <td>{{ucfirst($item->name)}}</td>
                                                <td>{{$item->type}}</td>
                                                <td>
                                                    @if (in_array($item->id,array_keys($uplodedDocs)))
                                                    <span class="badge badge-success">Uploaded</span>
                                                    @else
                                                    <span class="badge badge-danger">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (in_array($item->id,array_keys($uplodedDocs)))
                                                        <a href="{{ asset('uploads/docs/'.$uplodedDocs[$item->id]) }}" target="_blank" class="btn btn-secondary btn-sm">View</a>
                                                        <a href="{{route('deletedocs',[$data->id,$item->id])}}" class="btn btn-danger btn-sm delete-doc">Delete</a>
                                                    @endif

                                                    
                                                    
                                                    @if (!in_array($item->id,array_keys($uplodedDocs)))
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#documentModal"
                                                        class="btn btn-primary btn-sm upload-files"
                                                        data-name="{{ $item->name }}"
                                                        data-type="{{ $item->type }}"
                                                        data-doc_id="{{$item->id}}"><i
                                                            class="fas fa-plus"></i>Upload</a>
                                                    @endif  
                                                </td>
                                            </tr>
                                            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer text-end">
                                <div>
                                   <a href="{{route('applyapproval',$data->id)}}" class="btn btn-secondary  "><i class="far fa-check-circle me-2"></i>Send For Approval</a>
                                </div>
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
                                <input type="text" class="form-control" disabled id="document_name_input" name="document_name"
                                    placeholder="Enter name ">
                                    <input type="hidden" id="document_name_hidden" name="document_name_hidden">
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

    {{-- check form validation --}}
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
            var allUploaded = true;
            $("tbody tr").each(function() {
                var status = $(this).find("td:nth-child(4) span").text().trim();
                if (status === "Pending") {
                    allUploaded = false;
                    return false;
                }
            });
            var $approvalButton = $("#sendForApprovalButton");
            if (allUploaded) {
                console.log('not allow');
                $approvalButton.addClass("disabled");
            } else {
                console.log('allow');
                $approvalButton.removeClass("disabled");
            }
            console.log('check');
        
    </script>

    {{-- //file upload model --}}
    <script>
        $(document).on('click', '.upload-files', function() {
            console.log("success");
            var document_name = $(this).data('name');
            var document_type = $(this).data('type');
            var document_id = $(this).data('doc_id');
            $('#uploadmodal input[name="document_name"]').val(document_name);
            $('#uploadmodal input[name="document_name_hidden"]').val(document_name);
            $('#uploadmodal input[name="document_type"]').val(document_type);
            $('#uploadmodal input[name="document_id"]').val(document_id);
        });
    </script>

    {{-- on click confirm prompt --}}
    <script>
        $(document).on('click', '.delete-doc', function(e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('href');
            var confirmDelete = confirm("Are you sure you want to delete this document?");
            if (confirmDelete) {
                window.location.href = deleteUrl;
            }
        });
    </script>
    
@endpush
