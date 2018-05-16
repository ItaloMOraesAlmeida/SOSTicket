$(document).ready(function(){
    $("a[rel=modal]").click( function(ev){
        ev.preventDefault();
 
        var id = $(this).attr("href");
 
        var alturaTela = $(document).height();
        var larguraTela = $(window).width();
     
        //colocando o fundo preto
        $('#mascara').css({'width':larguraTela,'height':alturaTela});
        $('#mascara').fadeIn(1000); 
        $('#mascara').fadeTo("slow",0.8);
 
        var center = ($(window).width() /2) - ( $(id).width() / 2 );
        var top = ($(window).height() / 2) - ( $(id).height() / 2 );
     
        $(id).css({'top':top,'center':center});
        $(id).show();   
    });
 
    $("#mascara").click( function(){
        $(this).hide();
        $(".window").hide();
    });
 
    $('.fechar').click(function(ev){
        ev.preventDefault();
        $("#mascara").hide();
        $(".window").hide();
    });
});

/* Arquivo de inserção de dados de acesso 

    $("button[name=btn_ins_ace]").click(function() {
   
    $.post("../php/in_acesso.php",{ins_ace: $(this).val(),
    host:$("#host").val(),
    bd:$("#bd").val(),
    u_bd:$("#u_bd").val(),
    s_bd:$("#s_bd").val(),
    usuario:$("#usuario").val(),
    senha:$("#senha").val()
    
    },
    function(valor) {
      $("L[name=troca_btn]").html(valor);
    })
})*/
                










