@extends('admin.admin_master')
@section('admin')
<div class="page-content">
<div class="container-fluid">

<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">All Blog Categories</h4>

</div>
</div>
</div>
<!-- end page title -->

<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-body">

        <h4 class="card-title">All Category data</h4>
        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
                <th>Serial Number</th>
                <th>Category Name</th>
                <th>Creation date</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @php($i = 1)
            @foreach($blogCategory as $item):
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->blog_category }}</td>
                <td>{{ $item->created_at}}</td>
                <td>
                    <a href="{{route('edit.blog.category', $item->id)}} " class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                    <a href="{{route('delete.blog.category' , $item->id)}}" id="delete" class="btn btn-danger sm" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    
    </div>
</div>
</div> <!-- end col -->
</div> <!-- end row -->

</div> <!-- container-fluid -->
</div>

@endsection