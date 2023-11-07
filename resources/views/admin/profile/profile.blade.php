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
            <h1 class="text-center m-50"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ route('admin.basic.info') }}">Add basic details</a></li>
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if(Session::has('success'))
    <p class="alert alert-info">{{ Session::get('success') }}</p>
    @endif
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile" id="card">
                <div class="text-center mb-2">
                  @if(!empty($userProfile) && $userProfile->photo_path !='')
                  <a href="{{ route('dashboard') }}"><img class="img-fluid img-circle" src="{{ url('public/profile-image/'.$userProfile->photo_path) }}" width="200px" height="200px"></a>
                  @else
                  <a href="{{ route('dashboard') }}"><img class="img-fluid img-circle" src="{{ asset('dist/img/user2-160x160.jpg') }}" alt="User profile picture" width="200px" height="400px"></a>
                  @endif
                </div><br>
                <h4 class="text-center mb-2">Profile Image</h4>
                <h4 class="text-center mb-2"><a href="{{ route('admin.profile.pic.edit', ['id'=>Auth::user()->id]) }}">Edit</a></h4>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-8">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <h4>Basic Information <a href="{{ route('admin.basicinfo.edit', ['id'=>Auth::user()->id]) }}" style="float:right">Edit</a></h4>
                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    @if (!empty($userProfile) || empty($userProfile->user_id))
                      <p class="text-muted text-left"><b>User Name : {{ $userProfile->firstname}}&nbsp {{ $userProfile->middlename ?? null}}&nbsp{{ $userProfile->lastname ?? null}}</b><br>
                        <b>Date Of Birth : {{ $userProfile->dob}}</b><br>
                        <b>Gender : {{ $userProfile->gender}}</b><br>
                        <b>Email : {{ Auth::user()->email }}</b><br>
                        <b>Mobile number : {{ Auth::user()->mobile }}</b><br>
                        <b>Country Name : {{ $userProfile->country_name }}</b><br>
                        <b>State Name : {{ $userProfile->state_name}}</b><br>
                        <b>City Name : {{ $userProfile->city_name}}</b>
                      </p>
                    @else
                    <p class="text-muted text-left"><b>User Name : {{ Auth::user()->user_name }}</b><br>
                      <b>Date Of Birth : </b><br>
                      <b>Gender : </b><br>
                      <b>Email : {{ Auth::user()->email }}</b><br>
                      <b>Mobile number : {{ Auth::user()->mobile }}</b><br>
                      <b>Country Name : </b><br>
                      <b>State Name : </b><br>
                      <b>City Name : </b>
                    </p>
                    @endif
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
       </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 @endsection
 @section("script")

 @endsection