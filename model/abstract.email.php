
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
                    Protected $charset = "UTF-8";
                    Protected $host = "smtp.office365.com";
                    Protected $porta = 587;
                    Protected $protseg = "tls";
                    Protected $autsmtp = true;
                    Protected $usersmtp = "integracao@inec.org.br";
                    Protected $senhasmtp = "INEC@Inte3gr4c@04D";
                    Protected $emailrem = "integracao@inec.org.br";
                    Protected $nomerem = "Integração AD";
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
            