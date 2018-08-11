$(document).ready(function(){
    /* #arquivo é o id do input, ao alterar o conteudo do input execurará a função baixo */
    $('#btnSavDadosEmp').on('click',function(){
        $('#visualizar').html('<img src="ajax-loader.gif" alt="Enviando..."/> Enviando...');
        /* Efetua o Upload sem dar refresh na pagina */           
        $('#formularioEmpresa').ajaxForm({
            target:'#retornos' // o callback será no elemento com o id #visualizar
        }).submit();
    });
})