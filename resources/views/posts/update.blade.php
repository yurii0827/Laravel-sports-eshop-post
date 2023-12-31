@extends('layouts.admin1')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5 mb-5">
                <div class="card">
                    <div class="card-header">{{ __('Straipsnio redagavimas') }}</div>
                    <div class="card-body">
                        <form action="{{ route('posts.update', $post->id) }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                            <div class="mb-3">
                                <label class="form-label text-white">{{ __('Naujienos antraštė') }}</label>
                                <input class="form-control" type="text" name="title" value="{{$post->title}}">

                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white">{{ __('Visas straipsnis') }}</label>
                                <textarea rows="10" class="form-control tinymce-editor" type="text"
                                          name="post">{{{ $post->post }}}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label mx-2 text-white">{{ __('Straipsnio nuotrauka') }}</label>
                                <input type="file" class="form-control" name="img">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white">{{ __('Nuotraukos autorius') }}</label>
                                <input class=" form-control @error('photoauthor') is-invalid @enderror" type="text" name="photoauthor"
                                value="{{$post->photoauthor}}">
                                @error('photoauthor')
                                @foreach( $errors->get('photoauthor') as $error)
                                    <div class="alert alert-danger"> {{ $error }} </div>
                                @endforeach
                                @enderror
                            </div>


                            <button class="btn btn-primary">{{ __('Atnaujinti') }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

