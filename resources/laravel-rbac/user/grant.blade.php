@extends('vr80s.laravel-rbac.layouts.main')

@section('main')
    <!-- style="display: none" -->
    <div class="alert" style="display: none" role="alert">
        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>操作完成</strong><span></span>
    </div>
    <div class="block">
        <div class="block-header">
            <span class="block-title">授权</span>
        </div>
        <div class="block-content">
            @if(!empty($roles))
                <table id="grant" class="table table-bordered">
                    <tbody>
                    @foreach($roles as $r)
                        <tr>
                            <td>
                                @if($userroleids->contains($r->id))
                                    <input type="checkbox" value="{!! $r->id !!}" checked>
                                @else <input type="checkbox" value="{!! $r->id !!}">
                                @endif
                            </td>
                            <td>{!! $r->name !!}</td>
                            <td>{!! $r->description !!}</td>
                        </tr>
                    @endforeach
                    <tr class="text-center">
                        <td colspan="3">
                            <button id="grant_save" class="btn btn-primary">保存</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection

@section('script')
    <script>
        var roleids = getCheckBoxVal('#grant');
        var csrf_token = getCsrfToken();
        var request_grant_url = "{!! url('rbac/user/'.$user->id.'/grant') !!}";

        $('#grant_save').click(function(){
            var newroleids = getCheckBoxVal('#grant');
            var data = { _token: csrf_token,roleids: newroleids};

            $.post(request_grant_url, data, function(res){
                if (res.code==0) {
                    alert.addClass('alert-success');
                }else{
                    alert.addClass('alert-warning');
                    setCheckBoxChecked('#grant', roleids);
                };
                $('.alert>span').text(res.msg);
                alert.show();
            }).error(function(){
                alert.addClass('alert-danger');
                setCheckBoxChecked('#grant', roleids);
                $('.alert>strong').text("呀呀!");
                $('.alert>span').text("意外错误");
                alert.show();
            })
        });


    </script>
@endsection
