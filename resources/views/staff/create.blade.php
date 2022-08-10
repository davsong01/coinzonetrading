<x-app-layout>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Add staff
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('staff.index') }}"><i class="fa fa-dashboard"></i>
                        Staff</a></li>
                <li class="breadcrumb-item active">Add new staff</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
             
              <div class="col-xl-12 col-lg-12">
                  <div class="box box-solid bg-black">
                      <div class="box-header with-border">
                          <h3 class="box-title">Personal details</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                          <div class="row">
                              <div class="col-12">
                                  <form action="{{ route('staff.store') }}"
                                      method="post" style="margin:auto" enctype="multipart/form-data">
                                      @csrf
                                     
                                      <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Full
                                              Name</label>
                                          <div class="col-sm-9">
                                              <input class="form-control" name="name"
                                                  type="text"
                                                  value="{{ old('name') }}"
                                                  placeholder="Full name" required>
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">
                                              Email</label>
                                          <div class="col-sm-9">
                                              <input class="form-control" name="email"
                                                  type="email"
                                                  value="{{ old('email') }}"
                                                  placeholder="Email" required>
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Phone
                                              number</label>
                                          <div class="col-sm-9">
                                              <input class="form-control" name="phone"
                                                  type="text"
                                                  value="{{ old('phone') }}"
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
                                              <option value="">Select...</option>
                                                <option value="staff" {{ old('level') == 'staff' ? 'selected' : '' }}>Staff</option>

                                                <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                            </div>
                                        </div>
                                      <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Profile Picture</label>
                                            <div class="col-sm-9">
                                              <input type="file" class="form-control" name="profile_picture" value="{{ old('profile_picture') }}">
                                            </div>
                                      </div>
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
                 
              </div>
              <!-- /.col -->
          </div>
        
    </section>
    <!-- /.content -->
    </div>
</x-app-layout>
