@extends('master')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/home-bg.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        @if ($query)
                        <h1>Search Result: {{ $query }}</h1>
                        @else
                        <h1>Laravel Blog</h1>
                        <span class="subheading">A Blog Theme by Start Bootstrap</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif

        @if (count($posts))
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @foreach($posts as $post)
                <div class="post-preview">
                    <a href="{{ url('/posts', $post->id) }}">
                        <h2 class="post-title">
                            {{ $post->title }}
                        </h2>
                        <img class="img-fluid" src="{{ url('/upload', $post->image) }}" />
                        <h3 class="post-subtitle">
                            {{ trim(substr($post->content, 0, 20)) }}...
                        </h3>
                    </a>
                    <p class="post-meta">Posted by <a href="{{ url('/user', $post->user->id) }}">{{ $post->user->name }}</a> on {{ date("F d, Y", strtotime($post->created_at)) }}</p>
                </div>
                @if (Auth::check() && Auth::user()->id === $post->user_id)
                <a href="{{ url('/posts/edit', $post->id) }}" class="btn btn-primary">Edit</a>

                <form action="{{ url('/posts/destroy', $post->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this post?')">
                    {!! csrf_field() !!}
                    {{ method_field('DELETE') }}
                    
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                @endif
                <hr>
                @endforeach

                <!-- Pager -->
                <!--<div class="clearfix">
                    <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
                </div>-->
                {{ $posts->links() }}
            </div>
        </div>
        @endif
    </div>
@endsection