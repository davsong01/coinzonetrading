@php
    $userPackages =  App\Models\InvestorPackage::where(['investor_id' => $investor->user->id]);
    $mypackages = $userPackages->get();
    $packages = App\Models\Package::all();
    $otherpackages = array_column($userPackages->get('package_id')->toArray(), 'package_id');
    $otherpackages = $packages->whereNotIn('id', $otherpackages);
@endphp
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
                                <li class="nav-item"> <a class="nav-link {{ !is_null($hid) && $hid == 'profile' ? 'active' : '' }}" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span
                                            class="hidden-xs-down">Profile</span></a> </li>
                                <li class="nav-item"> <a class="nav-link {{ !is_null($hid) && $hid == 'packages' ? 'active' : '' }}" data-toggle="tab" href="#packages"
                                        role="tab"><span class="hidden-sm-up"><i class="icon-grid"></i></span> <span
                                            class="hidden-xs-down">Packages</span></a> </li>
                                 <li class="nav-item"> <a class="nav-link {{ !is_null($hid) && $hid == 'wallet' ? 'active' : '' }}" data-toggle="tab" href="#wallet"
                                        role="tab"><span class="hidden-sm-up"><i class="icon-wallet"></i></span> <span
                                            class="hidden-xs-down">Wallet History</span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane {{ !is_null($hid) && $hid == 'profile' ? 'active' : '' }}" id="profile" role="tabpanel">
                                    <div class="pad">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-5">
                                                <!-- Profile Image -->
                                                <div class="box bg-yellow bg-deathstar-dark">
                                                    <div class="box-body box-profile">
                                                        <img style="border-radius:50% !important" class="profile-user-img img-fluid mx-auto d-block"
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
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Email</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="email"
                                                                                type="text"
                                                                                value="{{ ($investor->user->email ?? old('email')) }}"
                                                                                placeholder="Enter email" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Country</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="country" type="text" value="{{  $investor->country ?? old('country') }}"
                                                                            placeholder="Country">
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Address</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="address" type="text" value="{{  $investor->address ?? old('address') }}"
                                                                            placeholder="Address">
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">State/Region</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="state" type="text" value="{{  $investor->state ?? old('state') }}"
                                                                            placeholder="State/Region">
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Zip Code</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="zip_code" type="text" value="{{  $investor->zip_code ?? old('zip_code') }}"
                                                                            placeholder="Zip code">
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
                                <div class="tab-pane {{ !is_null($hid) && $hid == 'packages' ? 'active' : '' }}" id="packages" role="tabpanel">
                                    <div class="row">
                                      <div class="col-lg-12 col-12">         
                                      <div class="box">
                                        <div class="box-header with-border">
                                          <h4 class="box-title">{{ $investor->user->name }}'s Packages</h4> <a class="btn btn bg-blue" data-toggle="modal" data-target="#modal-top">
                                           <i class="fa fa-plus"></i></a>
                                           @include('investors.investor-package-add-modal')
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
                                                <th>Daily ROI</th>
                                                @if(auth()->user()->admin->level == 'admin')
                                                <th>Actions</th>
                                                @endif
                                              </tr>
                                              </thead>
                                              <tbody>
                                               
                                                @foreach($mypackages as $packages)
                                                <tr>
                                                  <td><p class="font-size-18 no-margin">{{ $packages->package->name }} <br> <span> <small><b>Initiated: </b>{{ $packages->created_at }} 
                                                    @if(auth()->user()->admin->level == 'admin' && $packages->created_by != 1)
                                                        @if(isset($packages->created_by))
                                                            <br> <small style="color:blue"><b>Created by: </b>{{ $packages->createdBy->name }} </small>
                                                        @endif
                                                    @endif
                                                    </p></small></span></td>
                                                  <td><p class="no-margin" style="display:flex">
                                                    @if(!empty($packages->end_date) && $packages->end_date >= \Carbon\Carbon::today())
                                                      <button class="btn btn-info btn-sm" style="background:green;border:none" readonly>Active</button>
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
                                                      {{date("M dS, Y", strtotime($packages->start_date)). ','. date("h:ia", strtotime($packages->start_date))}}
                                                    @endif
                                                  </td>
                                                  <td>
                                                    @if(!empty($packages->end_date))
                                                      {{date("M dS, Y", strtotime($packages->end_date)). ','. date("h:ia", strtotime($packages->end_date))}}
                                                    @endif
                                                  </td>
                                                  <td>{{ $settings->currency_sign . number_format($packages->daily_roi) }}</td>
                                                  <td>
                                                    @if(auth()->user()->admin->level == 'admin')
                                                    <a class="btn btn-block btn-info btn-xs" data-toggle="modal" data-target="#modal-right{{ $packages->id }}"> <i class="fa fa-eye"></i>Edit</a>
                                                     
                                                    <form onsubmit="return confirm('Are you sure you want to delete forever?');" action="{{ route('investorpackages.delete', $packages->id) }}" method="POST" style="margin-top: 5px;">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value={{ $investor->id }}>
                                                    
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
                                <div class="tab-pane {{ !is_null($hid) && $hid == 'wallet' ? 'active' : '' }}" id="wallet" role="tabpanel">
                                    <div class="row">
                                      <div class="col-lg-12 col-12">         
                                      <div class="box">
                                        <div class="box-header with-border">
                                          <h4 class="box-title">{{ $investor->user->name }}'s Wallet history</h4>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                          <div class="table-responsive">
                                            <div id="example1" class="table table-striped table-bordered no-margin">
                                              <table id="example" class="table table-bordered responsive table-hover display nowrap margin-top-10 w-p100 dataTable"
                                                role="grid" aria-describedby="example_info">
                                                <thead>
                                                  <tr>
                                                    <th>{{ __('S/N') }}</th>
                                                    <th>{{ __('Reference ID') }}</th>
                                                    <th>{{ __('Amount') }}</th>
                                                    <th>{{ __('Type') }}</th>

                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  @php
                                                      $count = 1;
                                                  @endphp
                                                  @if(isset($investor->user->wallets) && $investor->user->wallets->count() > 1)
                                                  @foreach ($investor->user->wallets->sortByDesc('created_at') as $wallet)
                                                  <tr>
                                                    <td>{{ $count ++ }}</td>
                                                    <td>{{ $wallet->reference }}
                                                    <small> <br>
                                                        <strong style="color: #dd3765;">Created on: </strong>{{ $wallet->created_at }} <br>
                                                        @if(isset($wallet->transaction->last_cron_date)) <br>
                                                        <strong style="color: #dd3765;">Last Cron</strong> {{ $wallet->transaction->last_cron_date ?? null }} 
                                                        @endif
                                                    </small>
                                                    </td>
                                                    <td>{{ $settings->currency_sign . number_format($wallet->amount) }}</td>
                                                    <td style="color:{{ $wallet->type == 'credit' ? 'green' : 'red'}}">{{ ucfirst($wallet->type) }}</td>
                                                  </tr>
                                                  @endforeach
                                                  @endif
                                                </tbody>
                                              </table>
                                            </div>
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
    </section>
    <!-- /.content -->
    </div>
</x-app-layout>
