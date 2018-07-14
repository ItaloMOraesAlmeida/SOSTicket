<?php
require_once "../dao/class.update.php";

$updateLocal = new update('tLocal',"codEmp=".$_POST['ModalempresaEmpresa'].",locNom='".$_POST['ModalempLoc']."',locDca=Now()",'codLoc='.$_POST['ModalIdLocal']);
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