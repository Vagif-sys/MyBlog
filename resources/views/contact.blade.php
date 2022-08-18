@extends('main_layouts.master')

@section('title', 'MyBlog | Contact')

@section('content')

<div class=' global-message info d-none'></div>
<div class="colorlib-contact">
    <div class="container">
        <div class="row row-pb-md">
            <div class="col-md-12 animate-box">
                <h2>Contact Information</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-info-wrap-flex">
                            <div class="con-info">
                                <p><span><i class="icon-location-2"></i></span> 198 West 21th Street, <br> Suite 721 New York NY 10016</p>
                            </div>
                            <div class="con-info">
                                <p><span><i class="icon-phone3"></i></span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
                            </div>
                            <div class="con-info">
                                <p><span><i class="icon-paperplane"></i></span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                            </div>
                            <div class="con-info">
                                <p><span><i class="icon-globe"></i></span> <a href="#">yourwebsite.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Message Us</h2>
            </div>
            
            <div class="col-md-6">
                <form onsubmit='return false' autocomplete='off' method='POST'>
                    @csrf
                    <div class="row form-group">
                        <div class="col-md-6">
                            <x-blog.form.input value='{{ old("firstName") }}' placeholder='Your firstname' name='firstName'/>
                    </div>
                    <small class='error text-dager firstName'></small>
                    <div class="col-md-6">
                          <x-blog.form.input value='{{ old("lastName") }}' placeholder='Your lastname' name='lastName'/>
                        </div>
                    </div>
                    <small class='error text-dager'></small>
                    <div class="row form-group">
                        <div class="col-md-12">
                           <x-blog.form.input value='{{ old("email") }}' placeholder='Your email' type='email' name='email'/>
                        </div>
                    </div>
                    <small class='error text-dager'></small>
                    <div class="row form-group">
                        <div class="col-md-12">
                        <x-blog.form.input value='{{ old("subject") }}' required='false' placeholder='Your Subject'  name='subject'/>
                        </div>
                    </div>
                    <small class='error text-dager'></small>
                    <div class="row form-group">
                        <div class="col-md-12">
                        <x-blog.form.textarea value="{{ old('message') }}" placeholder='Say something about us'  name='message'/>
                        </div>
                    </div>
                    <small class='error text-dager'></small>
                    <div class="form-group">
                        <input type="submit" value="Send Message" class="btn btn-primary send-message-btn">
                    </div>
                </form>
                <x-blog.message :status="'success'"/>		
            </div>
            <div class="col-md-6">
                <div id="map" class="colorlib-map"></div>
            </div>
        </div>
    </div>
</div>


<div id="colorlib-subscribe" class="subs-img" style="" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
                <h2>Subscribe Newsletter</h2>
                <p>Subscribe our newsletter and get latest update</p>
            </div>
        </div>
        <div class="row animate-box">
            <div class="col-md-6 col-md-offset-3">
                <div class="row">
                    <div class="col-md-12">
                    <form class="form-inline qbstp-header-subscribe">
                        <div class="col-three-forth">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email" placeholder="Enter your email">
                            </div>
                        </div>
                        <div class="col-one-third">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Subscribe Now</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
 <script>
   
 $(document).on('click','.send-message-btn',(e)=>{
     
    e.preventDefault()
    
    let $this = e.target
    
     let csrf_token =$($this).parents('form').find("input[name='_token']").val()
     let firstName = $($this).parents('form').find("input[name='firstName']").val()
     let lastName = $($this).parents('form').find("input[name='lastName']").val()
     let email = $($this).parents('form').find("input[name='email']").val()
     let subject = $($this).parents('form').find("input[name='subject']").val()
     let message = $($this).parents('form').find("textarea[name='message']").val()
 
     let formData = new FormData()
     formData.append('_token',csrf_token)
     formData.append('firstName',firstName)
     formData.append('lastName',lastName)
     formData.append('email',email)
     formData.append('subject',subject)
     formData.append('message',message)
    

     $.ajax({

        url:"{{ route('store') }}",
        data:formData,
        type:'POST',
        dataType:'JSON',
        processData:false,
        contentType:false,
        success:function(data){
          if(data.success){
            $('.global-message').addClass('alert, alert-info')
             $('.global-message').removeClass('d-none')
             $('.global-message').text(data.message)
             
             clearOut($($this).parents('form'),['firstName','lastName','email','subject','message'])
             setTimeout(()=>{

                $('.global-message').fadeOut()
             },5000)
          }else{
                
              for(const error in data.errors){
                 $("small."+error).text(data.errors['error'])
              }
          }
        }
     }) 
 
  })

 </script>

@endsection
