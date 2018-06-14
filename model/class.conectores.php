
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
                        $this -> setBasedb("mysql");
                        $this -> setHostdb("127.0.0.1");
                        $this -> setBasead("ldaps");
                        $this -> setHostad("192.168.10.4");
                        $this -> setPortaad("636");
                        $this -> setProtocolo(3);
                        $this -> setDominioad("@cidadania.intra.ong");
                        $this -> setDatabase("sosticket");
                        $this -> setUsernamedb("root");
                        $this -> setPassworddb("Italaquimaso1");
                        $this -> setIsdbsqlserver(0); // Autenticação pelo SQLSERVER
                        $this -> setIsdbmysql(1); // Autenticação pelo MYSQL
                        $this -> setIsconnectionad(1); // Autenticação pelo Activite Directory
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
            