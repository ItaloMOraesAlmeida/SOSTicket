<?php

class autenticaDB{
	Private $base;
	Private $host;
	Private $database;
	Private $username;
	Private $password;

	Public function __construct(){

	}

	Public function validarDB(){
        if($this -> getBase() == "sqlsrv"){
            try{
                $pdo = new PDO ($this -> getBase().":server = ".$this -> getHost()." ; Database = ".$this -> getDatabase(), $this -> getUsername(), $this -> getPassword());
                unset($pdo);
                return 1;
            }catch(PDOException $e){
                unset($pdo);
                return "<strong>Erro de Conexão com a Base de Dados SQLSERVER: </strong> " . $e->getMessage() . "\n";
            }
        }else if($this -> getBase() == "mysql"){
            try{
                $pdo = new PDO ($this -> getBase().":".$this -> getHost().";dbname=".$this -> getDatabase(),$this -> getUsername(),$this -> getPassword());
                $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                unset($pdo);
                return 1;
            }catch(PDOException $e){
                unset($pdo);
                return "<strong>Erro de Conexão com a Base de Dados MYSQL: </strong> " . $e->getMessage() . "\n";
            }
        }else{
            return "<strong>Erro de Conexão com a Base de Dados: </strong> Tipo de base indefinida!";
        }
	}

	Public function setBase($base){
		$this -> base = $base;
	}

	Public function getBase(){
		return $this -> base;
	}

	Public function setHost($host){
		$this -> host = $host;
	}

	Public function getHost(){
		return $this -> host;
	}

	Public function setDatabase($database){
		$this -> database = $database;
	}

	Public function getDatabase(){
		return $this -> database;
	}

	Public function setUsername($username){
		$this -> username = $username;
	}

	Public function getUsername(){
		return $this -> username;
	}

	Public function setPassword($password){
		$this -> password = $password;
	}

	Public function getPassword(){
		return $this -> password;
	}
}