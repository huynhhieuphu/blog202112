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
            <div class="card">            
                @if (!empty($post->image) && isset($post->image))
                <img class="card-img-top img-thumbnail img-fluid" src="{{ asset('Admin/uploads/images/' . $post->image) }}" alt="{{ $post->image }}">
                @else
                <img class="card-img-top img-thumbnail img-fluid" src="{{ asset('Admin/uploads/images/img-default.jpg') }}" alt="img-default.jpg">
                @endif
                
                <div class="card-body">
                    <h4 class="card-title">{{ $post->title }}</h4>
                    @isset($post->summary)
                        <h6 class="card-subtitle mb-2 text-muted">{!! $post->summary !!}</h6>
                    @endisset
                    <p class="card-text">
                        <div class="btn btn-outline-secondary" id="category">{{ $post->category->name }}</div>
                    </p>
                    <p class="card-text">
                        <span>
                            <i class="fa fa-user-o" aria-hidden="true"></i> 
                            {{ $post->author->name }}
                        </span> |
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i> 
                            {{ date('d/m/Y', strtotime($post->created_at)) }}
                        </span>
                    </p>
                    <p class="card-text">
                        {!! $post->content !!}
                    </p>
                    <p class="card-text">
                        @foreach ($post->tags as $tag)
                            <span class="badge badge-secondary">{{ $tag->name }}</span>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
