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
                                <a href="lead-file.php" class="nav-link active"><i class="la la-user me-2"></i> Documents</a>
                            </li>
                        </ul>



                    </div>
                    <div class="card h-auto">
                        <div class="card-header">
                            <h4 class="card-title">Documents</h4>
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#documentModal"
                                class="btn btn-primary btn-md"><i class="fas fa-plus"></i> Add New</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table display table-bordered ">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="100">#</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th width="200">Action</th>
                                        </tr>
                                    </thead>
                                    <?php $i=1;?>
                                    <tbody>
                                        @foreach ($documents as $document)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$document->name}}</td>
                                            <td>{{$document->type}}</td>
                                            <td>
                                                <a href="" class="btn btn-secondary btn-sm">View</a>
                                                <a href="" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>


    <div class="modal fade " id="documentModal" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="post" action="{{route('adddocuments')}}">@csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Document</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <label class="form-label" for="document">Document Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter name ">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 mb-3">
                            <label class="form-label" for="document_type">Document Tyoe</label>
                            <select name="type" class="form-control">
                                <option value="VISA">Visa</option>
                                <option value="IETS">IETS</option>
                                <option value="PTE">PTE</option>
                            </select>

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
