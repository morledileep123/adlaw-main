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
            <h1 class="m-0">Specializations</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <div class="card-header" style="padding:4px; border:none;">
                <a href="{{ route('add.spcl') }}" class="btn btn-success btn-sm">Add Spcl</a>
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
            <th>Spcl code</th>
            <th>Spcl name</th>
            <th>Short desception</th>
            <th>desception</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($allspcls as $details)
          <tr>
            <td>{{ $details->spcl_code }}</td>
            <td>{{ $details->spcl_desc }}</td>
            <td>{{ strip_tags($details->short_desc) }}</td>
            <td>{{ strip_tags($details->description) }}</td>
            <td>
            <div class="btn-group">
              <button type="button" class="btn btn-secondary dropdown-toggle dropdown-icon btn-xs" data-toggle="dropdown">Action
              </button>
              <div class="dropdown-menu">                           
                <a class="dropdown-item" href="{{ route('edit.spcl', $details->spcl_code) }}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                <a class="dropdown-item" href="{{ route('delete.spcl', $details->spcl_code) }}"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>                        
              </div>
            </div>
            </td>
          </tr>
          @endforeach
          </tbody>
          <tfoot>
          <tr>
            <th>Spcl code</th>
            <th>Spcl name</th>
            <th>Short desception</th>
            <th>desception</th>
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