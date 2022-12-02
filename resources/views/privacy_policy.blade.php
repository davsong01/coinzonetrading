@extends('layouts.frontapp')
@section('css')
<style>
    .privacy-heading{
        margin-top: 10px;
    }
    h4, .h4, h5, .h5, h6, .h6{
        margin-top: 10px !important;
    }
</style>
@endsection
@section('body')
<!---page Title --->
<section class="bg-img pt-150 pb-20 sub-pages" data-overlay="7">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2 class="page-title text-white">Privacy Policy</h2>
                    <ol class="breadcrumb bg-transparent justify-content-center">
                        <li class="breadcrumb-item"><a href="/" class="text-white-50"><i
                                    class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Privacy Policy</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page content -->

<section class="py-50 bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 col-12">
				{!! $settings->privacy_policy !!}
            </div>
        </div>
    </div>
</section>

@endsection