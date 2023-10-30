@extends("layouts.app")
@section("style")

@endsection
@section("content")
  <!-- ContentWrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="card">
      <div class="card-header">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">States</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li><a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Home</a> &nbsp</li>
                  <li><a href="#" class="btn btn-success btn-sm">Add State</a></li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped example">
          <thead>
          <tr>
            <th>State code</th>
            <th>State Name</th>
            <th>Country code</th>
            <th>Country Name</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($stateMast as $details)
          <tr>
            <td>{{ $details->state_code }}</td>
            <td>{{ $details->state_name }}</td>
            <td>{{ $details->country_code }}</td>
            <td>{{ $details->country_name }}</td>
             <td><a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a> 
             <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></a></td>
          </tr>
          @endforeach
          </tbody>
          <tfoot>
          <tr>
            <th>State code</th>
            <th>State Name</th>
            <th>Country code</th>
            <th>Country Name</th>
            <th>Action</th>
          </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>

    <!-- /.content -->
  </div>
 @endsection
 @section("script")
 <script>
  $(function () {
    if (!$.fn.dataTable.isDataTable('#example1')) {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  }
  });
</script>
 @endsection