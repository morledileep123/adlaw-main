@extends("layouts.app")
@section("style")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<!-- Cropper CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css'>

<style>
.p{
    color:red;
}
.alert-success{
    color:green;
}
.alert-danger{
    color:red;
}

.page {
	margin: 1em auto;
	max-width: 768px;
	display: flex;
	align-items: flex-start;
	flex-wrap: wrap;
	height: 100%;
}

.box {
	padding: 0.5em;
	width: 100%;
	margin: 0.5em;
}

.box-2 {
	padding: 0.5em;
	width: calc(100%/2 - 1em);
}

.options label,
.options input {
	width: 4em;
	padding: 0.5em 1em;
}

.btn {
	background: white;
	color: black;
	border: 1px solid black;
	padding: 0.5em 1em;
	text-decoration: none;
	margin: 0.8em 0.3em;
	display: inline-block;
	cursor: pointer;
}

.hide {
	display: none;
}

img {
	max-width: 100%;
}
</style>
@endsection
@section("content")
  <!-- ContentWrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="text-center m-50"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ url()->previous() }}">Back</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="card-body">
      <div class="col-md-10 offset-md-1">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('admin.profile.pic.update', ['id'=>$userProfile->user_id]) }}" method="post" enctype="multipart/form-data">
             @csrf
            <div class="card-body">
              
              <div class="form-group">
                <label>Profile Pic</label>
                <input type="hidden" name="id" id="id" class="form-control" value="{{ $userProfile->user_id }}">
                <input type="file" name="photo_path" id="image" class="form-control"><br>
                @if($userProfile->photo_path !=null)
                <img src="/public/profile-image/{{ $userProfile->photo_path }}" id="preview-image-before-upload" width="150px" height="150px">
                @else
                <img src="{{ asset('lawyer/img/2801143.png') }}" id="preview-image-before-upload" class="img-square elevation-2" alt="User Image">
                @endif
              </div>
                @if ($errors->has('photo_path'))
                  <span class="text-danger">{{ $errors->first('photo_path') }}</span>
                @endif
               <!-- /.card-body -->
              <div class="form-group">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
   
    <!-- /.content-header -->
    <!-- Main content -->
    
    <!-- /.content -->
  </div>
 @endsection
 @section("script")
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function (e) {
    $('#image').change(function(){     
        let reader = new FileReader();
        reader.onload = (e) => {    
            $('#preview-image-before-upload').attr('src', e.target.result); 
            }
        reader.readAsDataURL(this.files[0]); 
    });
});
</script>
 @endsection