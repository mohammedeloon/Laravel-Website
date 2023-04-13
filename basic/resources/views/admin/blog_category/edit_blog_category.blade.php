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
<h4 class="card-title">Edit Blog Category Page </h4><br><br>
<form action="{{ route('update.blog.category') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $blogCategory->id }}">
<div class="row mb-3">
    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
    <div class="col-sm-10">
        <input name="blog_category" class="form-control" type="text" value="{{ $blogCategory->blog_category }}" id="example-text-input">
        @error('blog_category')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<!-- end row -->

<input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Update Blog Category ">
</form>
</div>
</div>
</div>
</div>

</div>
</div>

@endsection