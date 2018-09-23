@extends('master')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url({{ url('/upload', $post->image) }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <h1>Edit Post</h1>
                        <span class="subheading">Edit the Old Post.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">

                @if ($errors->all())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </div> 
                @endif

                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif

                <form action="{{ url('/posts/update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $post->title }}" />
                    </div>

                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control" name="content" rows="4">{{ $post->content }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control-file" name="image" />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ url('/posts') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection