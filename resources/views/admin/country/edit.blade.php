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
            <h3 class="card-title">Edit country</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('update.country', $countryEdit->country_code) }}" method="post">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <input type="hidden" class="form-control" name="country_code" id="country_code" value="{{ $countryEdit->country_code }}">
                <label for="exampleInputCountry">Country name</label>
                <input type="text" class="form-control" name="country_name" value="{{ $countryEdit->country_name }}">
              </div>
              <div class="form-group">
                <label for="exampleInputIso2">Iso2</label>
                <input type="text" class="form-control" name="iso2" value="{{ $countryEdit->iso2 }}">
              </div>
              <div class="form-group">
                <label for="exampleInputIso3">Iso3</label>
                <input type="text" class="form-control" name="iso3" value="{{ $countryEdit->iso3 }}">
              </div>
              <div class="form-group">
                <label for="exampleInputPhone">Phone code</label>
                <input type="text" class="form-control" name="phone_code" value="{{ $countryEdit->phone_code }}">
              </div>
              <div class="form-group">
                <label for="exampleInputNationality">Nationality</label>
                <input type="text" class="form-control" name="nationality" value="{{ $countryEdit->nationality }}">
              </div>
              <div class="form-group">
                <label for="exampleInputCurrency">Currency code</label>
                <input type="text" class="form-control" name="currency_code" value="{{ $countryEdit->currency_code }}">
              </div>
              <div class="form-group">
                <label for="exampleInputCurrency">Currency name</label>
                <input type="text" class="form-control" name="currency_name" value="{{ $countryEdit->currency_name }}">
              </div>
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