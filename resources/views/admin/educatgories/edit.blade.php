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
            <h3 class="card-title">Edit qualification</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('update.educatg', $qualCatgEdit->qual_catg_code) }}" method="post">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEducation">Education category name</label>
                <input type="text" class="form-control" name="qual_catg_desc" value="{{ $qualCatgEdit->qual_catg_desc }}">
              </div>
              <div class="form-group">
                <label for="exampleInputShort">Short desription</label>
                <input type="text" class="form-control" name="shrt_desc" value="{{ $qualCatgEdit->shrt_desc }}">
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