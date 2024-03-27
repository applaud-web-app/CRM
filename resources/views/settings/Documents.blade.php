@extends('master')
@section('main-content')
    <section class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center text-head">
                <a class="backbtn mb-3 mx-2" href="{{url()->previous()}}"><i class="fa fa-arrow-left"></i></a>
                <h2 class="mb-3 me-auto">Documents Settings</h2>

            </div>
            <div class="row ">
                <div class="col-lg-12 col-md-12 col-12">
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
                                            <th>Category</th>
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
                                            <td>{{$document->subcategory}}</td>
                                            <td>
                                                <a href="{{route('delete-category',$document->id)}}" class="btn btn-danger btn-sm delete">Delete</a>
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
                <form method="post" action="{{route('adddocuments')}}" id="addDoc">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Document</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">

                       <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="interested">Interested</label>
                                @php
                                    $getInterestType = array_keys(\Common::immigration());
                                @endphp
                                <select name="interested" id="interested" onchange="getImmigrationLists(this)"
                                    class="form-control" required>
                                    <option value="">Select Option</option>
                                    @foreach ($getInterestType as $item)
                                        <option value="{{strtoupper($item)}}" >{{strtoupper($item)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-4 mb-3">
                            <div class="form-group" id="interestType">
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-12 mb-3 d-none" id="documentNum">
                            <label class="form-label" for="document_type">No. Of Document</label>
                            <input type="number" class="form-control" name="field_count" min="1" max="10" placeholder="Enter Number of Document" id="fieldnum" required>
                        </div>

                        <div id="dynamicFieldsContainer">

                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="far fa-check-square"></i> Submit</button>
                    </div>
                </form>
                </div>
                    
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $('#addDoc').validate();
</script>



<script>
    function getImmigrationLists(selectElement) {
            var immigration_type = selectElement.value;
            $.ajax({
                url: "{{ route('loadimmigrationtype') }}",
                type: "POST",
                data: {
                    list_type: immigration_type,
                    _token: "{{ csrf_token() }}",
                },
                datatype: JSON,
                success: function(response) {
                    console.log(response);
                    let html = `<label class="form-label" for="">Type of Immigration</label>
                    <select id="type_of_immigration" name="type_of_immigration" class="form-control" required>
                        <option value="">Select</option>`;
                    response.forEach(function(ele) {
                        html += `<option value="${ele.toUpperCase()}">${ele.toUpperCase()}</option>`;
                    });
                    html += `</select>`
                    $('#interestType').html(html);
                    $('#documentNum').attr('style','display:block !important');
                }
            });
        }
</script>
<script>
    document.getElementById('fieldnum').addEventListener('input', function() {
        var numDocuments = parseInt(this.value);

        if(numDocuments > 10){
            return null;
        }
        var dynamicFieldsContainer = document.getElementById('dynamicFieldsContainer');
        dynamicFieldsContainer.innerHTML = ''; // Clear previous fields
        
        for (var i = 0; i < numDocuments; i++) {
            var documentNameInput = document.createElement('input');
            documentNameInput.setAttribute('type', 'text');
            documentNameInput.setAttribute('class', 'form-control');
            documentNameInput.setAttribute('required', 'required');
            documentNameInput.setAttribute('name', 'documents[' + i + '][name]');
            documentNameInput.setAttribute('placeholder', 'Enter name for document ' + (i + 1));
            
            var fieldTypeSelect = document.createElement('select');
            fieldTypeSelect.setAttribute('class', 'form-control');
            fieldTypeSelect.setAttribute('required', 'required');
            fieldTypeSelect.setAttribute('name', 'documents[' + i + '][field_type]');
            
            // var inputOption = document.createElement('option');
            // inputOption.setAttribute('value', 'input');
            // inputOption.textContent = 'Input';
            
            // var fileOption = document.createElement('option');
            // fileOption.setAttribute('value', 'file');
            // fileOption.textContent = 'File';
            
            // fieldTypeSelect.appendChild(inputOption);
            // fieldTypeSelect.appendChild(fileOption);
            
            
            var fieldContainer = document.createElement('div');
            fieldContainer.setAttribute('class', 'd-flex align-items-center mb-3');
            fieldContainer.appendChild(documentNameInput);
            // fieldContainer.appendChild(fieldTypeSelect);
            
            dynamicFieldsContainer.appendChild(fieldContainer);
        }
    });

    //delete confirmation
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        var deleteUrl = $(this).attr('href');
        var confirmDelete = confirm("Are you sure you want to delete this Lead?");
        if (confirmDelete) {
            window.location.href = deleteUrl;
        }
    });
</script>

@endpush