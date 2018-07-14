this.ajaxPost = function(e,t,n,r){
    if(typeof n=="undefined"){
        n=false
    }
    if(typeof r=="undefined"){
        r=false
    }
    var i=$("form").serialize();
    $.ajax({
        type:"post",url:e,data:i,beforeSend:function(){
            $("#carregando").show();
            $(t).html("Carregando...")
        },
        success:function(e){
            $(t).hide();
            $(t).html(e);
            $(t).fadeIn("slow");
            $("#carregando").hide();
            if(n){
                n.call()
            }
        },
        error:function(){
            alert("ERRO! Não foi possivel executar a função! Detalhes: Erro de Sintaxe!");
            return false
        }
    });
    if(r){
        setTimeout(function(){
            $(t).hide()
        },1e4)
    }
    return true
}

this.ajaxFunction = function(url,par,ret){
    $.ajax({
        type: 'post',
        url: url,
        data: {par : par},
        beforeSend: function(){
            $("#carregando").show();
            $(ret).html("Carregando...");
        },
        success: function(url){
            $(ret).hide();
            $(ret).html(url);
            $(ret).fadeIn("slow");
            $("#carregando").hide();
        },
        error: function(){
            alert("Erro");
            return false;
        }
    });
    return true;
}