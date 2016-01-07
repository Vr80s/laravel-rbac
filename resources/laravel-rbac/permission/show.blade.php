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
            <span class="block-title">
                <strong>Permission - </strong>
                @if(!empty($permission->description))
                    <strong>{!! $permission->description !!}</strong>[{!! $permission->uri !!}]
                    @else {!! $permission->uri !!}
                @endif
            </span>
        </div>
        <div class="block-content">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('rbac/permission/'.$permission->id) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <label class="col-md-2">Uri :</label>
                    {!! $permission->uri !!}
                </div>
                <div class="row">
                    <label class="col-md-2">Method :</label>
                    {!! $permission->method !!}
                </div>
                <div class="row">
                    <label class="col-md-2">Action :</label>
                    {!! $permission->action !!}
                </div>
                <div class="row">
                    <label class="col-md-2">Status :</label>
                    @if($permission->status == 'VALID')
                        <span class="label label-success">{!! $permission->status !!}</span>
                    @else
                        <span class="label label-danger">{!! $permission->status !!}</span>
                    @endif
                </div>
                <div class="row">
                    <label class="col-md-2">Description :</label>
                    <input type="text" name="description" value="{!! $permission->description !!}">
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-sm btn-primary">
                            保存
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
