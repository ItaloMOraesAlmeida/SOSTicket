<?php

    require_once "abstract.execquery.php";
    require_once "../model/class.conectores.php";

    class Delete  extends ExecQuery{
        Private $tabela;
        Private $condicao;
        Private $ret;

        public function __construct($tabela,$condicao){
            $this -> setTabela($tabela);
            $this -> setCondicao($condicao);

            $base = new conectores();
            
            $delete = "Delete From ";
            if($base -> getIsdbmysql()){
                $delete .= $base -> getDatabase().".";
            }
            
            $delete .= $this -> getTabela();

            if($this -> getCondicao() != ''){
                $delete .= " Where ".$this -> getCondicao();
            }
            
            //var_dump($delete);
            $this -> ret = $this -> query($delete);
            $this -> excluirPDO();
        }

        Public function getDelete(){
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

        Private function setCondicao($condicao){
            $this -> condicao = $condicao;
        }

        Private function getCondicao(){
            return $this -> condicao;
        }
    }