@props(['url' => '', 'title' => '', ])
<section class="bg-img pt-150 pb-20 sub-pages" data-overlay="7">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="text-center">
          <h2 class="page-title text-white">{{ $title }}</h2>
          <ol class="breadcrumb bg-transparent justify-content-center">
            <li class="breadcrumb-item"><a href="#" class="text-white-50"><i class="mdi mdi-home-outline"></i></a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">{{ $title }}</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>
