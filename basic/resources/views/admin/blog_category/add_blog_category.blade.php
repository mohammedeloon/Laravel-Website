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
<h4 class="card-title">Add Blog Category Page </h4><br><br>
<form action="{{ route('store.blog.category') }}" method="post">
    @csrf

<div class="row mb-3">
    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
    <div class="col-sm-10">
        <input name="blog_category" class="form-control" type="text" id="example-text-input">
        @error('blog_category')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<!-- end row -->

<input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Add Blog Category ">
</form>
</div>
</div>
</div>
</div>

</div>
</div>

@endsection