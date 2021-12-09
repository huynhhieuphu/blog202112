@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">{{ $post->title }}</h2>
                </div>
                
                <div class="card-body">
                    @isset($post->summary)
                        <h6 class="card-subtitle mb-2 text-muted">{!! $post->summary !!}</h6>
                    @endisset

                    @if (!empty($post->image) && isset($post->image))
                        <img class="card-img-top img-fluid" src="{{ asset('Admin/uploads/images/' . $post->image) }}" alt="{{ $post->image }}">
                    @else
                        <img class="card-img-top img-fluid" src="{{ asset('Admin/uploads/images/img-default.jpg') }}" alt="img-default.jpg">
                    @endif
                    

                    <p class="card-text">
                        <div class="btn btn-outline-secondary" id="category">{!! $post->category->name !!}</div>
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
                        @foreach ($post->tags as $tag)
                            <span class="badge badge-secondary">{{ $tag->name }}</span>
                        @endforeach
                    </p>
                    <p class="card-text">
                        {!! $post->content !!}
                    </p>
                </div>
            </div> {{-- end .card --}}
        </div> {{-- end .col-md-12 --}}
    </div>
</div>
@endsection