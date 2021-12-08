@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-12">
            <a href="{{route('admin.posts.create')}}" class="btn btn-success">Add Post</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Posts List
                </div>
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-danger">{{ Session::get('message') }}</div>
                    @endif

                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th width="8%">#</th>
                                <th width="10%">Image</th>
                                <th width="36%">Title</th>
                                <th>Category</th>
                                <th>Tag</th>
                                <th width="7%">Status</th>
                                <th width="13%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>
                                    @if(!empty($post->image) && isset($post->image))
                                    <img src="{{ asset('Admin/uploads/images/' . $post->image) }}" alt="{{ $post->image }}" width="100"/>
                                    @else
                                    <img src="{{ asset('Admin/uploads/images/img-default.jpg') }}" alt="img-default.jpg" width="100"/>
                                    @endif
                                </td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td width="12%">
                                    @php
                                        $post_tag = '';
                                        foreach($post->tags as $tag){
                                            $post_tag .= $post_tag != '' ? ', ' . $tag->name : $tag->name;
                                        }
                                    @endphp
                                    {{ $post_tag }}
                                </td>
                                <td>
                                    @if ($post->published == 1)
                                        <span class="badge badge-success">Published</span>
                                    @else
                                        <span class="badge badge-secondary">UnPublished</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" id="btnView" class="btn btn-warning">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>

                                        <button type="submit" name="btnDelete" id="btnDelete" class="btn btn-danger">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>

                                        <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" id="btnEdit" class="btn btn-primary">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div> <!-- end .card-body -->
            </div> <!-- end .card -->
        </div> <!-- end .col-md-12 -->
    </div> <!-- end .row -->
</div>
@endsection