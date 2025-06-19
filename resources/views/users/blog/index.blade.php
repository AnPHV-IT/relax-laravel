@extends('layouts.user')

@section('title', 'Danh Sách Bài Viết Blog')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/blog/blog.css') }}">

@section('content')   
    <div claauto !important;="container">
        @if($posts->isEmpty())
            <p>Không có bài viết nào.</p>
        @else
            <div class="list-group mt-3">
                @foreach($posts as $post)
                    <a href="{{ route('blog.show', $post->id) }}" class="list-group-item list-group-item-action">
                        <h5>{{ $post->title }}</h5>
                        <p>{{ Str::limit($post->content, 100) }}</p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection
