<?php
    ini_set('default_charset','utf-8');
    require('../phpmailer/class.phpmailer.php');

    class autenticaEMAIL{
        Private $charset;
        Private $host;
        Private $porta;
        Private $protseg;
        Private $autsmtp;
        Private $usersmtp;
        Private $senhasmtp;
        Private $emailrem;
        Private $nomerem;
        Private $emailteste;
        Private $mail;

        Public function __construct(){
            $this -> setMail(new PHPMailer());
        }

        Public function Conectar(){
            $this -> getMail()->IsSMTP(); // Define que a mensagem será SMTP
            $this -> getMail()->CharSet = $this -> getCharset();
            $this -> getMail()->Host = $this -> getHost(); // Endereço do servidor de Email
            $this -> getMail()->Port = $this -> getPorta(); // Porta do Servidor de Email
            $this -> getMail()->SMTPSecure = $this -> getProtseg();
            $this -> getMail()->SMTPAuth = $this -> getAutsmtp(); // Usa autenticação SMTP? (opcional)
            $this -> getMail()->Username = $this -> getUsersmtp(); // Usuário do servidor de Email
            $this -> getMail()->Password = $this -> getSenhasmtp(); // Senha do servidor de Email
            $this -> getMail()->From = $this -> getEmailrem(); // Seu e-mail, quem envia
            $this -> getMail()->FromName = $this -> getNomerem(); // Seu nome
        }

        Public function EnviarTeste(){
            $this -> getMail()->AddAddress($this -> getEmailteste()); // Destinatário
            $this -> getMail()->Subject = 'Email de Teste - MeuSoftware'; // Assunto da mensagem
            $this -> getMail()->MsgHTML('Envio efetuado com sucesso!');
            $enviado = $this -> getMail()->Send();
            if($enviado){
                return 1;
            }else{
                return "<strong>Erro ao Enviar o Email de Teste: </strong> " . $this -> getMail()->ErrorInfo . "\n";
            }
        }

        Public function Desconectar(){
            $this -> getMail()->ClearAllRecipients();
            $this -> getMail()->ClearAttachments();
            $this -> getMail()->ClearAddresses();
        }

        Public function setCharset($charset){
            $this -> charset = $charset;
        }

        Public function getCharset(){
            return $this -> charset;
        }

        Public function setHost($host){
            $this ->  host = $host;
        }

        Public function getHost(){
            return $this -> host;
        }

        Public function setPorta($porta){
            $this -> porta = $porta;
        }

        Public function getPorta(){
            return $this -> porta;
        }

        Public function setProtseg($seg){
            $this -> protseg = $seg;
        }

        Public function getProtseg(){
            return $this -> protseg;
        }

        Public function setAutsmtp($aut){
            $this -> autsmtp = $aut;
        }

        Public function getAutsmtp(){
            return $this -> autsmtp;
        }

        Public function setUsersmtp($user){
            $this -> usersmtp = $user;
        }

        Public function getUsersmtp(){
            return $this -> usersmtp;
        }

        Public function setSenhasmtp($pass){
            $this -> senhasmtp = $pass;
        }

        Public function getSenhasmtp(){
            return $this -> senhasmtp;
        }

        Public function setEmailrem($email){
            $this -> emailrem = $email;
        }

        Public function getEmailrem(){
            return $this -> emailrem;
        }

        Public function setNomerem($nome){
            $this -> nomerem = $nome;
        }

        Public function getNomerem(){
            return $this -> nomerem;
        }

        Public function setEmailteste($email){
            $this -> emailteste = $email;
        }

        Public function getEmailteste(){
            return $this -> emailteste;
        }

        Public function setMail($mail){
            $this -> mail = $mail;
        }

        Public function getMail(){
            return $this -> mail;
        }
    }