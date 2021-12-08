@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-12">
            <a href="{{route('admin.categories.create')}}" class="btn btn-success">Add Category</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Categories List
                </div>
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-danger">{{ Session::get('message') }}</div>
                    @endif

                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="38%">Category</th>
                                <th>Parent</th>
                                <th>Status</th>
                                <th width="12%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->parent_id}}</td>
                                <td>
                                    @if ($category->is_active == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-secondary">InActive</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{route('admin.categories.destroy', ['category' => $category->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{route('admin.categories.edit', ['category' => $category->id])}}" class="btn btn-primary btn-sm">Edit</a>

                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div> <!-- end .card-body -->
            </div> <!-- end .card -->
        </div> <!-- end .col-md-12 -->
    </div> <!-- end .row -->
</div>
@endsection
