<?php

    require_once "../phpmailer/class.phpmailer.php";

    abstract class AbsEmail{
        Protected $charset = "";
        Protected $host = "";
        Protected $porta = 587;
        Protected $protseg = "";
        Protected $autsmtp = true;
        Protected $usersmtp = "";
        Protected $senhasmtp = "";
        Protected $emailrem = "";
        Protected $nomerem = "";
        Protected $destinatario;
        Protected $titulo;
        Protected $assunto;
        Protected $mail;

        Protected final function conectar(){
            $this -> setMail(new PHPMailer());
            $this -> getMail()->IsSMTP(); // Define que a mensagem será SMTP
            $this -> getMail()->CharSet = $this -> getCharset();
            $this -> getMail()->Host = $this -> getHost(); // Endereço do servidor de Email
            $this -> getMail()->Port = $this -> getPorta(); // Porta do Servidor de Email
            $this -> getMail()->SMTPSecure = $this -> getProtseg();
            $this -> getMail()->SetLanguage("br", "libs/");
            $this -> getMail()->SMTPAuth = $this -> getAutsmtp(); // Usa autenticação SMTP? (opcional)
            $this -> getMail()->Username = $this -> getUser(); // Usuário do servidor de Email
            $this -> getMail()->Password = $this -> getPass(); // Senha do servidor de Email
            $this -> getMail()->From = $this -> getEmarem(); // Seu e-mail, quem envia
            $this -> getMail()->FromName = $this -> getNomrem(); // Seu nome
        }

        public final function enviar($destinatario,$titulo,$assunto){
            $this -> conectar();
            $this -> getMail()->AddAddress($destinatario); // Destinatário
            $this -> getMail()->Subject = $titulo; // Titulo da mensagem
            $this -> getMail()->MsgHTML($assunto); // Assunto/Descrição/Conteudo da Mensagem
            $envio = $this -> getMail()->Send(); // Envia a mensagem
            if($envio){
                return 1;
            }else{
                return "<strong>Erro ao Enviar o Email: </strong> " . $this -> getMail()->ErrorInfo . "\n";
            }
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

        Protected function setDestinatario($destina){
            $this -> destinatario = $destina;
        }

        Protected function getDestinatario(){
            return $this -> destinatario;
        }

        Protected function setTitulo($titulo){
            $this -> titulo = $titulo;
        }

        Protected function getTitulo(){
            return $this -> titulo;
        }

        Protected function setAssunto($assunto){
            $this -> assunto = $assunto;
        }

        Protected function getAssunto(){
            return $this -> assunto;
        }

        Protected function setMail($mail){
            $this -> mail = $mail;
        }
        
        Protected function getMail(){
            return $this -> mail;
        }
    }