@extends('layout')

@section('content')
<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
            <h1 class="display-4 font-italic">{{ $headline->title }}</h1>
            <p class="lead my-3">{{ $headline->summary }}</p>
            <p class="lead mb-0">
                <a href="{{ url('blog/' . $headline->slug) }}" class="text-white font-weight-bold">Continue reading...</a>
            </p>
        </div>
    </div>

    <div class="row mb-2">
        @foreach ($featureds as $featured)
            <div class="col-md-6">
                <div class="card flex-md-row mb-4 box-shadow h-md-250">
                    <div class="card-body d-flex flex-column align-items-start">
                        <strong class="d-inline-block mb-2 text-primary">{!! \App\Http\Controllers\BlogController::renderTags($featured->tags) !!}</strong>
                        <h3 class="mb-0">
                            <a class="text-dark" href="{{ url('blog/' . $featured->slug) }}">{{ $featured->title }}</a>
                        </h3>
                        <div class="mb-1 text-muted">{{ $featured->created_at }}</div>
                        <p class="card-text mb-auto">{{ $featured->summary }}</p>
                        <a href="{{ url('blog/' . $featured->slug) }}">Continue reading</a>
                    </div>
                    <img class="card-img-right flex-auto d-none d-md-block" alt="{{ $featured->title }}" src="{{ asset('images/thumbnails/' . $featured->image) }}" />
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-8 blog-main">
            @foreach ($blogs as $blog)
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $blog->title }}</h2>
                    <p class="blog-post-meta">
                        {{ $blog->created_at }}
                        <a href="#">{{ $blog->user->name }}</a>
                    </p>
                    <p>{{ $blog->summary }}</p>
                </div>
            @endforeach

            {{ $blogs->links('vendor.pagination.simple-default') }}

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