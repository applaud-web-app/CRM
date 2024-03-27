@extends('master')<!--**********************************
    Content body start
    ***********************************-->
    @section('main-content')
        <section class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class=" d-flex flex-wrap align-items-center text-head">
            <a class="backbtn mb-3 mx-2" href="{{url()->previous()}}"><i class="fa fa-arrow-left"></i></a>
            <h2 class="mb-3 me-auto">Rating Settings</h2>

        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table class="table display table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>Rating Name</th>
                                        <th>Percentage</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @php
                                    $i=1;
                                 @endphp
                                 @foreach ($ratings as $rating)
                                 <tr>
                                     <td>{{$i}}</td>
                                     <td>{{$rating->rating_name}}</td>
                                     <td>{{$rating->minimum}}% - {{$rating->maximum}}%</td>
                                     <td>
                                       <button class="btn btn-primary btn-sm edit-rating" data-bs-toggle="modal" data-bs-target="#ratingModel"
                                       data-rating-name="{{$rating->rating_name}}"
                                       data-minimum="{{$rating->minimum}}"
                                       data-maximum="{{$rating->maximum}}">
                                   <i class="fas fa-edit"></i> Edit
                               </button>
                                     </td>
                                 </tr>
                                 @php $i++; @endphp
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
<div class="modal fade" id="ratingModel" tabindex="-1" aria-labelledby="ratingModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('saveratings') }}" id="ratingform">@csrf
                <div class="modal-header">
                    <h4 class="modal-title">Percentage Ratings</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-label" for="rating">Rating Name </label>
                        <input type="text" class="form-control" name="rating_name" placeholder="Enter Rating">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="minimum">Minimum </label>
                        <input type="number" class="form-control" name="minimum" placeholder="Enter Minimum">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="maximum">Maximum </label>
                        <input type="number" class="form-control" name="maximum" placeholder="Enter Maximum">
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



<!--**********************************
    Content body end
    ***********************************-->
@if (session()->get('success'))
    <script>
        Swal.fire({
            title: "Done",
            text: {{session()->get('success')}},
            icon: "success"
        });
    </script>
@endif
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
        integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#ratingform").validate({
            rules: {
                rating: {
                    required: true
                },
                maximum: {
                    required: true,
                    min: 0,
                    max: 100,
                    number: true
                },
                minimum: {
                    required: true,
                    min: 0,
                    max: 100,
                    number: true
                },
            },
            messages: {
                rating: "Rating name is required",
                maximum: {
                    required: "Maximum rating limit",
                    max: "maximum rating cannot be more than 100"
                },
                minimum: {
                    required: "minimum rating is required",
                    min: "minimum rating cannot be less than 0"
                }
            }
        });
    </script>
    <script>
      $(document).ready(function() {
          $('.edit-rating').click(function() {
              var ratingName = $(this).data('rating-name');
              var minimum = $(this).data('minimum');
              var maximum = $(this).data('maximum');
  
              $('#ratingform input[name="rating_name"]').val(ratingName);
              $('#ratingform input[name="minimum"]').val(minimum);
              $('#ratingform input[name="maximum"]').val(maximum);
          });
      });
  </script>
  
  
@endpush
