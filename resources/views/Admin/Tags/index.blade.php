@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-12">
            <a href="{{route('admin.tags.create')}}" class="btn btn-success">Add Tag</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Tag List
                </div>
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-danger">{{ Session::get('message') }}</div>
                    @endif

                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th>Name</th>
                                <th width="12%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                            <tr>
                                <td>{{$tag->id}}</td>
                                <td>{{$tag->name}}</td>
                                <td>
                                    <form action="{{route('admin.tags.destroy', ['tag' => $tag->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>

                                        <a href="{{route('admin.tags.edit', ['tag' => $tag->id])}}" class="btn btn-primary btn-sm">Edit</a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $tags->links() }}
                </div> <!-- end .card-body -->
            </div> <!-- end .card -->
        </div> <!-- end .col-md-12 -->
    </div> <!-- end .row -->
</div>
@endsection
