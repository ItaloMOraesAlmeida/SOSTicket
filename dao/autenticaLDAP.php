<?php

class autenticaLDAP{
	Private $tipHost;
	Private $host;
	Private $porta;
	Private $lc;

	Public function __construct(){

	}

	Public function autenticarLDAP(){
		$this -> setLc(ldap_connect($this -> getHost(), $this -> getPorta()));
		if($this -> getLc()){
			return "true";
		}else{
			return "<strong>Erro ao conectar no seridor LDAP: </strong>".ldap_error($this -> getLc());
		}
	}

	Public function desconectarLDAP(){
		ldap_close($this -> getLc());
	}

	Public function setTipHost($tipHost){
		$this -> tipHost = $tipHost;
	}

	Public function getTipHost(){
		return $this -> tipHost;
	}

	Public function setHost($host){
		$this -> host = $this -> getTipHost()."://".$host;
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

	Public function setLc($lc){
		$this -> lc = $lc;
	}

	Public function getLc(){
		return $this -> lc;
	}

}