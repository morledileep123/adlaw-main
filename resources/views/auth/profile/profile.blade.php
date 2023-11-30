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
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ url()->previous() }}">Back</a></li>
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
          <div class="col-md-6 offset-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center mb-2">
                  @if(!empty($profilePic) && $profilePic->photo_path !='')
                  <a href="#"><img class="profile-user-img img-fluid img-circle" src="{{ url('public/profile-image/'.$profilePic->photo_path) }}" alt="User profile picture"></a>
                  @else
                  <img class="profile-user-img img-fluid img-circle" src="{{ asset('lawyer/img/2801143.png') }}" alt="User profile picture">
                  @endif
                </div>
                <h4 class="text-center mb-2">Profile Image</h4>
                <h4 class="text-center mb-2"><a href="{{ route('profile.pic.edit', ['id'=>Auth::user()->id]) }}">Edit</a></h4>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <h4>Basic Information <a href="{{ route('basicinfoEdit', ['id'=>Auth::user()->id]) }}" style="float:right">Edit</a></h4>
                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    @if (!empty($userProfile) && !empty($userProfile->user_id) )
                      <p class="text-muted text-left"><b>User Name : {{ $userProfile->firstname}}&nbsp {{ $userProfile->middlename ?? null}}&nbsp{{ $userProfile->lastname ?? null}}</b></p>
                      <p class="text-muted text-left"><b>Date Of Birth : {{ $userProfile->dob}}</b></p>
                      <p class="text-muted text-left"><b>Gender : {{ $userProfile->gender}}</b></p>
                      <p class="text-muted text-left"><b>Email : {{ $user->email }}</b></p>
                      <p class="text-muted text-left"><b>Mobile number : {{ $user->mobile }}</b></p>
                      <p class="text-muted text-left"><b>Country Name : {{ $userProfile->country_name }}</b></p>
                      <p class="text-muted text-left"><b>State Name : {{ $userProfile->state_name}}</b></p>
                      <p class="text-muted text-left"><b>City Name : {{ $userProfile->city_name}}</b></p>
                    @else
                    <p class="text-muted text-left"><b>User Name : {{ Auth::user()->user_name }}</b></p>
                    <p class="text-muted text-left"><b>Date Of Birth : </b></p>
                    <p class="text-muted text-left"><b>Gender : </b></p>
                    <p class="text-muted text-left"><b>Email : </b></p>
                    <p class="text-muted text-left"><b>Mobile number : {{ Auth::user()->mobile }}</b></p>
                    <p class="text-muted text-left"><b>Country Name : </b></p>
                    <p class="text-muted text-left"><b>State Name : </b></p>
                    <p class="text-muted text-left"><b>City Name : </b></p>
                    @endif
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          
          <div class="col-md-4">
            <div class="row">
              <div class="col-sm-12">
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <h4>Specialization <a href="{{ route('specializationEdit', ['id'=>Auth::user()->id]) }}" style="float:right">Edit</a></h4>
                    <ul class="list-group list-group-unbordered">
                      <li class="list-group-item">
                        @if (!empty($specializationData) && count($specializationData) > 0)
                        <b class="text-muted text-left">      
                          @foreach($specializationData as $data)
                          {{ $data->spcl_desc  }}<br>
                          @endforeach
                        </b>
                        @endif
                      </li>
                    </ul>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
              <div class="col-sm-12">
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <h4>Practecing court <a href="{{ route('prectecingCourtEdit', ['id'=>Auth::user()->id]) }}" style="float:right">Edit</a></h4>
                    <ul class="list-group list-group-unbordered">
                      <li class="list-group-item">
                        @if (!empty($userCourtData) && count($userCourtData) > 0)
                        <b class="text-muted text-left">      
                          @foreach($userCourtData as $data)
                          {{ $data->court_name  }}<br>
                          @endforeach
                        </b>
                        @endif
                      </li>
                    </ul>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
            </div> 
            <!-- Profile Image -->
            
            <!-- /.card -->
          </div>
          <div class="col-md-4">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <h4>Education <a href="{{ route('qualificationEdit', ['id'=>Auth::user()->id]) }}" style="float:right">Edit</a></h4>
                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                  @if (!empty($qualification) && !empty($qualification->user_id))
                  <p class="text-muted text-left"><b>Graduation : {{ $qualification->qual_catg_desc}}</b></p>
                  <p class="text-muted text-left"><b>Course : {{ $qualification->qual_desc}}</b></p>
                  <p class="text-muted text-left"><b>Passsing Year : {{ $qualification->pass_year}}</b></p>
                  <p class="text-muted text-left"><b>Percentage : {{ $qualification->pass_perc}}</b></p>
                  <p class="text-muted text-left"><b>Division : {{ $qualification->pass_division}}</b></p>
                  @else
                  <p class="text-muted text-left"><b>Graduation : </b></p>
                  <p class="text-muted text-left"><b>Course : </b></p>
                  <p class="text-muted text-left"><b>Passsing Year : </b></p>
                  <p class="text-muted text-left"><b>Percentage : </b></p>
                  <p class="text-muted text-left"><b>Division : </b></p>
                  @endif
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
         
          <!-- /.col -->
        </div>
       </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 @endsection
 @section("script")

 @endsection