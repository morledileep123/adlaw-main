@extends("layouts.app")
@section("style")
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
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
        <h3 class="card-title"></h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit city</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('update.city', $cityEdit->city_code) }}" method="post">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Country name</label>
                <input type="hidden" class="form-control" name="city_code" value="{{ $cityEdit->city_code }}">
                <select  class="form-control" name="country_code" id="country-dropdown">
                <option value="">--select country--</option>
                  @foreach ($getCountry as $country) 
                  <option value="{{ $country->country_code }}" @if ($country->country_code == $cityEdit->country_code) selected @endif>{{ $country->country_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>State name</label>
                <select class="form-control" id="state-dropdown" name="state_code">
                <option type="hidden" value="{{ $cityEdit->state_code }}">{{ $cityEdit->state_name }}</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputCity">City type</label>
                <select  class="form-control" name="city_type">
                  <option value="">--select city type--</option>
                  @foreach ($cityType as $city) 
                  <option value="{{ $city->city_type_id }}" @if ($city->city_type_id == $cityEdit->city_type) selected @endif>{{ $city->city_type_desc }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputCityname">City name</label>
                <input type="text" class="form-control" name="city_name" id="exampleInputCity" value="{{ $cityEdit->city_name }}">
              </div>
                @if ($errors->has('city_name'))
                  <span class="text-danger">{{ $errors->first('city_name') }}</span>
                @endif
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Update</button>
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
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    $('#country-dropdown').on('change', function() {
      var country_code = this.value;
      $("#state-dropdown").html('');
      $.ajax({
        url:"{{url('/admin/city/get-state-by-country-code')}}",
        type: "POST",
        data: {
          country_code: country_code,
          _token: '{{csrf_token()}}' 
        },
        
        dataType : 'json',
        success: function(result){
          $('#state-dropdown').html('<option value="">Select country Type</option>'); 
          $.each(result.stateMast,function(key,value){
              $("#state-dropdown").append('<option value="'+value.state_code+'">'+value.state_name+'</option>');
          });
        }
      });
    });   
  }); 
</script>
 @endsection