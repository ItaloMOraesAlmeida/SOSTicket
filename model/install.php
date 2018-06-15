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
           }else{
               $ad = true;
           }
        }else{
            $ad = 0;
        }
        // FIM VALIDAÇÃO ACTIVE DIRECTORY

        // TIPO DE BANCO DE DADOS
        if("".$_POST['tipbase']."" == "sqlsrv"){
            $sqlsrv = true;
            $mysql = 0;
        }else if("".$_POST['tipbase']."" == "mysql"){
            $sqlsrv = 0;
            $mysql = true;
        }
        // FIM TIPO
        
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
            // CRIAÇÃO DOS ARQUIVOS DE CONFIGURAÇÃO
            /// ARQUIVO CONECTORES
            $nomearq = "class.conectores.php";
            //// VERIFICA SE O ARQUIVO EXISTE
            if(file_exists($nomearq)){
                $dados = file_get_contents($nomearq);
            }else{
                $dados = "";
            }
            //// FIM DA VERIFICAÇÃO
            //// CRIAÇÃO DOS DADOS DO ARQUIVO 
            $dados = '
            <?php

            /******************************************************************************************
             *                        CONECTORES DE AUTENTICAÇÃO E VERIFICAÇÃO                        *
             * Versão: 1.3                                                                            *
             * Autor: Italo Moraes                                                                    *
             * Pacote: NULL                                                                           *
             * Empresa: MySoftware                                                                    *
             * Descrição:                                                                             *
             *      Resposavel pela passagem de parâmetros entre os dados de instalação e os dados    *
             *  para conexão e autenticação das bases.                                                *
             *                                                                                        *
             * OBS: CONCLUÍDO                                                                         *
             *                                                                                        *
             * ---------------------------------------------------------------------------------------*
             * |                                    LICENÇA PRIVADA                                  |*
             * ---------------------------------------------------------------------------------------*
             ******************************************************************************************/
            
                class conectores{
                    public $basedb;
                    public $hostdb;
                    public $basead;
                    public $hostad;
                    public $portaad;
                    public $protocolo;
                    public $dominioad;
                    public $database;
                    public $usernamedb;
                    public $passworddb;
                    public $isdbsqlserver;
                    public $isdbmysql;
                    public $isconnectionad;
            
                    public function __construct(){
                        $this -> setBasedb("'.$_POST['tipbase'].'");
                        $this -> setHostdb("'.$_POST['hostBD'].'");
                        $this -> setBasead("'.$_POST['tipAD'].'");
                        $this -> setHostad("'.$_POST['hostAD'].'");
                        $this -> setPortaad("'.$_POST['portaAD'].'");
                        $this -> setProtocolo('.$_POST['verProtAD'].');
                        $this -> setDominioad("'.$_POST['domiAD'].'");
                        $this -> setDatabase("'.$_POST['database'].'");
                        $this -> setUsernamedb("'.$_POST['usernameBD'].'");
                        $this -> setPassworddb("'.$_POST['passwordBD'].'");
                        $this -> setIsdbsqlserver('.$sqlsrv.'); // Autenticação pelo SQLSERVER
                        $this -> setIsdbmysql('.$mysql.'); // Autenticação pelo MYSQL
                        $this -> setIsconnectionad('.$ad.'); // Autenticação pelo Activite Directory
                    }

                    public function setBasedb($base){
                        $this -> basedb = $base;
                    }
            
                    public function getBasedb(){
                        return $this -> basedb;
                    }
            
                    public function setHostdb($host){
                        $this -> hostdb = $host;
                    }
            
                    public function getHostdb(){
                        return $this -> hostdb;
                    }
            
                    public function setBasead($base){
                        $this -> basead = $base;
                    }
            
                    public function getBasead(){
                        return $this -> basead;
                    }
            
                    public function setHostad($host){
                        $this -> hostad = $host;
                    }
            
                    public function getHostad(){
                        return $this -> hostad;
                    }
            
                    public function setPortaad($porta){
                        $this -> portaad = $porta;
                    }
            
                    public function getPortaad(){
                        return $this -> portaad;
                    }
            
                    public function setProtocolo($protocolo){
                        $this -> protocolo = $protocolo;
                    }
            
                    public function getProtocolo(){
                        return $this -> protocolo;
                    }
            
                    public function setDominioad($dominio){
                        $this -> dominioad = $dominio;
                    }
            
                    public function getDominioad(){
                        return $this -> dominioad;
                    }
            
                    public function setDatabase($database){
                        $this -> database = $database;
                    }
            
                    public function getDatabase(){
                        return $this -> database;
                    }
            
                    public function setUsernamedb($user){
                        $this -> usernamedb = $user;
                    }
            
                    public function getUsernamedb(){
                        return $this -> usernamedb;
                    }
            
                    public function setPassworddb($pass){
                        $this -> passworddb = $pass;
                    }
            
                    public function getPassworddb(){
                        return $this -> passworddb;
                    }
            
                    public function setIsdbsqlserver($sqlserver){
                        $this -> isdbsqlserver = $sqlserver;
                    }
            
                    public function getIsdbsqlserver(){
                        return $this -> isdbsqlserver;
                    }
            
                    public function setIsdbmysql($mysql){
                        $this -> isdbmysql = $mysql;
                    }
            
                    public function getIsdbmysql(){
                        return $this -> isdbmysql;
                    }
            
                    public function setIsconnectionad($ad){
                        $this -> isconnectionad = $ad;
                    }
            
                    public function getIsconnectionad(){
                        return $this -> isconnectionad;
                    }
                }
            ';
            //// FIM DA CRIAÇÃO
            //// ESCRITA DOS DADOS NO ARQUIVO
            $arquivo = @fopen($nomearq, "w+");
            @fwrite($arquivo, stripcslashes($dados));
            @fclose($arquivo);
            //// FIM DA ESCRITA
            /// FIM DOS CONECTORES

            /// ARQUIVO EMAIL
            $nomearq = "abstract.email.php";
            //// VERIFICA SE O ARQUIVO EXISTE
            if(file_exists($nomearq)){
                $dados = file_get_contents($nomearq);
            }else{
                $dados = "";
            }
            //// FIM DA VERIFICAÇÃO
            //// CRIAÇÃO DOS DADOS DO ARQUIVO
            $dados = '
            <?php

            /******************************************************************************************
             *                        CONECTORES DE AUTENTICAÇÃO E VERIFICAÇÃO DO EMAIL               *
             * Versão: 1.3                                                                            *
             * Autor: Italo Moraes                                                                    *
             * Pacote: NULL                                                                           *
             * Empresa: MySoftware                                                                    *
             * Descrição:                                                                             *
             *      Resposavel pela passagem de parâmetros entre os dados de instalação e os dados    *
             *  para conexão e autenticação do Email.                                                 *
             *                                                                                        *
             * OBS: CONCLUÍDO                                                                         *
             *                                                                                        *
             * ---------------------------------------------------------------------------------------*
             * |                                    LICENÇA PRIVADA                                  |*
             * ---------------------------------------------------------------------------------------*
             ******************************************************************************************/

                require_once "../phpmailer/class.phpmailer.php";

                abstract class AbsEmail{
                    Protected $charset = "'.$_POST['charsetEmail'].'";
                    Protected $host = "'.$_POST['hostEmail'].'";
                    Protected $porta = '.$_POST['portaEmail'].';
                    Protected $protseg = "'.$_POST['protocoloEmail'].'";
                    Protected $autsmtp = '.$_POST['autenticacaoEmail'].';
                    Protected $usersmtp = "'.$_POST['userEmail'].'";
                    Protected $senhasmtp = "'.$_POST['passEmail'].'";
                    Protected $emailrem = "'.$_POST['remetenteEmail'].'";
                    Protected $nomerem = "'.$_POST['nomeRemetenteEmail'].'";
                    Protected $mail;

                    Protected final function conectar(){
                        $this -> setMail(new PHPMailer());
                        $this -> getMail()->IsSMTP(); // Define que a mensagem será SMTP
                        $this -> getMail()->CharSet = $this -> getCharset();
                        $this -> getMail()->Host = $this -> getHost(); // Endereço do servidor de Email
                        $this -> getMail()->Port = $this -> getPorta(); // Porta do Servidor de Email
                        $this -> getMail()->SMTPSecure = $this -> getProtseg();
                        $this -> getMail()->SMTPAuth = $this -> getAutsmtp(); // Usa autenticação SMTP? (opcional)
                        $this -> getMail()->Username = $this -> getUser(); // Usuário do servidor de Email
                        $this -> getMail()->Password = $this -> getPass(); // Senha do servidor de Email
                        $this -> getMail()->From = $this -> getEmarem(); // Seu e-mail, quem envia
                        $this -> getMail()->FromName = $this -> getNomrem(); // Seu nome
                    }

                    Protected function Desconectar(){
                        $this -> getMail()->ClearAllRecipients();
                        $this -> getMail()->ClearAttachments();
                        $this -> getMail()->ClearAddresses();
                    }

                    Protected function getCharset(){
                        return $this -> charset;
                    }

                    Protected function getHost(){
                        return $this -> host;
                    }

                    Protected function getPorta(){
                        return $this -> porta;
                    }

                    Protected function getProtSeg(){
                        return $this -> protseg;
                    }

                    Protected function getAutsmtp(){
                        return $this -> autsmtp;
                    }

                    Protected function getUser(){
                        return $this -> usersmtp;
                    }

                    Protected function getPass(){
                        return $this -> senhasmtp;
                    }
                    
                    Protected function getEmarem(){
                        return $this -> emailrem;
                    }

                    Protected function getNomrem(){
                        return $this -> nomerem;
                    }

                    Protected function setMail($mail){
                        $this -> mail = $mail;
                    }
                    
                    Protected function getMail(){
                        return $this -> mail;
                    }
                }
            ';
            //// FIM DA CRIAÇÃO
            //// ESCRITA DOS DADOS NO ARQUIVO
            $arquivo = @fopen($nomearq, "w+");
            @fwrite($arquivo, stripcslashes($dados));
            @fclose($arquivo);
            //// FIM DA ESCRITA
            /// FIM ARQUIVO EMAIL
            // FIM DA CRIAÇÃO DOS ARQUIVOS DE CONFIGURAÇÃO
            
            // CRIAÇÃO E IMPORTAÇÃO DO BANCO DE DADOS
            require_once '../dao/import.base.php';
            $impbase = new ImpBase();
            if($mysql){
                echo "Criando base Mysql";
                $impbase = $impbase -> ImpbaseMysql();
            }else if($sqlserver){
                echo "Criando base SQLSERVER";
                $impbase = $impbase -> ImpbaseSqlserver();
            }else{
                // ERRO AO SELECIONAR BASE DE DADOS: Base indefinida
                echo "Erro";
            }
            // FIM DA CRIAÇÃO E IMPORTAÇÃO
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