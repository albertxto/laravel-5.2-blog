@extends('master')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url({{ url('img/about-bg.jpg') }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <h1>Create Post</h1>
                        <span class="subheading">Create A New Post.</span>
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

                <form action="{{ url('/posts/store') }}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" />
                    </div>

                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control" name="content" rows="4"></textarea>
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