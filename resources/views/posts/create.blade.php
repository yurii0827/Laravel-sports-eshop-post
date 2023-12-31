@extends('layouts.admin1')
@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-12 mt-5 mb-5">
                <div class="card">
                    <div class="card-header">{{ __('Straipsnio sukūrimo forma') }}</div>
                    <div class="card-body">
                        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                            <div class="mb-3">
                                <label class="form-label text-white">{{ __('Naujienos antraštė') }}</label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                       name="title" value="{{old('title')}}">
                                @error('title')
                                @foreach( $errors->get('title') as $error)
                                    <div class="alert alert-danger"> {{ $error }} </div>
                                @endforeach
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white">{{ __('Visas straipsnis') }}</label>

                                <textarea rows="10"
                                          class="form-control tinymce-editor @error('post') is-invalid @enderror"
                                          type="text" name="post" value="{{old('post')}}"></textarea>
                                @error('post')
                                @foreach( $errors->get('post') as $error)
                                    <div class="alert alert-danger"> {{ $error }} </div>
                                @endforeach
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for=""
                                       class="form-label mx-2 text-white">{{ __('Straipsnio nuotrauka') }}</label>
                                <input type="file" class="form-control" name="img">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white">{{ __('Nuotraukos autorius') }}</label>
                                <input class=" form-control @error('photoauthor') is-invalid @enderror" type="text"
                                       name="photoauthor" value="{{old('photoauthor')}}">
                                @error('photoauthor')
                                @foreach( $errors->get('photoauthor') as $error)
                                    <div class="alert alert-danger"> {{ $error }} </div>
                                @endforeach
                                @enderror
                            </div>

                            <button class="btn btn-primary">Post</button>
                            <a class="btn btn-success mx-3 float-end" href="{{ route('admin.posts') }}">Go Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

