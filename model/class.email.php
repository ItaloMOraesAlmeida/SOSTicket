<?php

    require_once "abstract.email.php";

    class Email extends AbsEmail{

        Private $destinatario;
        Private $titulo;
        Private $assunto;
        
        public function __construct(){
            $this -> conectar();
        }

        public final function enviar($destinatario,$titulo,$assunto){
            $this -> getMail()->AddAddress($destinatario); // Destinatário
            $this -> getMail()->Subject = $titulo; // Titulo da mensagem
            $this -> getMail()->MsgHTML($assunto); // Assunto/Descrição/Conteudo da Mensagem
            $envio = $this -> getMail()->Send(); // Envia a mensagem
            if($envio){
                return 1;
            }else{
                $ret = $this -> getMail()->ErrorInfo;
                $this -> Desconectar();
                return "<strong>Erro ao Enviar o Email: </strong> " . $ret . "\n";
            }
        }

        Private function setDestinatario($destina){
            $this -> destinatario = $destina;
        }

        Private function getDestinatario(){
            return $this -> destinatario;
        }

        Private function setTitulo($titulo){
            $this -> titulo = $titulo;
        }

        Private function getTitulo(){
            return $this -> titulo;
        }

        Private function setAssunto($assunto){
            $this -> assunto = $assunto;
        }

        Private function getAssunto(){
            return $this -> assunto;
        }
    }