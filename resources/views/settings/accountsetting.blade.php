@extends("master")
@section('main-content')
<section class="content-body">
    <!-- row -->
    <div class="container-fluid">
       <div class="d-flex flex-wrap align-items-center text-head">
          <h2 class="mb-3 me-auto">Account Settings</h2>
         
       </div>
       <div class="row ">
       <div class="col-lg-12 col-md-12 col-12">
             <form class="card">
                
                <div class="card-body">
             
                                <div class="form-group mb-3">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" name="firstname" placeholder="Enter first name">
                                </div>
                          
                                <div class="form-group mb-3">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" name="lastname" placeholder="Enter last name">
                                </div>
                           
                                <div class="form-group mb-3">
                                    <label for="lastname">Email</label>
                                    <input type="email" class="form-control" name="lastname" placeholder="Enter email address">
                                </div>
                          
                                <div class="form-group mb-3">
                                    <label for="phonenumber">Mobile Number</label>
                                    <input type="tel" class="form-control" name="phonenumber" placeholder="Enter mobile number">
                                </div>
                          
 
                                                        
                           
                                <div class="form-group mb-3">
                                    <label for="gender">Gender</label>
                                   <select name="gender" id="" class="form-control">
                                    
                                        <option value="">Male</option>
                                        <option value="">Female</option>
                                        <option value="">Others</option>
                    
                                   </select>
                                </div>
                               <div class="form-group">
                               <label class="" for="customer_image">Profile Image</label>
                                <div class="input-group">
                                    <div class="form-file">
                                        <input type="file" name="customer_image" id="customer_image" accept="image/*" class="form-file-input form-control" onchange="previewImage(this)">
                                    </div>
                                </div>
                               </div>
                             
                            
                      
 
                            
                       
                </div>
                <div class="card-footer">
                   <div class="text-end">
                      <button type="submit" class="btn btn-primary"><i class="far fa-check-square pe-2"></i>Save</button>
                   </div>
                </div>
             </form>
          </div>
      
       </div>
    </div>
 </section>
@endsection