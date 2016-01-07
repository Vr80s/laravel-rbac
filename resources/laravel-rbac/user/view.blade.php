@extends('vr80s.laravel-rbac.layouts.main')

@section('main')
    <!-- style="display: none" -->
    <div class="alert" style="display: none" role="alert">
        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Warning!</strong><span></span>
    </div>
    <div class="block">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">基本信息</a></li>
            <li><a href="#grant" data-toggle="tab">授权</a></li>
            <li><a href="#password" data-toggle="tab">密码管理</a></li>
            <li><a href="#log" data-toggle="tab">最近动作</a></li>
        </ul>
        <div class="block-content tab-content">
            <div class="tab-pane active" id="home">
                @if(!empty($user))
                    {!! print_r($user) !!}
                @endif
            </div>
            <div class="tab-pane" id="grant">
                @if(!empty($roles))
                    <table class="table table-bordered">
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
            <div class="tab-pane" id="password">
                <div class="block">
                    <input name="newpassword" type="password" class="input input-sm">
                    <button id="password_set" class="btn btn-sm btn-primary">重置密码</button>
                </div>
            </div>
            <div class="tab-pane" id="log">
                <p>最近他什么都没干...</p>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        var roleids = getCheckBoxVal('#grant');
        var csrf_token = getCsrfToken();
        var request_grant_url = "{!! url('user/'.$user->id.'/grant') !!}";

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


        /*************/
        var request_password_url = "{!! url('user/'.$user->id.'/setpassword') !!}";
        $('#password_set').click(function(){
            var newpassword = $("input[name=newpassword]").val();
            var data = { _token: csrf_token, password: newpassword};
            console.log(data);

            $.post(request_password_url, data, function(res){
                if (res.code==0) {
                    alert.addClass('alert-success');
                }else{
                    alert.addClass('alert-warning');
                };
                $('.alert>span').text(res.msg);
                alert.show();
            }).error(function(){
                alert.addClass('alert-danger');
                $('.alert>strong').text("呀呀!");
                $('.alert>span').text("意外错误");
                alert.show();
            })
        });



    </script>
@endsection
