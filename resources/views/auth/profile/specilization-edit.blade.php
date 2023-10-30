@extends("layouts.app")
@section("style")
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
      <h3 class="card-title">Edit specialization</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body" style="height:350px;">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title"></h3>
        </div>
       
        <!-- /.card-header -->
        <!-- form start -->
          <form class="form-horizontal" method="POST" action="{{ route('update.specialization', ['id'=>Auth::user()->id]) }}">
              @csrf
            <div class="form-group">
              <div class="col-sm-12">
                  <label for="inputName" class="col-sm-5 col-form-label">Specialization</label>
                  <div class="col-sm-12">
                    <select  multiple="multiple" class="form-control select2" name="spclEdit[]" data-placeholder="Select Specialization">
                    @foreach ($editSpecialData as $specUpdate) 
                      @foreach ($spclMast as $specialize) 
                      <option value="{{ $specialize->spcl_code }}" @if ($specialize->spcl_code == $specUpdate->spcl_code) selected @endif>{{ $specialize->spcl_desc }}</option>
                      @endforeach
                    @endforeach
                    </select>
                 
                    
                  </div>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                <button type="submit" class="btn btn-primary ml-2">Update</button>
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
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
 
<script>
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
</script>
 @endsection