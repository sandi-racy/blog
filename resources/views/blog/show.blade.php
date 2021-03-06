@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-8 blog-main">
            @if ($blog)
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $blog->title }}</h2>
                    <p class="blog-post-meta">
                        {{ $blog->created_at }}
                        <a href="#">{{ $blog->user->name }}</a>
                    </p>
                    <img src="{{ asset('images/banners/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid mb-1" />
                    {!! $blog->content !!}
                </div>
            @else
                <h3>Blog not found</h3>
            @endif
        </div>

        <aside class="col-md-4 blog-sidebar">
            <div class="p-3">
                <h4 class="font-italic">Archives</h4>
                <ol class="list-unstyled mb-0">
                    @foreach ($archives as $archive)
                        <li>{{ $months[$archive->month] }} {{ $archive->year }}</li>
                    @endforeach
                </ol>
            </div>
        </aside>
    </div>
@endsection