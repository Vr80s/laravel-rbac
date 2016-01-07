@extends('vr80s.laravel-rbac.layouts.main')

@section('main')
    @if(count($errors) > 0)
        @if($errors['type']=='info')
            <div class="alert alert-success alert-dismissible" role="alert">
                @else <div class="alert alert-warning alert-dismissible" role="alert">
        @endif
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p>{!! $errors['msg'] !!}</p>
        </div>
    @endif
    <div class="block">
        <div class="block-header">
            <span class="block-title">角色管理</span>
        </div>
        <div class="block-content">
            <div class="block-content-title">
                <a href="{!! url('rbac/role/create') !!}" class="btn btn-sm btn-primary">添加角色</a>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Role</th>
                    <th>RoleDesc</th>
                    <th>CreateDate</th>
                    <th>UpdateDate</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                {{--@if ($roles->count() > 0)--}}
                @if (!empty($roles))
                    @foreach($roles as $role)
                        <tr>
                            <td>
                                <a href="{!! url('rbac/role').'/'.$role->id !!}">{!! $role->name !!}</a>
                            </td>
                            <td>{!! $role->description !!}</td>
                            <td>{!! $role->created_at !!}</td>
                            <td>{!! $role->updated_at !!}</td>
                            <td>
                                <a href="{!! url('rbac/role/'.$role->id).'/edit' !!}" class="btn btn-sm">编辑</a>
                                /<a href="{!! url('rbac/role/'.$role->id.'/permit') !!}" class="btn btn-sm">授权</a>
                                /<a href="{!! url('rbac/role/'.$role->id.'/delete') !!}" class="btn btn-sm">删除</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (empty($roles))
                    <tr>
                        <td colspan="5">没有数据</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{--{!! paginator($roles)->render() !!}--}}
        </div>
    </div>


@endsection
