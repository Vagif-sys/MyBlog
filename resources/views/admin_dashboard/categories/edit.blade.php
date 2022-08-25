@extends("admin_dashboard.layouts.app")

    @section("wrapper")
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Category Edit</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Category Edit</li>
                        </ol>
                    </nav>
                </div>
            
            </div>
            <!--end breadcrumb-->
          
            <div class="card">
              <div class="card-body p-4">
                  <h5 class="card-title">Category Edit: {{ $category->name }}</h5>
                  <hr/>
                  <form method='POST' action="{{ route('admin.categories.update',$category) }}" enctype='multipart/form-data'>
                  @csrf
                  @method('PATCH')
                  
                   <div class="form-body mt-4">
                    <div class="row">
                       <div class="col-lg-12">
                       <div class="border border-3 p-4 rounded">
                        <div class="mb-3">
                            <label for="inputProductTitle" class="form-label">Post Title</label>
                            <input type="text" name='name' class="form-control" value='{{ old("name",$category->name) }}' placeholder="Enter  title">
                            @error('name')
                               <p class='text-danger'>{{ $message }}</p>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="inputProductTitle" class="form-label">Post Slug</label>
                            <input type="text" name='slug' class="form-control" value='{{ old("slug",$category->slug) }}' placeholder="Enter slug">
                            @error('slug')
                               <p class='text-danger'>{{ $message }}</p>
                            @enderror
                         </div>

                          <button class='btn btn-primary' type='submit'>Update Category</button>
                            
                          <a href="#" onclick="event.preventDefault(); document.getElementById('delete_category_{{ $category->id }}').submit();" onClick="return confirm('Are you sure?');" class="ms-3">
                          <button type='submit' class='btn btn-danger'>Delete Post</button>
                         </a> 
                        </div>
                       </div>
                    </form> 
                    <form id='delete_category_{{ $category->id }}' method='POST' action="{{ route('admin.categories.destroy',$category) }}">
                        @csrf
                        @method('DELETE')
                        
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
    $(document).ready(function () {
        /* $('#image-uploadify').imageuploadify(); */
    })

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