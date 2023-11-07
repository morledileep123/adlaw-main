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
            <h3 class="card-title">Edit state</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('update.state', $stateEdit->state_code) }}" method="post">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Country name</label>
                <input type="hidden" class="form-control" name="state_code" id="state_code" value="{{ $stateEdit->state_code }}">
                <select class="form-control" id="education-dropdown" name="country_code">
                    @foreach ($getCountry as $country) 
                    <option value="{{ $country->country_code }}" @if ($country->country_code == $stateEdit->country_code) selected @endif>{{ $country->country_name }}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputstate">State name</label>
                <input type="text" class="form-control" name="state_name" value="{{ $stateEdit->state_name }}">
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