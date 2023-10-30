@extends("layouts.app")
@section("style")
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" > -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
    @if(Session::has('error'))
    <p class="alert alert-danger">{{ Session::get('error') }}</p>
    @endif
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Practicing working court upadate</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('update.prectecing.court', ['id'=>Auth::user()->id]) }}" method="post">
             @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Court Type Name</label>
                <select class="form-control" id="court-dropdown" name="court_type_code">
                  @php $seen = []; @endphp
                  @foreach ($courtEdit as $courtUpdate)
                      @foreach ($getCourt as $court)
                          @if (!in_array($court->court_type_code, $seen))
                              <option value="{{ $court->court_type_code }}" @if ($court->court_type_code == $courtUpdate->court_type_code) selected @endif>
                                  {{ $court->court_type_desc }}
                              </option>
                              @php $seen[] = $court->court_type_code; @endphp
                          @endif
                      @endforeach
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>All Practicing Courts</label>
                  <select multiple="multiple" class="form-control select2" id="courtname-dropdown" name="court_code[]" data-placeholder="Select court">
                    @foreach ($courtEdit as $courtUpdate) 
                      @foreach ($getCourt as $court) 
                      <option value="{{ $court->court_code }}" @if ($court->court_code == $courtUpdate->court_code) selected @endif>{{ $court->court_code }}</option>
                      @endforeach
                    @endforeach
                  </select>
              </div>
               <!-- /.card-body -->
              <div class="form-group">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
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
 <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

<script>
  $(document).ready(function() {
    $('#court-dropdown').on('change', function() {
      var court_type_code = this.value;
      $("#courtname-dropdown").html('');
      $.ajax({
        url:"{{url('profile/edit/get-court-by-court-type')}}",
        type: "POST",
        data: {
          court_type_code: court_type_code,
          _token: '{{csrf_token()}}' 
        },
        dataType : 'json',
        success: function(result){
          $('#courtname-dropdown').html('<option value="">Select Court Name</option>'); 
          
          $.each(result.courtMastEdit,function(key,value){
              $("#courtname-dropdown").append('<option value="'+value.court_code+'">'+value.court_name+'</option>');
          });
        }
      });
    });   
  }); 
</script>
 <script>
  $(function () {
    $('.select2').select2()
  });
</script>
 @endsection