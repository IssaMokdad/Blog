@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{url()->previous()}}">Back</a>
            <div class="border-0 card">
                <div class="border-0 card-body">
                    <form enctype="multipart/form-data" method="POST" action="{{ url('home/addpost') }}">
                        @csrf
                        <div class="form-group row">
                            <label style="margin-left:2em;" for="post title"
                                class="col-md-6 col-form-label text-md-right">Post Title</label>

                            <textarea id="title"
                                class="border border-primary form-control @error('title') border-danger is-invalid @enderror"
                                name="title" value="{{ old('title') }}" required autocomplete="name"
                                autofocus></textarea>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label style="margin-left:3em;" for="post content"
                                class="col-md-6 col-form-label text-md-right">Write your post</label>

                            <textarea rows='10' id="content"
                                class="border border-primary form-control @error('content') is-invalid @enderror"
                                name="content" required autocomplete="name" autofocus>{{ old('content') }}</textarea>

                            @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label style="margin-left:3em;" for="post content"
                                class="col-md-6 col-form-label text-md-right">Attach a photo</label>

                            <input type='file' id="image"
                                class="border border-primary form-control @error('image') is-invalid @enderror"
                                name="image" autocomplete="name" autofocus>

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button style="margin-left:7em;" type="submit" class=" btn btn-primary">
                                    {{ __('Add Post') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection