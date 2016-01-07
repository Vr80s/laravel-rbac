@extends('vr80s.laravel-rbac.layouts.main')

@section('main')
    @if(count($errors) > 0)
        @if($errors['type']=='info')
                <div class="alert alert-success alert-dismissible" role="alert">
            @else
                <div class="alert alert-warning alert-dismissible" role="alert">
        @endif
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span></button>
                   <p>{!! $errors['msg'] !!}</p>
               </div>
     @endif
    <div class="block">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#permissions" data-toggle="tab">所有权限</a></li>
            <li><a href="#valid" data-toggle="tab">生效权限</a></li>
            <li><a href="#invalid" data-toggle="tab">失效权限</a></li>
            <li class="pull-right">
                <a href="{!! url('rbac/permission/sync') !!}"><i class="fa fa-refresh text-primary"></i></a>
            </li>
        </ul>
        <div class="block-content tab-content">
            <div class="tab-pane active" id="permissions">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Uri</th>
                        <th>Method</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Update_at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($permissions)>0)
                        @foreach($permissions as $p)
                            <tr>
                                <td>{!! $p->uri !!}</td>
                                <td>{!! $p->method !!}</td>
                                <td>{!! $p->description !!}</td>
                                <td>
                                    @if($p->status == 'VALID')
                                        <span class="label label-success">{!! $p->status !!}</span>
                                    @else
                                        <span class="label label-danger">{!! $p->status !!}</span>
                                    @endif
                                </td>
                                <td>{!! $p->updated_at !!}</td>
                                <td>
                                    @if($p->status == 'VALID')
                                        <a href="{!! url('rbac/permission/'.$p->id) !!}">编辑</a>
                                        @else
                                            <a href="{!! url('rbac/permission/'.$p->id.'/delete') !!}">删除</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    @if (empty($permissions))
                        <tr>
                            <td colspan="6">没有数据</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="valid">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Uri</th>
                        <th>Method</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Update_at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($permissions)>0)
                        @foreach($permissions as $p)
                            @if($p->status == 'VALID')
                                <tr>
                                    <td>{!! $p->uri !!}</td>
                                    <td>{!! $p->method !!}</td>
                                    <td>{!! $p->description !!}</td>
                                    <td>
                                        <span class="label label-success">{!! $p->status !!}</span>
                                    </td>
                                    <td>{!! $p->updated_at !!}</td>
                                    <td>
                                        <a href="{!! url('rbac/permission/'.$p->id) !!}">编辑</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    @if (empty($permissions))
                        <tr>
                            <td colspan="6">没有数据</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="invalid">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Uri</th>
                        <th>Method</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Update_at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($permissions)>0)
                        @foreach($permissions as $p)
                            @if($p->status == 'INVALID')
                                <tr>
                                    <td>{!! $p->uri !!}</td>
                                    <td>{!! $p->method !!}</td>
                                    <td>{!! $p->description !!}</td>
                                    <td>
                                        <span class="label label-danger">{!! $p->status !!}</span>
                                    </td>
                                    <td>{!! $p->updated_at !!}</td>
                                    <td>
                                        <a href="{!! url('rbac/permission/'.$p->id.'/delete') !!}">删除</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    @if (empty($permissions))
                        <tr>
                            <td colspan="6">没有数据</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
