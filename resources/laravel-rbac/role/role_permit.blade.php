@extends('vr80s.laravel-rbac.layouts.main')

@section('main')
    <div class="alert" style="display: none" role="alert">
        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Warning!</strong><span></span>
    </div>
    <div class="block">
        <div class="block-header">
            <span class="block-title">角色授权</span>
        </div>
        <div class="block-content">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Permission</th>
                    <th>Type</th>
                    <th>Seleted</th>
                </tr>
                </thead>
                <tbody>
                @if (!empty($permissions))
                    @foreach($permissions as $p)
                        <tr>
                            <td>
                                @if(!empty($p->description))
                                    <strong>{!! $p->description !!}</strong>[{!! $p->uri !!}]
                                    @else {!! $p->uri !!}
                                @endif
                            </td>
                            <td>{!! $p->method !!}</td>
                            @if($rolePermissions->contains($p->id))
                                <td><input type="checkbox" value="{!! $p->id !!}" checked></td>
                                @else <td><input type="checkbox" value="{!! $p->id !!}"></td>
                            @endif
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="6" class="text-center">
                            <button id="role_permit_save" class="btn btn-primary">保存</button>
                        </td>
                    </tr>
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


@endsection

@section('script')
    <script>
        var vals = getCheckBoxVal('.table');
        var csrf_token = getCsrfToken();
        var request_grant_url = "{!! url('role/'.$role->id.'/permit') !!}";

        $('#role_permit_save').click(function(){
            var newvals = getCheckBoxVal('.table');
            var data = { _token: csrf_token,permissions: newvals};

            $.post(request_grant_url, data, function(res){
                if (res.code==0) {
                    alert.addClass('alert-success');
                }else{
                    alert.addClass('alert-warning');
                    setCheckBoxChecked('.table', vals);
                };
                $('.alert>span').text(res.msg);
                alert.show();
            }).error(function(){
                alert.addClass('alert-danger');
                setCheckBoxChecked('.table', vals);
                $('.alert>strong').text("呀呀!");
                $('.alert>span').text("意外错误");
                alert.show();
            })
        });

    </script>
@endsection
