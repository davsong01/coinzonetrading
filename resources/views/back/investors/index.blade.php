<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{request()->routeIs('investors') ? 'Dashboard' : '' }}</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

	</section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


</div>
<!-- ./wrapper -->

</x-app-layout>
