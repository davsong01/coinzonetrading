@extends('layouts.frontapp')
@section('body')
<!---page Title --->
<section class="bg-img pt-150 pb-20 sub-pages" data-overlay="7">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2 class="page-title text-white">About us</h2>
                    <ol class="breadcrumb bg-transparent justify-content-center">
                        <li class="breadcrumb-item"><a href="/" class="text-white-50"><i
                                    class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">About us</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page content -->
<section class="py-50 bg-white" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-12 text-center">
                <h1 class="mb-15">Get in touch with us.<br>We are available to help.</h1>				
                <hr class="w-100 bg-primary">
            </div>
        </div>
        <div class="row justify-content-center mt-30">
            <div class="col-lg-6 col-12">   
                <form action="{{ route('testsubmit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="contact-form form-border clearfix">
                        <div class="form-group">
                            <input id="name" type="text" placeholder="Name*" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Email*" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Phone*" class="form-control" name="phone">
                        </div>
                         <div class="form-group">
                            <label for="">Upload image</label>
                            <input type="file" placeholder="file" class="form-control" name="file">
                        </div>
                        <div class="form-group textarea">
                            <textarea class="form-control input-message" placeholder="Comment*" rows="7" name="message"></textarea>
                        </div>
                        <div class="form-group submit-button">
                            <button id="submit" name="submit" type="submit" value="Send" class="btn btn-primary"> Send your message </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
