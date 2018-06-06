<?php

// REQUISIÇÕES
require_once '../dao/autenticaDB.php';
require_once '../dao/autenticaLDAP.php';
require_once 'autenticaEMAIL.php';


// Variaveis

echo 'Excluir Banco Existente: '.$_POST['checkDB'].'<br>';
echo 'Tipo de Base: '.$_POST['tipbase'].'<br>';
echo 'Host Banco de dados: '.$_POST['hostBD'].'<br>';
echo 'Banco de Dados: '.$_POST['database'].'<br>';
echo 'Usuário Banco de dados: '.$_POST['usernameBD'].'<br>';
echo 'Senha Banco de Dados: '.$_POST['passwordBD'].'<br>';
echo 'Autenticação Pelo AD: '.$_POST['checkAD'].'<br>';
echo 'Tipo de AD: '.$_POST['tipAD'].'<br>';
echo 'Host do AD: '.$_POST['hostAD'].'<br>';
echo 'Posta do AD: '.$_POST['portaAD'].'<br>';
echo 'Dominío do AD: '.$_POST['domiAD'].'<br>';
echo 'Verção do Protocolo do AD: '.$_POST['verProtAD'].'<br>';
echo 'Charset do Email: '.$_POST['charsetEmail'].'<br>';
echo 'Host do Email: '.$_POST['hostEmail'].'<br>';
echo 'Porta do Email: '.$_POST['portaEmail'].'<br>';
echo 'Protocolo do Email: '.$_POST['protocoloEmail'].'<br>';
echo 'Altenticação do Email: '.$_POST['autenticacaoEmail'].'<br>';
echo 'Usuário do Email: '.$_POST['userEmail'].'<br>';
echo 'Senha do usuário do Email: '.$_POST['passEmail'].'<br>';
echo 'Email do Remetente do Email: '.$_POST['remetenteEmail'].'<br>';
echo 'Nome do Remetente do Email: '.$_POST['nomeRemetenteEmail'].'<br>';
echo 'Email para o envio de teste: '.$_POST['emailTeste'].'<br>';
echo 'Primeiro Nome do Administrador: '.$_POST['pNomADM'].'<br>';
echo 'Segundo Nome do Administrador: '.$_POST['sNomADM'].'<br>';
echo 'Email do Administrador: '.$_POST['emailADM'].'<br>';
echo 'CPF do Administrador: '.$_POST['cpfADM'].'<br>';
echo 'Data de Nascimento do Administrador: '.$_POST['datNasADM'].'<br>';
echo 'Telefone do Administrador: '.$_POST['telADM'].'<br>';
echo 'Sexo do Administrador: '.$_POST['sexoADM'].'<br>';
echo 'Usuário do Administrador: '.$_POST['userADM'].'<br>';
echo 'Senha do Administrador: '.$_POST['passwordADM'].'<br>';
echo 'Repetir Senha do Administrador: '.$_POST['password2ADM'].'<br>';
echo 'Check Box: '.$_POST['check'].'<br>';

// VALIDAÇÃO CHECK BOX (TERMOS)
if($_POST['check']){
    // VALIDAÇÃO BASE DE DADOS
    $autentica = new autenticaDB();
    $autentica -> setBase($_POST['tipbase']);
	$autentica -> setHost($_POST['hostBD']);
	$autentica -> setDatabase($_POST['database']);
	$autentica -> setUsername($_POST['usernameBD']);
    $autentica -> setPassword($_POST['passwordBD']);
    $msg = $autentica -> validarDB();
    if($msg == 1){
        // VALIDAÇÂO ACTIVE DIRECTORY
        if(!$_POST['checkAD']){
           $ldap = new autenticaLDAP();
           $ldap -> setTipHost($_POST['tipAD']);
           $ldap -> setHost($_POST['hostAD']);
           $ldap -> setPorta($_POST['portaAD']);
           $msg = $ldap -> autenticarLDAP();
           $ldap -> desconectarLDAP();
           if(!$msg == 1){
               header('location: ../view/form.install.php?ret=3&msg='.$msg);
           }
        }
        // FIM VALIDAÇÃO ACTIVE DIRECTORY
        
        // VALIDAÇÃO EMAIL
        $email = new autenticaEMAIL();
        $email -> setCharset($_POST['charsetEmail']);
        $email -> setHost($_POST['hostEmail']);
        $email -> setPorta($_POST['portaEmail']);
        $email -> setProtseg($_POST['protocoloEmail']);
        $email -> setAutsmtp($_POST['autenticacaoEmail']);
        $email -> setUsersmtp($_POST['userEmail']);
        $email -> setSenhasmtp($_POST['passEmail']);
        $email -> setEmailrem($_POST['remetenteEmail']);
        $email -> setNomerem($_POST['nomeRemetenteEmail']);
        $email -> setEmailteste($_POST['emailTeste']);
        $email -> Conectar();
        $msg = $email -> EnviarTeste();
        if($msg == 1){
            echo "OK";
        }else{
            header('location: ../view/form.install.php?ret=4&msg='.$msg);
        }
        // FIM VALIDAÇÃO EMAIL
    }else{
		header('location: ../view/form.install.php?ret=2&msg='.$msg);
    }
    // FIM DA VALIDAÇÂO BASE DE DADOS
}else{
    header('location: ../view/form.install.php?ret=1');
}