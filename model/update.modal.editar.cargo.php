<?php
require_once "../dao/class.update.php";

$updateLocal = new update('tCargo',"carNom='".$_POST['ModalempCar']."',carDca=".date('Y-m-d H:i:s'),'codCar='.$_POST['ModalIdCargo']);
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