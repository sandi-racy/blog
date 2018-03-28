@if (session('success'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">{{ session('success') }}</div>
        </div>
    </div>
@endif

@if (session('fail'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">{{ session('fail') }}</div>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif