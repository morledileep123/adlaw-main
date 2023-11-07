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
        <h3 class="card-title">Qualification update</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('qualificationUpdate', ['id'=>$qualEdit->id]) }}" method="post">
             @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Education Type</label>
                  <input type="hidden" name="id" class="form-control" id="id" value="{{ $qualEdit->id }}">
                  <select class="form-control" id="education-dropdown" name="qual_catg_code">
                      @foreach ($catgQualMast as $qualification) 
                      <option value="{{ $qualification->qual_catg_code }}" @if ($qualification->qual_catg_code == $qualEdit->qual_catg_code) selected @endif>{{ $qualification->qual_catg_desc }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group">
                <label>Select graducation</label>
                  <select class="form-control" id="graducation-dropdown" name="qual_desc">
                     <option type="hidden" value="{{ $qualEdit->qual_catg_code }}">{{ $qualEdit->qual_desc }}</option>
                  </select>
              </div>
              <div class="form-group">
                <label for="exampleInputCityName">Paasing year</label>
                <input type="text" name="pass_year" class="form-control" id="exampleInputCityName" value="{{ $qualEdit->pass_year }}" placeholder="Paasing year">
              </div>
              <div class="form-group">
                <label for="exampleInputCityName">Paasing Perceantage</label>
                <input type="text" name="pass_perc" class="form-control" id="exampleInputCityName" value="{{ $qualEdit->pass_perc }}" placeholder="Enter Paasing Perceantage">
              </div>
              <div class="form-group">
                <label for="exampleInputCityName">Paasing Division</label>
                <input type="text" name="pass_division" class="form-control" id="exampleInputCityName" value="{{ $qualEdit->pass_division }}" placeholder="Enter Paasing Division">
            </div>
            <!-- /.card-body -->

            <div class="form-group">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Submit</button>
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
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    $('#education-dropdown').on('change', function() {
      var education_id = this.value;
      $("#graducation-dropdown").html('');
      $.ajax({
        url:"{{url('profile/get-education-by-qual-type')}}",
        type: "POST",
        data: {
          qual_catg_code: education_id,
        _token: '{{csrf_token()}}' 
        },
        dataType : 'json',
        success: function(result){
          $('#graducation-dropdown').html('<option value=""></option>'); 
          $.each(result.educaMast,function(key,value){
              $("#graducation-dropdown").append('<option value="'+value.qual_code+'">'+value.qual_desc+'</option>');
          });
        }
      });
    });   
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