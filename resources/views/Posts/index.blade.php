@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header">New Posts</h2>
                <div class="card-body">
                    @foreach ($posts as $post)
                    <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="mb-3 text-decoration-none text-dark">
                        <article>
                            <div class="row">
                                <div class="col-4">
                                    @if (!empty($post->image) && isset($post->image))
                                    <img class="card-img-top img-fluid" src="{{ asset('Admin/uploads/images/' . $post->image) }}" alt="{{ $post->image }}">
                                    @else
                                    <img class="card-img-top img-fluid" src="{{ asset('Admin/uploads/images/img-default.jpg') }}" alt="img-default.jpg">
                                    @endif
                                </div>
                                <div class="col-8">
                                    <h3 class="card-title">{{ $post->title }}</h3>
                                    <p class="card-text">{{ $post->summary }}</p>
                                </div>
                            </div>
                            <hr>
                        </article>
                    </a>
                    @endforeach
                </div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection