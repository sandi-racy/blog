
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <title>Blog Template for Bootstrap</title>
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
        <link href="{{ asset('css/blog.min.css') }}" rel="stylesheet" />
        @section('styles')
        @show
    </head>

    <body>
        <div class="container">
            <header class="blog-header py-3">
                <div class="row flex-nowrap justify-content-between align-items-center">
                    <div class="col-12 text-center">
                        <a class="blog-header-logo text-dark" href="{{ url('/') }}">Sociolla</a>
                    </div>
                </div>
            </header>

            <div class="nav-scroller py-1 mb-2">
                <nav class="nav d-flex justify-content-between">
                    @foreach ($menus as $menu)
                        <a class="p-2 text-muted" href="{{ url('tags/' . $menu->slug) }}">{{ $menu->name }}</a>
                    @endforeach
                    <a class="p-2 text-muted" href="{{ url('blog/create') }}">Create New Blog</a>
                </nav>
            </div>

            @include('message')

            @yield('content')

        </main>

        <footer class="blog-footer">
            <p>
                Blog built for <a href="https://sociolla.com/" target="_blank">Sociolla</a> by <a href="https://github.com/sandi-racy" target="_blank">Sandi Rosyandi</a>.
            </p>
            <p>
                <a href="#">Back to top</a>
            </p>
        </footer>

        @section('scripts')
        @show
    </body>
</html>