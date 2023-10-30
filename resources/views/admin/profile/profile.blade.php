@extends("layouts.app")
@section("style")

@endsection
@section("content")
  <!-- ContentWrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center mb-2">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../../dist/img/user2-160x160.jpg"
                       alt="User profile picture">
                </div>
                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                     <p class="text-muted text-left"><b>Name : {{ Auth::user()->user_name}}</b></p>
                  </li>
                  <li class="list-group-item">
                  <p class="text-muted text-left"><b>Email : {{ Auth::user()->email}}</b></p>
                  </li>
                  <li class="list-group-item">
                  <p class="text-muted text-left"><b>Mobile : {{ Auth::user()->mobile}}</b></p>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                  <h3 class="nav-item">Update Profile</h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if($message = Session::get('success'))
                  <div class="alert alert-success">
                <p>{{$message}}</p>
                  </div>
                @endif
                <div class="tab-content">
                  <div id="settings">
                    <form class="form-horizontal" method="POST" action="{{ route('profileUpdate') }}">
                      @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">User Name</label>
                        <div class="col-sm-10">
                          <input type="hidden" class="form-control" id="id" name="id" value="{{ Auth::user()->id}}"> 
                          <input type="text" class="form-control" id="inputName" value="{{ Auth::user()->user_name}}" name="user_name" placeholder="Name">
                        </div>
                      </div>
                      @if ($errors->has('user_name'))
                        <span class="text-danger">{{ $errors->first('user_name') }}</span>
                      @endif
                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="{{ Auth::user()->email}}" placeholder="Enter Email Address">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputMobile" class="col-sm-2 col-form-label">Mobile Number</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" name="mobile" value="{{ Auth::user()->mobile}}" id="inputMobile" placeholder="Enter Mobile Number">
                        </div>
                      </div>
                      @if ($errors->has('mobile'))
                        <span class="text-danger">{{ $errors->first('mobile') }}</span>
                      @endif
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
       </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 @endsection
 @section("script")

 @endsection