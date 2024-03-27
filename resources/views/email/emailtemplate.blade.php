@extends("master")
@section('main-content')
<section class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class=" d-flex flex-wrap align-items-center text-head">
            <a class="backbtn mb-3 mx-2" href="{{url()->previous()}}"><i class="fa fa-arrow-left"></i></a>
            <h2 class="mb-3 me-auto">Email Templates</h2>
        </div>
        <div class="row ">
            
    
            <div class="col-lg-12 col-md-12 col-12">
                <div class="card">
                    
                    <div class="card-body p-3">
                        <div class="table-responsive">
										<table class="table display">
											<thead>
												<tr>
													<th>Sr.No</th>
													<th>Template Name</th>
                                                    <th>Target</th>
													<th>Actions</th>
													
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>Birthday Wishes</td>
                                                    <td>Applicants, Employees</td>
													
                                                    <td><a href="{{route('previewbday')}}" class="btn btn-primary btn-sm"> <i class="fas fa-eye"></i></a></td>
												
												</tr>
                                                <tr>
													<td>2</td>
													<td>Work Anniversary</td>
													<td>Employees</td>
                                                    <td><a href="{{route('WorkAnniversary')}}" class="btn btn-primary btn-sm"> <i class="fas fa-eye"></i></a></td>
												
												</tr>
											
												
											</tbody>
										</table>
									
									</div>
                    </div>
                   
                </div>
            </div>
       </div>
    </div>
</section>
@endsection
