@extends("master")
@section('main-content')
<section class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class=" d-flex flex-wrap align-items-center text-head">
            <h2 class="mb-3 me-auto">Activities</h2>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Activities</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
            <div class="card overflow-hidden">
							<div class="card-body">
                                @foreach ($activities as $date=>$activitiesondate)
                                    
                                
								<div class="side-border">
									<h4 class="fs-20 "><span>{{$date}}</span></h4>
								</div>
                                @foreach ($activitiesondate as $activity)
                                <div class="latest">
									<div class="d-flex align-items-center flex-wrap mb-3">
										<span class="me-3">{{$activity->created_at->format('d-M-y')}}</span>
										<div class="enaergy">
											<span class="bg-primary"><i class="fas fa-bolt"></i></span>
										</div>
										<div class="ms-0 ms-sm-3">
											<h4 class="fs-16 font-w500 mb-0">{{$activity->done_by}}</h4>
											<p class="mb-0 fs-14">{{$activity->activity}}</p>
										</div>
									</div>
									
								</div> 
                                @endforeach
									
                                @endforeach
								{{-- <div class="latest">
									<div class="d-flex align-items-center flex-wrap mb-3">
										<span class="me-3">2m ago</span>
										<div class="enaergy">
											<span class="bg-secondary"><i class="fas fa-clock"></i></span>
										</div>
										<div class="ms-0 ms-sm-3">
											<h4 class="fs-16 font-w500 mb-0">[REMINDER] Due date of Highspeed Studios Projects te task will be coming</h4>
											<p class="mb-0 fs-14">Monday, June 31 2020</p>
										</div>
									</div>
									
								</div>	

								<div class="latest">
									<div class="d-flex align-items-center flex-wrap mb-3">
										<span class="me-3">2m ago</span>
										<div class="enaergy">
											<span class="bg-blue"><i class="fas fa-bolt"></i></span>
										</div>
										<div class="ms-0 ms-sm-3">
											<h4 class="fs-16 font-w500 mb-0">Olivia Johanna has created new task at Kleon Projects</h4>
											<p class="mb-0 fs-14">Monday, June 31 2020</p>
										</div>
									</div>
									
								</div>	

								<div class="latest">
									<div class="d-flex align-items-center flex-wrap mb-3">
										<span class="me-3">2m ago</span>
										<div class="enaergy">
											<span class="bg-primary"><i class="fas fa-bolt"></i></span>
										</div>
										<div class="ms-0 ms-sm-3">
											<h4 class="fs-16 font-w500 mb-0">Jackie Kun commented at Kleon Projects “Hei, please update the progress gu..</h4>
											<p class="mb-0 fs-14">Monday, June 31 2020</p>
										</div>
									</div>
									
								</div>	
								<div class="latest">
									<div class="d-flex align-items-center flex-wrap mb-3">
										<span class="me-3">2m ago</span>
										<div class="enaergy">
											<span class="bg-primary"><i class="fas fa-bolt"></i></span>
										</div>
										<div class="ms-0 ms-sm-3">
											<h4 class="fs-16 font-w500 mb-0">You has moved “Wireframing Landing Page” task to Done</h4>
											<p class="mb-0 fs-14">Monday, June 31 2020</p>
										</div>
									</div>
									
								</div>	
								<div class="side-border">
									<h4 class="fs-20 "><span>Yesterday</span></h4>
								</div>
								<div class="latest">
									<div class="d-flex align-items-center flex-wrap mb-3">
										<span class="me-3">2m ago</span>
										<div class="enaergy">
											<span class="bg-primary"><i class="fas fa-bolt"></i></span>
										</div>
										<div class="ms-0 ms-sm-3">
											<h4 class="fs-16 font-w500 mb-0">Jackie Kun mentioned you at Kleon Projects</h4>
											<p class="mb-0 fs-14">Monday, June 31 2020</p>
										</div>
									</div>
									
								</div>	
								<div class="latest">
									<div class="d-flex align-items-center flex-wrap mb-3">
										<span class="me-3">2m ago</span>
										<div class="enaergy">
											<span class="bg-secondary"><i class="fas fa-bolt"></i></span>
										</div>
										<div class="ms-0 ms-sm-3">
											<h4 class="fs-16 font-w500 mb-0">[REMINDER] Due date of Highspeed Studios Projects te task will be coming</h4>
											<p class="mb-0 fs-14">Monday, June 31 2020</p>
										</div>
									</div>
									
								</div>	
								<div class="latest">
									<div class="d-flex align-items-center flex-wrap mb-3">
										<span class="me-3">2m ago</span>
										<div class="enaergy">
											<span class="bg-blue"><i class="fas fa-bolt"></i></span>
										</div>
										<div class="ms-0 ms-sm-3">
											<h4 class="fs-16 font-w500 mb-0">You has moved “Wireframing Landing Page” task to Done</h4>
											<p class="mb-0 fs-14">Monday, June 31 2020</p>
										</div>
									</div>
									
								</div>	--}}
							</div> 
						</div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
    
@endpush