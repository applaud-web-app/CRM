@extends('master')
@section('main-content')
    <!--**********************************
       Content body start
       ***********************************-->
    <section class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center text-head">
                <h2 class="mb-3 me-auto">Roles</h2>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Roles</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="card-header">
                                <h4 class="card-title">Roles and Permissions</h4>
                                {{-- <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addpermission"
                                    class="btn btn-primary btn-md"><i class="fas fa-plus"></i> Add New</a> --}}
                            </div>
                            <div class="table-responsive ">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Role</th>
                                        <th>Permissions</th>
                                        <th>Monthly Target</th>
                                        <th>Deduction Per Rejection</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @isset($roles)
                                            @foreach ($roles as $item)
                                                <tr>
                                                    <td>{{ ++$loop->index }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>
                                                        @foreach ($item->permissions as $permission)
                                                        <li class=" badge badge-warning light">{{ $permission->name }}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $item->target }}</td>
                                                    <td>{{ $item->deduction }}%</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0);" data-target="{{$item->target}}" data-deduction="{{$item->deduction}}" data-id="{{$item->id}}" data-bs-toggle="modal" data-bs-target="#rolesModal" class="btn btn-primary btn-sm ms-2 editRole"><i class="far fa-pencil"></i></a></div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--**********************************
          Content body end
    ***********************************-->
    <div class="modal fade" id="rolesModal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('updateRole')}}" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Manager</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label" for="target">Target <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="target" id="target" placeholder="Enter target" required>
                            <input type="hidden" class="form-control" name="role" id="role" value="" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="deduction">Deduction % <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="deduction" id="deduction" placeholder="Enter Deduction" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="far fa-check-square"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Add permissions --}}
    {{-- <div class="modal fade" id="addpermission" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('updateRole')}}" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Manager</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label" for="target">Target <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="target" placeholder="Enter target" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="deduction">Deduction % <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="deduction" placeholder="Enter Deduction" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="far fa-check-square"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
@push('scripts')
    <script>
        $("#target").validate();
    </script>
    <script>
        $(document).ready(function(){
           $(document).on('click','.editRole',function(){
                $roleId = $(this).data('id');
                $targetVal = $(this).data('target');
                $deductionVal = $(this).data('deduction');
                $('#role').val($roleId);
                $('#target').val($targetVal);
                $('#deduction').val($deductionVal);
           })
        });
    </script>
@endpush
