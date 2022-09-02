
@extends("admin_dashboard.layouts.app")

@section("style")
<link href="{{ asset('admin_dashboard_assets/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_dashboard_assets/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_dashboard_assets/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
<script src="https://cdn.tiny.cloud/1/itkudnxflets7aq195i54lyxfefuod07binnn1mk0ot3a12o/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
    
    @section("wrapper")
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Users</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Users</li>
                        </ol>
                    </nav>
                </div>
            
            </div>
            <!--end breadcrumb-->
          
            <div class="card">
              <div class="card-body p-4">
                  <h5 class="card-title">Add New User</h5>
                  <hr/>
                  <form method='POST' action="{{ route('admin.users.store') }}" enctype='multipart/form-data'>
                  @csrf
                  
                   <div class="form-body mt-4">
                    <div class="row">
                       <div class="col-lg-12">
                       <div class="border border-3 p-4 rounded"> 
                          <div class="mb-3">
                            <label for="inputProductTitle" class="form-label">User Role</label>
                            <div class="card">
                            <div class="card-body">
                                <div class="border p-3 rounded">
                                <div class="mb-3">
                                    <label for="input_name" class="form-label">User Name</label>
                                    <input type='text' class="form-control" name="name" id="name" rows="8" value="{{ old('name') }}">
                                    @error('name')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror  
                                </div>
                                <div class="mb-3">
                                    <label for="input_email" class="form-label">User Email</label>
                                    <input type='email' class="form-control" name="email" id="email" rows="8" value="{{ old('email') }}">
                                    @error('email')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror  
                                </div>
                                <div class="mb-3">
                                    <label for="input_password" class="form-label">Password</label>
                                    <input class="form-control" type='password' name="password" id="password" rows="8">
                                    @error('password')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror  
                                </div>
                                <div class="mb-3">
                                     <div class="mb-3">
                                    <label for="input_image" class="form-label">Photo</label>
                                    <input class="form-control" type='file' name="image" id="image" rows="8">
                                    @error('photo')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror  
                                </div>
                                <div class="mb-3">
                                    <select required name='role_id' class="single-select">
                                        @foreach($roles as $key => $role)
                                        <option value="{{ $key }}">{{ $role }}</option>
                                        @endforeach
                                    </select>

                                    @error('role_id')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>
                                </div>
                            </div>            
                          </div>
                        </div>
                          <button class='btn btn-primary' type='submit'>Add User</button>
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

<script src="{{  asset('admin_dashboard_assets/assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{  asset('admin_dashboard_assets/assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script>
    
    $(document).ready(function () {
        /* $('#image-uploadify').imageuploadify(); */
    })

    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
    $('.multiple-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });

/* tinymce.init({
  selector: 'textarea#body',
  plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",

  tinycomments_mode: 'embedded',
  tinycomments_author: 'Ahmed',
  image_title:true,
  automatic_uploads:true,

   


  images_upload_handler: function(blobinfo,success,failure){
   
    var xhr, formData, _token;
    
    
     formData = new FormData();
    
     _token = $("input[name='_token']").val()

     xhr = new XMLHttpRequest();
    
    xhr.open('post',"{{ route('admin.upload_tinymce_image') }}");

    xhr.onload =()=>{
        console.log(xhr.status)
    }

    formData.append('_token', _token)
   
    formData.append('file', blobinfo.blob(), blobinfo.filename())
    xhr.send(formData)
  } 
}); */
const image_upload_handler_callback = (blobInfo, status) => new Promise((resolve, reject) => {

let formData = new FormData();    
let _token = $("input[name='_token']").val()
const xhr = new XMLHttpRequest();

xhr.open('post',"{{ route('admin.upload_tinymce_image') }}");


xhr.onload =()=>{
    
    if(xhr.status !== 200){
        reject('HTTP Error: ' + xhr.status);
        return;
    }
    const json = JSON.parse(xhr.responseText);
    if (!json || typeof json.location != 'string') {
        reject('Invalid JSON: ' + xhr.responseText);
        return;
    }

    resolve(json.location);
}

formData.append('_token', _token)
formData.append('file', blobInfo.blob(), blobInfo.filename());

xhr.send(formData); 
});
tinymce.init({
selector: '#body',
plugins: 'image',
toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | image',

// without images_upload_url set, Upload tab won't show up


// override default upload handler to simulate successful upload
images_upload_handler: image_upload_handler_callback
});

setTimeout(()=>{
$('.general-message').fadeOut();
},5000)
</script>
@endsection