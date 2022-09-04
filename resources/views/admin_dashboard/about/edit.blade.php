
@extends("admin_dashboard.layouts.app")
@section("style")
	
    <script src="https://cdn.tiny.cloud/1/itkudnxflets7aq195i54lyxfefuod07binnn1mk0ot3a12o/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
    @section("wrapper")
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">About</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">About Page</li>
                        </ol>
                    </nav>
                </div>
            
            </div>
            <!--end breadcrumb-->
          
            <div class="card">
              <div class="card-body p-4">
                  <h5 class="card-title">Edit</h5>
                  <hr/>
                  <form method='POST' action="{{ route('admin.about.update') }}" enctype='multipart/form-data'>
                  @csrf
                  
                   <div class="form-body mt-4">
                    <div class="row">
                       <div class="col-lg-12">
                       <div class="border border-3 p-4 rounded"> 
                          <div class="mb-3">
                            <label for="inputProductTitle" class="form-label">Edit About Page</label>
                            <div class="card">
                            <div class="card-body">
                                <div class="border p-3 rounded">
                                <div class="mb-3">
                                    <label for="input_name" class="form-label">Top Text</label>
                                    <textarea class="form-control" name="first_text" id="first_text" rows="8" >{{ $setting->first_text  }}</textarea>
                                    @error('first_text')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror  
                                </div>
                                <div class="mb-3">
                                    <label for="input_email" class="form-label">Bottom Text</label>
                                    <textarea class="form-control" name="second_text" id="second_text" rows="8">{{ $setting->second_text  }}</textarea>
                                    @error('second_text')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror  
                                </div>
                               

                                <div class='row'>
                                    <div class='col-md-8'>

                                        <div class="mb-3">
                                            <label for="input_image" class="form-label">First Photo</label>
                                            <input class="form-control" type='file' name="first_image" id="image" rows="8">
                                            @error('first_image')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror  
                                        </div>
                                        <div class='row'>
                                        <div class='col-sm-4'>
                                             <img width='200px'src="{{ asset($setting->first_image) }}">
                                        </div>
                                     </div>
                                   </div>  
                                </div>
                                <div class='row'>
                                    <div class='col-md-8'>

                                        <div class="mb-3">
                                            <label for="input_image" class="form-label">Second Photo</label>
                                            <input class="form-control" type='file' name="second_image" id="image" rows="8">
                                            @error('first_image')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror  
                                        </div>
                                            <div class='row'>
                                            <div class='col-sm-4'>
                                                <img width='200px'src="{{ asset($setting->second_image) }}">
                                            </div>
                                        </div>
                                    </div>  
                                    </div>
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">About Our Mission</label>
                                            <textarea class="form-control" name="our_mission" id="our_mission" rows="8">{{ old('about_our_mission',$setting->about_our_mission) }}</textarea>
                                            @error('our_mission')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror  
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">About Our Vision</label>
                                            <textarea class="form-control" name="our_vision" id="our_vision" rows="8">{{ old('about_our_mission',$setting->about_our_vision) }}</textarea>
                                            @error('our_vision')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror  
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">About Services</label>
                                            <textarea class="form-control" name="about_services" id="services" rows="8">{{ old('about_services',$setting->about_services) }}</textarea>
                                            @error('about_services')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror  
                                        </div>
                                     </div>
                                   </div>  
                                </div>
                                
                                </div>
                            </div>            
                          </div>
                        </div>
                          <button class='btn btn-primary' type='submit'>Update</button>
                         </a> 
                       </div>
                      </div>
                     </div>
                    </div>
                 </div>    
                </form> 
                
              </div>
            </div>
        </div>


        </div>
    </div>
    <!--end page wrapper -->
    @endsection
    @section("script")
    <script>


    
let initTimyMce =(id)=>{
  tinymce.init({

    selector: '#'+id,
    plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
      toolbar_mode: 'floating',
  })
    
};

initTimyMce('our_mission')
initTimyMce('our_vision') 
initTimyMce('services')  

setTimeout(()=>{
    $('.general-message').fadeOut();
},5000)
</script>
@endsection
