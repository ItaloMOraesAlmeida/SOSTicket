<?php

/******************************************************************************************
 *        VERIFICAÇÃO E CONEXÃO COM AS BASES DE DADOS E AUTENTICAÇÃO DE USUÁRIO           *
 * Versão: 1.2                                                                            *
 * Autor: Italo Moraes                                                                    *
 * Pacote: PDO,LDAP,SQLSERVER,MYSQL                                                       *
 * Empresa: MySoftware                                                                    *                                                       *
 * Descrição:                                                                             *
 *      Responsavel pela autenticação com o banco de dados e verificação de autenticação  *
 *  do usuário, sistema não tem acesso direto a este arquivo, somente por meio de outra   *
 *  classe, onde será executados os principais comandos para verificação e autenticação.  *
 *                                                                                        *
 * OBS: EM PROCESSO DE TESTES                                                             *
 *                                                                                        *
 * ---------------------------------------------------------------------------------------*
 * |                                    LICENÇA PRIVADA                                  |*
 * ---------------------------------------------------------------------------------------*
 ******************************************************************************************/

    require_once 'class.conectores.php';
    require_once '../controller/interface.conn.php';
    require_once '../dao/class.select.php';

    class Conexao implements Conn{
        Private $conect;
        Private $basedb;
        Private $hostdb;
        Private $database;
        Private $usernamedb;
        Private $passworddb;
        Private $usernameaudb;
        Private $passwordaudb;
        Private $pdo;
        Private $basead;
        Private $hostad;
        Private $protocolo;
        Private $usernameauad;
        Private $passwordauad;
        Private $dominioad;
        Private $porta;
        Private $lc;
        Private $isdbsqlserver;
        Private $isdbmysql;
        Private $isconnectionad;

        public function __construct(){
            $this -> setConect(new conectores());
            $this -> setBasedb($this -> getConect() -> getBasedb());
            $this -> setHostdb($this -> getConect() -> getHostdb());
            $this -> setDatabase($this -> getConect() -> getDatabase());
            $this -> setUsernamedb($this -> getConect() -> getUsernamedb());
            $this -> setPassworddb($this -> getConect() -> getPassworddb());
            $this -> setBasead($this -> getConect() -> getBasead());
            $this -> setHostad($this -> getConect() -> getHostad());
            $this -> setProtocolo($this -> getConect() -> getProtocolo());
            $this -> setDominioad($this -> getConect() -> getDominioad());
            $this -> setPorta($this -> getConect() -> getPortaad());
            $this -> setIsdbsqlserver($this -> getConect() -> getIsdbsqlserver());
            $this -> setIsdbmysql($this -> getConect() -> getIsdbmysql());
            $this -> setIsconnectionad($this -> getConect() -> getIsconnectionad());
        }

        /*public function mostrar(){ // Mostra os dados obtidos pelo GET
            return $this -> getBasedb()."<br>".$this -> getHostdb()."<br>".$this -> getPdo()."<br>".$this -> getDatabase()."<br>".$this -> getUsernamedb()."<br>".$this -> getPassworddb()."<br>".$this -> getBasead()."<br>".$this -> getHostad()."<br>".$this -> getProtocolo()."<br>".$this -> getUsernameauad()."<br>".$this -> getPasswordauad()."<br>".$this -> getDominioad()."<br>".$this -> getPorta()."<br>".$this -> getLc()."<br>".$this -> getIsdbsqlserver()."<br>".$this -> getIsdbmysql()."<br>".$this -> getIsconnectionad()."<br>".$this -> getUsernameaudb();
        }*/

        public function conectarDb(){ // Conexão com o banco de dados
            try{
                if($this -> getIsdbsqlserver()){
                    $this -> setPdo(new PDO($this -> getBasedb().":server = ".$this -> getHostdb()." ; Database = ".$this -> getDatabase(),$this ->getUsernamedb(),$this -> getPassworddb()));
                }else if($this -> getIsdbmysql()){
                    $this -> setPdo(new PDO($this -> getBasedb().":host = ".$this -> getHostdb().";dbname = ".$this -> getDatabase(), $this -> getUsernamedb(), $this -> getPassworddb()));
                    $this -> getPdo() -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                return $this -> getPdo();
            }catch(PDOException $e){
                $this -> excluirPDO();
                return "<br>Erro ao conectar na base: <strong>".$this -> getBasedb()."</strong><br><strong>Erro: ".$e -> getMessage()."</strong>";
            }
        }

        Public function excluirPDO(){ // Exclui o objeto instanciado na conexão do banco de dados
            unset($this -> pdo);
        }

        Private function autenticarSqlserver(){ // Autenticação do usuário pelo SQLSERVER
            $this -> conectarDb();
            $query = $this -> getPdo() -> prepare("Select usuario From sosticket.usuario Where usuario = '".$this ->getUsernameaudb()."' And senha = '".md5($this -> getPasswordaudb())."'");
            $query -> execute();
            $linhas = $query -> rowCount();
            
            $this -> excluirPDO();
            if($linhas < 0){
                return true;
            }else{
                return false;
            }
        }

        Private function autenticarMysql(){ // Autenticação do usuário pelo MYSQL
            $select = new Select("usuLog","tUsuario",Null,"usuLog = '".$this ->getUsernameaudb()."' And usuSen = '".md5($this -> getPasswordaudb())."'");
            
            if($select->getSelectQtdLinhas()['msg'] == 1){
                return 1;
            }else{
                return 0;
            }
        }

        Private function conectarAd(){ // Conexão com o servidor LDAP
            try{
                $this -> setLc(ldap_connect($this -> getHostad(), $this -> getPorta()));
                return $this -> getLc();
            }catch(Exception $e){
                $erro = ldap_error($this -> getLc());
                $this -> excluirLdap();
                return "Erro ao conectar no servidor <strong>LDAP</strong>.<br><strong>Erro Excessão: </strong>".$e -> getMessage()."<br><strong>Erro LDAP: </strong>".$erro;
            }
        }

        Private function autenticarAd(){ // Autenticação do usuário pelo LDAP
            $this -> conectarAd();
            try{
                ldap_set_option($this -> getLc(), LDAP_OPT_REFERRALS, 0);
                ldap_set_option($this -> getLc(), LDAP_OPT_PROTOCOL_VERSION, $this -> getProtocolo());
                ldap_bind($this -> getLc(),$this -> getUsernameauad(),$this -> getPasswordauad());
                return ldap_error($this -> getLc());
            }catch(Exception $e){
                $erro = ldap_error($this -> getLc());
                $this -> excluirLdap();
                return "Erro ao conectar no servidor <strong>LDAP</strong>.<br><strong>Erro Excessão: </strong>".$e -> getMessage()."<br><strong>Erro LDAP: </strong>".$erro;
            }
        }

        Private function excluirLdap(){
            ldap_close($this -> lc);
            unset($this -> lc);
        }

        public function autenticar($usuario,$senha){ // Autenticação do usuário
            $this -> setUsernameaudb($usuario);
            $this -> setPasswordaudb($senha);
            if($this -> getIsconnectionad()){
                $this -> setUsernameauad($usuario);
                $this -> setPasswordauad($senha);
                return $this -> autenticarAd();
            }else if($this -> getIsdbsqlserver()){
                return $this -> autenticarSqlserver();
            }else if($this -> getIsdbmysql()){
                return $this -> autenticarMysql();
            }
        }

        Private function setConect($conect){ // Pega os obejtos de conexão dos conectores
            $this -> conect = $conect;
        }

        Private function getConect(){ // Retorna os objetos de coneão dos conectores
            return $this -> conect;
        }

        Private function setBasedb($base){ // Pega o tipo de banco de dados
            $this -> basedb = $base;
        }

        Private function getBasedb(){ // Retorna o tipo de banco de dados
            return $this -> basedb;
        }

        Private function setHostdb($host){ // Pega o host do banco de dados
            $this -> hostdb = $host;
        }

        Private function getHostdb(){ // Retorna o host do banco de dados
            return $this -> hostdb;
        }

        Private function setDatabase($database){ // Pega o nome do banco de dados
            $this -> database = $database;
        }

        Private function getDatabase(){ // Retorna o nome do banco de dados
            return $this -> database;
        }

        Private function setUsernamedb($user){ // Pega o usuário do banco de dados
            $this -> usernamedb = $user;
        }

        Private function getUsernamedb(){ // Retorna o usuário do banco de dados
            return $this -> usernamedb;
        }

        Private function setPassworddb($pass){ // Pega a senha do abnco de dados
            $this -> passworddb = $pass;
        }

        Private function getPassworddb(){ // Retorna a senha do abnco de dados
            return $this -> passworddb;
        }

        Private function setUsernameaudb($user){ // Pega o usuário de autenticação do banco de dados
            $this -> usernameaudb = $user;
        }

        Private function getUsernameaudb(){ // Retorna o usuário de autenticação do banco de dados
            return $this -> usernameaudb;
        }

        Private function setPasswordaudb($pass){ // Pega a senha do usuŕio de autenticação do banco de dados
            $this -> passwordaudb = $pass;
        }

        Private function getPasswordaudb(){ // Retorna a senha do usuário de autenticação do banco de dados
            return $this -> passwordaudb;
        }

        Private function setPdo($pdo){ // Pega o objeto de conexão do banco de dados
            $this -> pdo = $pdo;
        }
        
        Private function getPdo(){ // Retorna o objeto de conexão do abnco de dados
            return $this -> pdo;
        }

        Private function setBasead($base){ // Pega o tipo de entrada do Activite Directory
            $this -> basead = $base;
        }

        Private function getBasead(){ // Retorna o tipo de entrada do Activite Directory
            return $this -> basead;
        }

        Private function setHostad($host){ // Pega o host do Activite Directory
            $this -> hostad = $this -> getBasead()."://".$host;
        }

        Private function getHostad(){ // Retorna o host Activite Directory
            return $this -> hostad;
        }

        Private function setProtocolo($protocolo){ // Pega o número do protocolo do Activite Directory
            $this -> protocolo = $protocolo;
        }

        Private function getProtocolo(){ // Retorna o número do protocolo do Activite Directory
            return $this -> protocolo;
        }

        Private function setUsernameauad($user){ // Pega o usuário de autenticação do Activite Directory
            $this -> usernameauad = $user;
        }

        Private function getUsernameauad(){ // Retorna o usuário de autenticação do Activite Directory
            return $this -> usernameauad.$this -> getDominioad();
        }

        Private function setPasswordauad($pass){ // Pega a senha de autenticação do usuário do Activite Directory
            $this -> passwordauad = $pass;
        }

        Private function getPasswordauad(){ // Retorna a senha de autenticação do usuário do Activite Directory
            return $this -> passwordauad;
        }

        Private function setDominioad($dominio){ // Pega o dominio utilizado pelo Activite Directory
            $this -> dominioad = $dominio;
        }

        Private function getDominioad(){ // Retorna o dominio utilizado pelo Activite Directory
            return $this -> dominioad;
        }

        Private function setPorta($porta){ // Pega a porta utilizada pelo Activite Directory
            $this -> porta = $porta;
        }

        Private function getPorta(){ // Retorna a porta utilizada pelo Activite Directory
            return $this -> porta;
        }

        Private function setLc($lc){ // Pega o objeto instanciado com as informações de conexão do Activite Directory
            $this -> lc = $lc;
        }

        Private function getLc(){ // Retorna o objeto instanciado com as informações de conexão do Activite Directory
            return $this -> lc;
        }

        Private function setIsdbsqlserver($sqlserver){ // Pega o valor da escolha do usuário se irá usar o SQLSERVER
            $this -> isdbsqlserver = $sqlserver;
        }

        Private function getIsdbsqlserver(){ // Retorna o valor da escolha do usuário se irá usar o SQLSERVER
            return $this -> isdbsqlserver;
        }

        Private function setIsdbmysql($mysql){ // Pega o valor da escolha do usuário se irá usar o MYSQL
            $this -> isdbmysql = $mysql;
        }

        Private function getIsdbmysql(){ // Retorna o valor da escolha do usuário se irá usar o MYSQL
            return $this -> isdbmysql;
        }

        Private function setIsconnectionad($ad){ // Pega o valor da escolha do usuário se irá usar o Activite Directory 
            $this -> isconnectionad = $ad;
        }

        Private function getIsconnectionad(){ // Retorna o valor da escolha do usuário se irá usar o Activite Directory
            return $this -> isconnectionad;
        }
    }