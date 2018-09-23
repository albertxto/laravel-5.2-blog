@extends('master')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url({{ url('/upload', $post->image) }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{{ $post->title }}</h1>
                        <!--<h2 class="subheading">Problems look mighty small from 150 miles up</h2>-->
                        <span class="meta">Posted by <a href="#">{{ $post->user->name }}</a> on {{ date("F d, Y", strtotime($post->created_at)) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <p>{{ $post->content }}</p>
                </div>
            </div>

            @if (Auth::check())
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <a href="{{ url('/posts/edit', $post->id) }}" class="btn btn-primary">Edit</a>

                    <form action="{{ url('/posts/destroy', $post->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this post?')">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </article>
@endsection