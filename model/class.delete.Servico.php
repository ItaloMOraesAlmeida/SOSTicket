<?php

require_once "../dao/class.delete.php";

$deleteLocal = new Delete('tServico',"codSer = ".$_POST['par']);
$array = $deleteLocal -> getDelete();
if($array['val'] == 1){
    echo '  <div class="alert alert-success">
                <strong>Deletado: </strong> Dados deletados com sucesso!
            </div>';
}else{
    echo '  <div class="alert alert-danger">'
                .$array['msg'].
            '</div>';
}