@extends("layouts.app")
@section("style")
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
        <h3 class="card-title"></h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add new spcl</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('store.spcl') }}" method="post">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputSpcl">Spcl name</label>
                <input type="text" class="form-control" name="spcl_desc" id="exampleInputSpcl" placeholder="Enter spcl name">
              </div>
              @if ($errors->has('spcl_desc'))
                <span class="text-danger">{{ $errors->first('spcl_desc') }}</span>
              @endif
              <div class="form-group">
                <label for="exampleInputstate">Short desc</label>
                <textarea id="summernote" class="summernote form-control" name="short_desc"></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputstate">Desription</label>
                <textarea id="summernote" class="summernote form-control" name="description"></textarea>
              </div>
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
 <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
 <script type="text/javascript">
    $(document).ready(function () {
        $('.summernote').summernote();
    });
</script>
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