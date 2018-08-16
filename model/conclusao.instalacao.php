<?php

require_once "../dao/class.insert.php";

$nomAdm = $_POST['nomAdm'];
$sobAdm = $_POST['sobAdm'];
$emaAdm = $_POST['emaAdm'];
$logAdm = $_POST['logAdm'];
$pasAdm = $_POST['pasAdm'];

$Insert = new Insert('tUsuario','',"'".$nomAdm."','".$sobAdm."','".$emaAdm."','".$logAdm."','".md5($pasAdm)."','00000000000','".date('Y-m-d H:i:s')."',00000000000,'I','".date('Y-m-d H:i:s')."',Null,1,1,1,1,1");

$array = $Insert -> getInsert();

if($array['val'] == 1){
    rename('conclusao.instavacao.php','conclusao.instalacao.conf.php');
    header('location: ../index.php');
}else{
    echo '  <div class="alert alert-danger">'
                .$array['msg'].
            '</div>';
}