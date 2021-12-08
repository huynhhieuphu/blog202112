@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-8 offset-md-2">
            <a href="{{route('admin.categories.index')}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session()->get('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">Create Category</div>
                <div class="card-body">
                    <form action="{{route('admin.categories.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description: </label>
                            <textarea class="form-control" name="description" id="description" rows="5" style="resize: none"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Category: </label>
                            <select class="form-control @error('parent_id') is-invalid @enderror" name="parent_id" id="parent_id">
                                <option value="">Please choose a Category</option>
                                <option value="0">Root</option>
                            </select>
                            @error('parent_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('is_active') is-invalid @enderror" type="radio" name="is_active" id="InActive" value="0">
                                <label class="form-check-label" for="InActive">InActive</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('is_active') is-invalid @enderror" type="radio" name="is_active" id="Active" value="1" checked>
                                <label class="form-check-label" for="Active">Active</label>
                            </div>
                            @error('is_active')
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
