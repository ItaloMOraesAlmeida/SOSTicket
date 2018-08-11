<?php
require_once "../dao/class.update.php";

$updateLocal = new update('tServico',"serNom='".$_POST['ModalempSer']."',serDca=".date('Y-m-d H:i:s').",codTco=".$_POST['modalTempoConclusaoEmpresa'].",codLoc=".$_POST['modalSetorEmpresa']."",'codSer='.$_POST['ModalIdServico']);
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