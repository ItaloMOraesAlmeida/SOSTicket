<?php
require_once "../dao/class.update.php";

$updateLocal = new update('tSituacao',"sitNom='".$_POST['ModalempSit']."',sitDca=".date('Y-m-d H:i:s'),'codSit='.$_POST['ModalIdSituacao']);
$array = $updateLocal -> getUpdate();
if($array['val'] == 1){
    echo '  <div class="alert alert-success">
                <strong>Salvo: </strong> Dados inseridos com sucesso!
            </div>';
}else{
    echo '  <div class="alert alert-danger">'
                .$array['msg'].
            '</div>';
}