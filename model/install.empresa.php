<?php

require_once "../dao/class.insert.php";
require_once "class.upload.Simples.php";

$date = date('Y-m-d H:i:s');

switch ($_GET['tip']) {
    case 1:
        $arquivo = new UploadSimples();
        $retorno = $arquivo -> Upload($_FILES['empLogo']);

        if($retorno['ret'] == 1){
            $Insert = new Insert('tEmpresa','',"'".$_POST['empNom']."','".$_POST['empCnpj']."','".$_POST['empPais']."','".$_POST['empEstado']."','".$_POST['empCidade']."','".$_POST['empComplemento']."','".$_POST['empCep']."','".$_POST['empTel']."','".$retorno['arquivo']."',1,'$date',Null");
        }

        $ret = 1;
        break;
    case 2:
        $Insert = new Insert('tLocal','',"".$_POST['empresaEmpresa'].",'".$_POST['empLoc']."',1,'$date',Null");
        break;
    case 3:
        $Insert = new Insert('tCargo','',"'".$_POST['empCarg']."',1,'$date',Null");
        break;
    case 4:
        $Insert = new Insert('tSituacao','',"'".$_POST['empSit']."',1,'$date',Null");
        break;
    case 5:
        $Insert = new Insert('tServico','',"'".$_POST['empServ']."',1,'$date',Null,".$_POST['tempoConclusaoEmpresa'].",".$_POST['setorEmpresa']."");
        break;
    case 6:
        header('Location: ../view/form.install.adm.php');
        break;
    default:
        $ret = 1;
        echo '  <div class="alert alert-danger">
                    <strong>Erro: </strong> Não foi possivel executar esta função!
                </div>';
        break;
}

if($ret != 1){
    $array = $Insert -> getInsert();

    if($array['val'] == 1){
        echo '  <div class="alert alert-success">
                    <strong>Salvo: </strong> Dados inseridos com sucesso!
                </div>';
    }else{
        echo '  <div class="alert alert-danger">'
                    .$array['msg'].
                '</div>';
    }
}