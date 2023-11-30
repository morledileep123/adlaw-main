@extends("layouts.app")
@section("style")
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section("content")
  <!-- ContentWrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li><a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">Home</a>&nbsp</li>
              <li><a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Back</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
   
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Basic information</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
        <form class="form-horizontal" method="POST" action="{{ route('add.basicinfo') }}">
            @csrf
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="inputName" class="col-sm-5 col-form-label">First Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="inputName" value="" name="firstname" placeholder="Enter first name">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label  class="col-sm-5 col-form-label">Middle Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control"  name="middlename" placeholder="Enter middle name">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label  class="col-sm-5 col-form-label">Last Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="lastname"  placeholder="Enter last name">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label  class="col-sm-5 col-form-label">DOB</label>
                    <div class="col-sm-12">
                        <input type="date" class="form-control" name="dob"  placeholder="Enter date of birth">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label  class="col-sm-5 col-form-label">Gender</label>
                    <div class="col-sm-12">
                        <input type="radio" value="M" name="gender"> Male &nbsp
                        <input type="radio" value="F" name="gender"> Female &nbsp
                        <input type="radio" value="O" name="gender"> Other
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label  class="col-sm-5 col-form-label">Alternate Email</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="alternate_email" placeholder="Enter alternate email address">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="inputMobile" class="col-sm-5 col-form-label">Alternate Mobile Number</label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" name="alternate_mobile" id="inputMobile" placeholder="Enter alternate mobile number">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="inputMobile" class="col-sm-5 col-form-label">Add country</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="country-dropdown" name="country_name">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country) 
                            <option value="{{$country->country_code}}">
                            {{$country->country_name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="inputMobile" class="col-sm-5 col-form-label">Add state</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="state-dropdown" name="state_name">
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="inputMobile" class="col-sm-5 col-form-label">Add city</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="city-dropdown" name="city_name">
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="inputZipcode" class="col-sm-5 col-form-label">Zip code</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="zip_code" id="inputZipcode" placeholder="Enter zip code">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="inputAddress" class="col-sm-5 col-form-label">Address</label>
                    <div class="col-sm-12">
                      <textarea id="summernote1" class="summernote1 form-control" name="address"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">    
                <div class="col-sm-12">
                    <label for="inputAdhar" class="col-sm-5 col-form-label">Adhar Number</label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" name="aadhar_numb" id="inputAdhar" placeholder="Enter adhar number">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="inputPan" class="col-sm-5 col-form-label">Pan Number</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="pan_numb" id="inputPan" placeholder="Enter pan number">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="inputBar" class="col-sm-5 col-form-label">Bar regs number</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="bar_regs_numb" id="inputBar" placeholder="Enter Bar regs number">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="inputMobile" class="col-sm-5 col-form-label">Profile Description</label>
                    <div class="col-sm-12">
                       <textarea id="summernote" class="summernote form-control" name="detl_profile"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                <button type="submit" class="btn btn-primary ml-2">Submit</button>
                </div>
            </div>
        </form>
        </div>
      </div>
      <!-- /.card-body -->
    </div>

    <!-- /.content -->
  </div>
 @endsection
 @section("script")
 <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
 <script type="text/javascript">
    $(document).ready(function () {
        $('.summernote').summernote();
    });
</script>
 <script>
    $(document).ready(function() {
        $('#country-dropdown').on('change', function() {
            var country_id = this.value;
            $("#state-dropdown").html('');
            $.ajax({
                url:"{{url('profile/edit/get-states-by-country')}}",
                type: "POST",
                data: {
                country_code: country_id,
                _token: '{{csrf_token()}}' 
                },
                dataType : 'json',
                success: function(result){
                    $('#state-dropdown').html('<option value="">Select State</option>'); 
                    $.each(result.states,function(key,value){
                        $("#state-dropdown").append('<option value="'+value.state_code+'">'+value.state_name+'</option>');
                    });
                    $('#city-dropdown').html('<option value="">Select State First</option>'); 
                }
            });
        });   
        $('#state-dropdown').on('change', function() {
            var state_id = this.value;
            $("#city-dropdown").html('');
            $.ajax({
                url:"{{url('profile/edit/get-cities-by-state')}}",
                type: "POST",
                data: {
                state_code: state_id,
                _token: '{{csrf_token()}}' 
                },
                dataType : 'json',
                success: function(result){
                    $('#city-dropdown').html('<option value="">Select City</option>'); 
                    $.each(result.cities,function(key,value){
                        $("#city-dropdown").append('<option value="'+value.city_code+'">'+value.city_name+'</option>');
                    });
                }
            });
        });
    }); 
</script>
 @endsection