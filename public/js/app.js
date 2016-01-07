var alert = $('.alert');
$('button', alert).click(function(){
    $('.alert>strong').text(' ');
    $('.alert>span').text(' ');
    alert.hide();
})

function getCheckBoxVal(parent){
    var arr = new Array();
    var checkboxs = $("input[type='checkbox']", $(parent));
    checkboxs.each(function(){
        if($(this).prop("checked")){
            arr.push($(this).val());
        }
    });
    return arr;
}

function setCheckBoxChecked(parent, vals){
    var checkboxs = $("input[type='checkbox']", $(parent));
    checkboxs.each(function(){
        var checked = false;
        var v = $(this).val();

        for(x in vals){
            if(v == vals[x]){
                checked = true;
            }
        }
        if(checked){
            $(this).prop("checked", true);
        }else{
            $(this).prop("checked", false);
        }
    });

}

function getCsrfToken(){
    var token = $('#csrf_token').text();
    return token;
}