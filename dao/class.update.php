<?php

    require_once "abstract.execquery.php";
    require_once "../model/class.conectores.php";

    class Update extends ExecQuery{
        Private $tabela;
        Private $valores;
        Private $condicao;
        Private $ret;

        public function __construct($tabela,$valores,$condicao){
            $this -> setTabela($tabela);
            $this -> setValores($valores);
            $this -> setCondicao($condicao);

            $base = new conectores();
            
            $update = "Update ";
            if($base -> getIsdbmysql()){
                $update .= $base -> getDatabase().".";
            }
            
            $update .= $this -> getTabela()." Set ".$this -> getValores();

            if($this -> getCondicao() != ''){
                $update .= " Where ".$this -> getCondicao();
            }

            //var_dump($update);
            $this -> ret = $this -> query($update);
            $this -> excluirPDO();
        }

        Public function getUpdate(){
            if($this -> ret == 1){
                return ["msg" => "", "val" => 1];
            }else{
                return ["msg" => $this -> ret, "val" => 0];
            }
        }

        private function setTabela($tabela){
            $this -> tabela = $tabela;
        }

        Private function getTabela(){
            return $this -> tabela;
        }

        Private function setValores($valores){
            $this -> valores = $valores;
        }

        Private function getValores(){
            return $this -> valores;
        }

        Private function setCondicao($condicao){
            $this -> condicao = $condicao;
        }

        Private function getCondicao(){
            return $this -> condicao;
        }
    }