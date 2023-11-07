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
            <h1 class="m-0">Packages</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <div class="card-header" style="padding:4px; border:none;">
                <a href="{{ route('add.package') }}" class="btn btn-success btn-sm">Add package</a>
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
              </div>
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
   
    <div class="card">
     
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Package id</th>
            <th>Package desception</th>
            <th>Package valid day</th>
            <th>Rate</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($allPackages as $details)
          <tr>
            <td>{{ $details->package_id }}</td>
            <td>{{ $details->package_desc }}</td>
            <td>{{ $details->valid }} &nbsp Day</td>
            <td>{{ $details->rate }}</td>
            <td>
            <div class="btn-group">
              <button type="button" class="btn btn-secondary dropdown-toggle dropdown-icon btn-xs" data-toggle="dropdown">Action
              </button>
              <div class="dropdown-menu">                           
                <a class="dropdown-item" href="{{ route('edit.package', $details->package_id) }}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                <a class="dropdown-item" href="{{ route('delete.package', $details->package_id) }}"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>                        
              </div>
            </div>
            </td>
          </tr>
          @endforeach
          </tbody>
          <tfoot>
          <tr>
            <th>Package id</th>
            <th>Package desception</th>
            <th>Package valid day</th>
            <th>Rate</th>
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