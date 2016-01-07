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
            <span class="block-title">{!! $role->name !!}</span>
        </div>
        <div class="block-content">
            <div class="row">
                <label>Role :</label>
                    <p>{!! $role->name !!}</p>
                <label>Description :</label>
                    <p>{!! $role->description !!}</p>
                <hr>

                @if(count($users)>0)
                <strong>已授权的用户:</strong>
                <ul class="list-group">
                        @foreach($users as $u)
                            <li class="list-group-item">{{ $u->name }}</li>
                        @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>


@endsection
