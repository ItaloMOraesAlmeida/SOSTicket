<?php

require_once "class.conexao.php";

$log = new Conexao();

$teste = $log -> autenticar($_POST['logUser'],$_POST['logPass']);

if($teste){
    echo '  <div class="alert alert-success">
                <strong>Sucesso: </strong> Usuário autenticado com sucesso!
            </div>';
}else{
    echo '  <div class="alert alert-danger">
                <strong>Erro: </strong> Usuário não encontrado!
            </div>';
}