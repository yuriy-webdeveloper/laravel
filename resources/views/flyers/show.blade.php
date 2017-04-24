@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <h1>{{ $flyer->street }}</h1>
            <h2>{{ $flyer->price }}</h2>
            <h2>User ID: {{ $flyer->user_id }}</h2>
            <h2>Current user ID: {{ Auth::id() }}</h2>

            <hr>

            <div class="descripton">{!! nl2br($flyer->description) !!}</div>
        </div>

        <div class="col-md-8 gallery">
            @foreach($flyer->photos->chunk(4) as $set)
                <div class="row">
                    @foreach($set as $photo)
                        <div class="col-md-3 gallery__image">
                            <form method="POST" action="/photos/{{$photo->id}}" >
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" name="" id="" class="btn btn-default">Delete</button>
                            </form>
                            <a href="/{{$photo->path}}" data-lity>
                                <img src="/{{$photo->thumbnail_path}}" alt="">
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach

            @if($user && $user->owns($flyer))
                <form method="POST"
                      id="addPhotos"
                      class="dropzone"
                      action="{{route('store_photo', [$flyer->zip, $flyer->street])}}"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    @endif
                </form>
        </div>

    </div>

    <hr>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
    <script>
        Dropzone.options.addPhotos = {
            paramName: 'photo',
            maxFilesize: 2,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp',
        }
    </script>


@stop