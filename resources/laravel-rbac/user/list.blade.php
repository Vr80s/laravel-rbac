@extends('vr80s.laravel-rbac.layouts.main')

@section('main')
    <div class="block">
        <div class="block-header">
            <span class="block-title">用户管理</span>
        </div>
        <div class="block-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>UserName</th>
                        <th>Email</th>
                        <th>RegisterDate</th>
                        <th>LastLogin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                {{--@if ($users->count() > 0)--}}
                @if (!empty($users))
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <a href="{!! url('/user').'/'.$user->id !!}">{!! $user->name !!}</a>
                            </td>
                            <td>{!! $user->email !!}</td>
                            <td>{!! $user->created_at !!}</td>
                            <td>{!! $user->updated_at !!}</td>
                            <td><a href="{!! url('rbac/user/'.$user->id.'/grant') !!}">授权</a></td>
                        </tr>
                    @endforeach
                @endif
                @if (empty($users))
                    <tr>
                        <td colspan="5">没有数据</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {!! $users->render() !!}
        </div>
    </div>

@endsection
