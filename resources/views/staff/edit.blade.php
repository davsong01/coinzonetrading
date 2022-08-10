<x-app-layout>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $staff->user->name }}
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('staff.index') }}"><i class="fa fa-dashboard"></i>
                        Staff</a></li>
                <li class="breadcrumb-item active">{{ $staff->user->name }}</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
              <div class="col-xl-4 col-lg-5">
                  <!-- Profile Image -->
                  <div class="box bg-yellow bg-deathstar-dark">
                      <div class="box-body box-profile">
                          <img class="profile-user-img rounded img-fluid mx-auto d-block"
                              src="{{ asset(!empty($staff->profile_picture) ? $staff->profile_picture : 'back-end/images/user2-160x160.jpg') }}" alt="User Image">
                          <h2 class="profile-username text-center mb-0">
                              {{ $staff->user->name }}</h2>
                          <h4 class="text-center mt-0"><i
                                  class="fa fa-envelope-o mr-10"></i>{{ $staff->user->email }}
                          </h4>
                          <div class="form-group row"><br><br>
                              <form action="{{ route('staff.update', $staff->id) }}" method="post"
                                  enctype="multipart/form-data" style="margin:auto">
                                  @csrf
                                  @method('patch')
                                  <label class="col-sm-12 col-form-label"
                                      style="text-align: center">Replace profile
                                      picture</label>
                                  <div class="col-sm-12">
                                      <input class="form-control" type="file"
                                          name="profile_picture">
                                  </div> <br>
                                  <input type="hidden" name="staff_id" value="{{ $staff->id }}">
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
                                  <form action="{{ route('staff.update', $staff->id) }}"
                                      method="post" style="margin:auto">
                                      @csrf
                                      @method('patch')
                                      <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Full
                                              Name</label>
                                          <div class="col-sm-9">
                                              <input class="form-control" name="name"
                                                  type="text"
                                                  value="{{ $staff->user->name ?? old('name') }}"
                                                  placeholder="Full name" required>
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Phone
                                              number</label>
                                          <div class="col-sm-9">
                                              <input class="form-control" name="phone"
                                                  type="text"
                                                  value="{{ $staff->phone ?? old('phone') }}"
                                                  placeholder="Phone number" required>
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Password (Leave blank to use 9876543 as default password)</label>
                                          <div class="col-sm-9">
                                              <input class="form-control" name="password"
                                                  type="text"
                                                  value="{{ old('password') }}"
                                                  placeholder="Enter password">
                                          </div>
                                      </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Level</label>
                                            <div class="col-sm-9">
                                            <select name="level" id="level" class="form-control" required>
                                                <option value="admin" {{ 'admin' == $staff->level ? 'selected' : '' }}>Admin</option>
                                                <option value="staff" {{ 'staff' == $staff->level ? 'selected' : '' }}>Staff</option>
                                            </select>
                                            </div>
                                        </div>
                                      <div class="form-group row">
                                          <label class="col-sm-12 col-form-label"></label>
                                          <div class="col-sm-12">
                                              <button type="submit"
                                                  class="btn btn-yellow">Update</button>
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
                 
              </div>
              <!-- /.col -->
          </div>
        
    </section>
    <!-- /.content -->
    </div>
</x-app-layout>
