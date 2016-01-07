@extends('vr80s.laravel-rbac.layouts.app')

@section('content')
    @include('vr80s.laravel-rbac.layouts.navbar')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                @include('vr80s.laravel-rbac.layouts.sidebar')
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                @yield('main')
            </div>
        </div>
    </div>
@endsection
