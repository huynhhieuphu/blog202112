@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-8 offset-md-2">
            <a href="{{route('admin.posts.index')}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session()->get('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">Create Post</div>
                <div class="card-body">
                    <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control @error('title')
                                is-invalid
                            @enderror" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">Please a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control @error('image')
                                is-invalid
                            @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="summary">Summary</label>
                            <textarea name="summary" id="summary" rows="5" class="form-control @error('summary')
                                is-invalid
                            @enderror" style="resize: none;">{{ old('summary') }}</textarea>
                            @error('summary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" rows="10" class="form-control @error('content') is-invalid @enderror" style="resize: none;">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <input type="text" name="tags" id="tags" class="form-control" value="{{ old('content') }}">
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('published') is-invalid @enderror" type="radio" name="published" id="unPublished" value="0">
                                <label class="form-check-label" for="unPublished">UnPublished</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('published') is-invalid @enderror" type="radio" name="published" id="published" value="1" checked>
                                <label class="form-check-label" for="published">Published</label>
                            </div>
                            @error('published')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                           
                        </div>

                        <button type="submit" class="btn btn-success">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
