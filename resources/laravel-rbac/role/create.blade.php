@extends('vr80s.laravel-rbac.layouts.main')

@section('main')
    @if(count($errors) > 0)
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Warning!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
        </div>
    @endif
    <div class="block">
        <div class="block-header">
            <span class="block-title">添加角色</span>
        </div>
        <div class="block-content">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('rbac/role/create') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label class="col-md-4 control-label">Role :</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Description :</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            添加
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
