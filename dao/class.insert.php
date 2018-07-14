<?php

    require_once "abstract.execquery.php";
    require_once "../model/class.conectores.php";

    class Insert extends ExecQuery{
        Private $tabela;
        Private $colunas;
        Private $valores;
        Private $ret;

        public function __construct($tabela,$colunas,$valores){
            $this -> setTabela($tabela);
            $this -> setColunas($colunas);
            $this -> setValores($valores);

            $base = new conectores();

            $insert = "Insert Into ";

            if($base -> getIsdbmysql()){
                $insert .= $base -> getDatabase().".";
            }

            $insert .= $this -> getTabela();

            if($colunas != ''){
                $insert .= " (".$this -> getColunas().")";
            }

            $insert .= " Values (Null,".$this -> getValores().")";
            
            //var_dump($insert);
            $this -> ret = $this -> query($insert);
            $this -> excluirPDO();
        }

        Public function getInsert(){
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

        Private function setColunas($colunas){
            $this -> colunas = $colunas;
        }

        Private function getColunas(){
            return $this -> colunas;
        }

        Private function setValores($valores){
            $this -> valores = $valores;
        }

        Private function getValores(){
            return $this -> valores;
        }
    }