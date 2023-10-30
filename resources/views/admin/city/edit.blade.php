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
            <h1 class="m-0">Cities</h1>
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
        <h3 class="card-title">Add new city</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add new city</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('update.city', ) }}" method="post">
             @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputCityType">City Type</label>
                <select class="form-control" style="width: 100%;" name="city_type" data-placeholder="Select User Type">
                  @foreach ($cityType as $city)
                  <option value="{{ $city->city_type_id }}">{{ $city->city_type_desc }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputCityCode">City Code</label>
                <input type="text" name="city_code" class="form-control" id="exampleInputCityCode" placeholder="Enter city code">
              </div>
              @if ($errors->has('city_code'))
                <span class="text-danger">{{ $errors->first('city_code') }}</span>
              @endif
              <div class="form-group">
                <label for="exampleInputCityName">City Name</label>
                <input type="text" name="city_name" class="form-control" id="exampleInputCityName" placeholder="Enter city name">
              </div>
              @if ($errors->has('city_name'))
                <span class="text-danger">{{ $errors->first('city_name') }}</span>
              @endif
              <div class="form-group">
                <label for="exampleInputStateCode">State Code</label>
                <input type="text" name="state_code" class="form-control" id="exampleInputStateCode" placeholder="Enter state code">
              </div>
              @if ($errors->has('state_code'))
                <span class="text-danger">{{ $errors->first('state_code') }}</span>
              @endif
              <div class="form-group">
                <label for="exampleInputStateName">State Name</label>
                <input type="text" name="state_name" class="form-control" id="exampleInputStateName" placeholder="Enter state name">
              </div>
              @if ($errors->has('state_name'))
                <span class="text-danger">{{ $errors->first('state_name') }}</span>
              @endif
              <div class="form-group">
                <label for="exampleInputCountryCode">Country Code</label>
                <input type="text" name="country_code" class="form-control" id="exampleInputCountryCode" placeholder="Enter country code">
              </div>
              @if ($errors->has('country_code'))
                <span class="text-danger">{{ $errors->first('country_code') }}</span>
              @endif
              <div class="form-group">
                <label for="exampleInputCountryName">Country Name</label>
                <input type="text" name="country_name" class="form-control" id="exampleInputCountryName" placeholder="Enter country name">
              </div>
              @if ($errors->has('country_name'))
                <span class="text-danger">{{ $errors->first('country_name') }}</span>
              @endif
              <!-- <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                  </div>
                </div>
              </div> -->
              <!-- <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
              </div> -->
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
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
 <script>
  $(function () {
    $('#example1').DataTable().destroy();
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
 @endsection