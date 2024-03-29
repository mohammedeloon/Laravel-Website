@extends('admin.admin_master')
@section('admin')
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add Multiple Images</h4><br><br>
            <form action="{{ route('store.multi.image') }}" method="post" enctype="multipart/form-data">
                @csrf

             <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">About Multi Imgae</label>
                <div class="col-sm-10">
                    <input name="multi_image[]" class="form-control" type="file" value="" id="image" multiple>
                   
                </div>
            </div>
            <!-- end row -->
            <div class="row mb-3">
            <label for="example-text-input" class="col-sm-2 col-form-label"> </label>
                <div class="col-sm-10">
                <img id="showImage" class="rounded avatar-lg" src="{{ url('upload/no_image.jpg') }}" alt="Card image cap">
                </div>
            </div>
            <!-- end row -->

            <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Add Multiple Images">
            </form>
        </div>
    </div>
</div> <!-- end col -->
</div>

</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src' , e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection