<x-app-layout>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $investor->user->name }}
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('investors.index') }}"><i class="fa fa-dashboard"></i>
                        Investors</a></li>
                <li class="breadcrumb-item active">{{ $investor->user->name }}</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="box box-default">
                        <div class="box-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile"
                                        role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span
                                            class="hidden-xs-down">Profile</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#packages"
                                        role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span
                                            class="hidden-xs-down">Packages</span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane active" id="profile" role="tabpanel">
                                    <div class="pad">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-5">
                                                <!-- Profile Image -->
                                                <div class="box bg-yellow bg-deathstar-dark">
                                                    <div class="box-body box-profile">
                                                        <img class="profile-user-img rounded img-fluid mx-auto d-block"
                                                            src="{{ asset(!empty($investor->profile_picture) ? $investor->profile_picture : 'back-end/images/user2-160x160.jpg') }}" alt="User Image">
                                                        <h2 class="profile-username text-center mb-0">
                                                            {{ $investor->user->name }}</h2>
                                                        <h4 class="text-center mt-0"><i
                                                                class="fa fa-envelope-o mr-10"></i>{{ $investor->user->email }}
                                                        </h4>
                                                        <div class="form-group row"> <br><br>
                                                            <form action="{{ route('replaceavatar') }}" method="post"
                                                                enctype="multipart/form-data" style="margin:auto">
                                                                @csrf
                                                                <label class="col-sm-12 col-form-label"
                                                                    style="text-align: center">Replace profile
                                                                    picture</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="file"
                                                                        name="profile_picture">
                                                                </div> <br>
                                                                <input type="hidden" name="investor_id" value="{{ $investor->id }}">
                                                                <div class="form-group row" style="text-align: center">
                                                                    <div class="col-sm-12">
                                                                        <button type="submit"
                                                                            class="btn btn-yellow">Replace</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                            <!-- /.col -->

                                            <div class="col-xl-8 col-lg-7">
                                                <div class="box box-solid bg-black">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">Personal details</h3>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <form action="{{ route('profile.store') }}"
                                                                    method="post" style="margin:auto">
                                                                    @csrf
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Full
                                                                            Name</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="name"
                                                                                type="text"
                                                                                value="{{ $investor->user->name ?? old('name') }}"
                                                                                placeholder="Full name" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Phone
                                                                            number</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="phone"
                                                                                type="text"
                                                                                value="{{ ($investor->user->role == 'admin' || $investor->user->role == 'staff') ? ($investor->user->admin->phone ?? old('phone') ): ($investor->user->investor->phone ?? old('phone')) }}"
                                                                                placeholder="Phone number" required>
                                                                        </div>
                                                                    </div>
                                                                  <input type="hidden" name="investor_id" value="{{ $investor->id }}">

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-12 col-form-label"></label>
                                                                        <div class="col-sm-12">
                                                                            <button type="submit"
                                                                                class="btn btn-yellow">Submit</button>
                                                                        </div>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                            <!-- /.col -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                                <div class="box box-solid bg-black">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">Wallet details</h3>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <?php 
                                                                  $types = app('App\Http\Controllers\Controller')->walletTypes();?>                
                                                                <form action="{{ route('profile.store') }}"
                                                                    method="post" style="margin:auto">
                                                                    @csrf
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Wallet
                                                                            Type</label>
                                                                        <div class="col-sm-9">
                                                                            <select name="wallet_type" id="wallet_type"
                                                                                class="form-control" required>
                                                                                <option value="">Select</option>
                                                                                @foreach($types as $type)
                                                                                <option value="{{ $type }}"
                                                                                    {{ $investor->wallet_type == $type ? 'selected' : '' }}>
                                                                                    {{ $type }}</option>
                                                                                @endforeach
                                                                            </select>

                                                                        </div>
                                                                    </div>
                                                                  <input type="hidden" name="investor_id" value="{{ $investor->id }}">

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Wallet
                                                                            address (Used for withdrawal
                                                                            requests)</label>
                                                                        <input type="hidden" name="investor_id" value="{{ $investor->id }}">
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" type="text"
                                                                                name="wallet_address"
                                                                                value="{{ $investor->wallet_addrress ?? old('wallet_address') }}"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-12 col-form-label"></label>
                                                                        <div class="col-sm-10">
                                                                            <button type="submit"
                                                                                class="btn btn-yellow">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.col -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>

                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane pad" id="packages" role="tabpanel">
                                    <div class="row">
                                      <div class="col-lg-12 col-12">         
                                      <div class="box">
                                        <div class="box-header with-border">
                                          <h4 class="box-title">{{ $investor->user->name }}'s Packages</h4> <a class="btn btn bg-blue">
                                            <i class="fa fa-plus"></i>
                                          </a>
                                          <p style="color:black">You can add or edit investor's packages here</p>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                          <div class="table-responsive">
                                            <table id="example1" class="table table-striped table-bordered no-margin">
                                              <thead>
                                              <tr class="bg-pale-dark">
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                @if(auth()->user()->admin->level == 'admin')
                                                <th>Actions</th>
                                                @endif
                                              </tr>
                                              </thead>
                                              <tbody>
                                                @php
                                                    $packages = App\Models\Package::all();
                                                    $userPackages =  App\Models\InvestorPackage::where(['investor_id' => $investor->user->id]);
                                                    $mypackages = $userPackages->get();
                                                  
                                                    $otherpackages = array_column($userPackages->get('package_id')->toArray(), 'package_id');
                                                    $otherpackages = $packages->whereNotIn('id', $otherpackages);
                                                   
                                                @endphp 
                                                @foreach($mypackages as $packages)
                                                <tr>
                                                  <td><p class="font-size-18 no-margin">{{ $packages->package->name }}</p></td>
                                                  <td><p class="no-margin" style="display:flex">
                                                    @if(!empty($packages->end_date) && $packages->end_date >= \Carbon\Carbon::today())
                                                      <button class="btn btn-info btn-sm" style="background:#dd3765;border:none" readonly>Active</button>
                                                    @endif
                                                    @if(!empty($packages->end_date) && $packages->end_date < \Carbon\Carbon::today())
                                                      <button class="btn btn-warning btn-sm" style="background:red"  id="status{{ $packages->id }}" readonly>Expired</button>
                                                    @endif
                                                    @if(empty($packages->end_date) && $packages->status == 'pending')
                                                        <button class="btn btn-warning btn-sm" id="status{{ $packages->id }}" readonly>Pending</button>
                                                        <a href="{{ route('payment.process', ['reference' => $packages->reference, 'middleware' => 'admin' ]) }}" class="btn btn-info btn-sm"> <i class="fa fa-refresh"></i> </a>
                                                    @endif
                                                    </p>
                                                  </td>
                                                
                                                  <td class="no-wrap">
                                                    @if(!empty($packages->start_date))
                                                      {{date("F dS, Y", strtotime($packages->start_date)). ','. date("h:ia", strtotime($packages->start_date))}}
                                                    @endif
                                                  </td>
                                                  <td>
                                                    @if(!empty($packages->end_date))
                                                      {{date("F dS, Y", strtotime($packages->end_date)). ','. date("h:ia", strtotime($packages->end_date))}}
                                                    @endif
                                                  </td>
                                                  <td>
                                                    @if(auth()->user()->admin->level == 'admin')
                                                    <a class="btn btn-block btn-info btn-xs" data-toggle="modal" data-target="#modal-right{{ $packages->id }}"> <i class="fa fa-eye"></i>Edit</a>
                                                          {{-- onclick="return confirm('Are you sure you want to delete this item?');" --}}
                                                     
                                                       <form onsubmit="return confirm('Are you sure you want to delete forever?');" action="{{ route('investorpackages.delete', $packages->id) }}" method="POST" style="margin-top: 5px;">
                                                        @csrf
                                                       
                                                        <button class="btn btn-block btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i>Delete</button>
                                                      </form> 
                                                      
                                                     
                                                      {{-- Edit modal --}}
                                                      @include('investors.investor-package-edit-modal')
                                                    @endif
                                                  </td>
                                                </tr>
                                                @endforeach
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                        <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->       
                                      </div>
                                    </div>	
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            </div>

            {{-- <!-- Basic Forms -->
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col">
              <form novalidate method="POST" action="{{ route('packages.update', ['package' => $package->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <h5>{{ __('Name') }}</h5>
                <div class="controls">
                    <input type="text" name="name" class="form-control" required
                        data-validation-required-message="This field is required"
                        value="{{ old('name') ?? $package->name }}">
                </div>
                <div class="form-control-feedback">@error('name') {{ $message }} @enderror</div>
            </div>
            <div class="form-group">
                <h5>{{ __('Short Description') }}</h5>
                <div class="controls">
                    <textarea name="short_description" id="short_description" class="form-control" required
                        placeholder="Short Description">{{ old('short_description') ?? $package->short_description }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <h5>{{ __('Amount') }}</h5>
                <div class="controls">
                    <input type="number" name="amount" class="form-control" required
                        data-validation-required-message="This field is required" min="0"
                        value="{{ old('amount') ?? $package->amount }}">
                </div>
                <div class="form-control-feedback">@error('amount'){{$message}}@enderror</div>
            </div>
            <div class="form-group">
                <h5>{{ __('Daily ROI') }}</h5>
                <div class="controls">
                    <input type="number" name="daily_roi" class="form-control" required
                        data-validation-required-message="This field is required"
                        value="{{ old('daily_roi') ?? $package->daily_roi }}">
                </div>
                <div class="form-control-feedback">@error('daily_roi') {{ $message }} @enderror</div>
            </div>
            <div class="form-group">
                <h5>{{ __('Monthly ROI') }}</h5>
                <div class="controls">
                    <input type="number" name="monthly_roi" class="form-control" required
                        data-validation-required-message="This field is required"
                        value="{{ old('monthly_roi') ?? $package->monthly_roi }}">
                </div>
                <div class="form-control-feedback">@error('monthly_roi') {{ $message }} @enderror</div>
            </div>
            <div class="form-group">
                <h5>{{ __('Validity Period') }}</h5>
                <div class="controls">
                    <input type="number" name="validity_period" class="form-control" required
                        data-validation-required-message="This field is required" min="1" max="31"
                        value="{{ old('validity_period') ?? $package->validity_period }}">
                </div>
                <div class="form-control-feedback">@error('validity_period') {{ $message }} @enderror</div>
            </div>
            <div class="text-xs-right">
                <button type="submit" class="btn btn-info">{{ __('Update') }}</button>
            </div>
            </form>

    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box --> --}}

    </section>
    <!-- /.content -->
    </div>
</x-app-layout>
