@extends('master')
@section('main-content')
@push('style')
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}">
@endpush
    <section class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row ">

                <div class="col-lg-12 col-md-12 col-12">


                    <div class="custom-tab-1 bg-white mb-2 pt-1">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="backbtn nav-link" href="{{url()->previous()}}"><i class="fa fa-arrow-left"></i></a>
                               </li>
                            <li class="nav-item">
                                <a href="{{ route('viewLeaddata', $id) }}" class="nav-link "><i class="la la-home me-2"></i>
                                    Profile
                                    Details</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('addleaddocument', $id) }}" class="nav-link "><i
                                        class="la la-user me-2"></i> Documents</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link active"><i class="la la-phone me-2"></i> Follow
                                    Up</a>
                            </li>

                        </ul>



                    </div>
                    <div class="card h-auto">
                        <div class="card-header">
                            <h4 class="card-title">Follow Up</h4>
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#dealfollowupModal"
                                class="btn btn-primary btn-md"><i class="fas fa-plus"></i> Add New</a>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table display data-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                Serial No.
                                            </th>
                                            <th>Notes</th>
                                            <th>Next Follow Up</th>
                                            <th>Added By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>

                                                <td><span class="wspace-no"
                                                        class="text-primary">{{ $item->serial_id }}</span></td>
                                                <td class="wspace-no">

                                                    <span>{{$item->notes}}</span>
                                                </td>

                                                <td class="wspace-no"><span>{{$item->next_followup}}</span></td>
                                                <td class="wspace-no">{{$item->added_by}}</td>

                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editfollowupmodal"
                                                        data-id="{{$item->id}}"
                                                        data-note="{{$item->notes}}"
                                                        data-date="{{$item->next_followup}}"
                                                            class="btn btn-primary btn-sm ms-2 edit-followup"><i
                                                                class="far fa-pencil"></i></a>
                                                        
                                                                <a href="{{route('deletefollowup',$item->id)}}"
                                                            class="btn btn-danger  btn-sm ms-2 "><i
                                                                class="far fa-trash-alt"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="card-footer text-end">
                            <div>
                               <a href="{{route('applyapproval',$id)}}" class="btn btn-secondary  "><i class="far fa-check-circle me-2"></i>Send For Approval</a>
                          
                            </div>
                         </div>
                    </div>
                </div>
            </div>
    </section>

    <div class="modal fade " id="dealfollowupModal" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{route('createfollowup',$id)}}">@csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Follow Up</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <label class="form-label" for="title">Follow Up Note</label>
                            <input type="text" class="form-control" name="notes" placeholder="Enter title ">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="date">Next Follow Up</label>
                            <input type="datetime-local" min="{{ date('Y-m-d\TH:i') }}" class="form-control" name="next_followup" placeholder="Enter date ">
                        </div>


                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary"><i class="far fa-check-square"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- edit modal --}}
    <div class="modal fade" id="editfollowupmodal" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" id="editfollow" action="{{route('editfollowup')}}">@csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Follow Up</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <label class="form-label" for="title">Follow Up Note</label>
                            <input type="text" class="form-control" name="notes" placeholder="Enter title ">
                        </div>
                        <input type="text" name="id" hidden>
                        <div class="form-group mb-3">
                            <label class="form-label" for="date">Next Follow Up</label>
                            <input type="datetime-local" min="{{ date('Y-m-d\TH:i') }}" class="form-control" name="next_followup" placeholder="Enter date ">
                        </div>


                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary"><i class="far fa-check-square"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>

<script>
    $("form").each(function() {
        $($(this)).validate({
            rules: {
                notes: {
                    required: true
                },
                next_followup: {
                    required: true
                },
            },
            messages: {
                notes: "Please enter some notes regarding followup.",
                next_followup: "Please select valid followup date."
            },
        });
    });
</script>

<script>
    $(document).on('click', '.edit-followup', function() {
            console.log("success");
            var id = $(this).data('id');
            var notes = $(this).data('note');
            var date = $(this).data('date');
            $('#editfollow input[name="notes"]').val(notes);
            $('#editfollow input[name="next_followup"]').val(date);
            $('#editfollow input[name="id"]').val(id);
        });       
</script>
@endpush