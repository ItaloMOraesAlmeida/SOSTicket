<?php

    require_once "abstract.execquery.php";
    require_once "../model/class.conectores.php";

    class Select extends ExecQuery{
        Private $colunas;
        Private $tabela;
        Private $juncao;
        Private $condicao;
        Private $ret;
        Private $retselect;

        public function __construct($colunas,$tabela,$juncao,$condicao){
            $this -> setColunas($colunas);
            $this -> setTabela($tabela);
            $this -> setJuncao($juncao);
            $this -> setCondicao($condicao);

            $base = new conectores();

            $select = "Select ".$this -> getColunas()." From ";

            if($base -> getIsdbmysql()){
                $select .= $base -> getDatabase().".";
            }

            $select .= $this -> getTabela();

            if($this -> getJuncao() != ''){
                $select .= " Inner Join ".$base -> getDatabase().".".$this -> getJuncao();
            }

            if($this -> getCondicao() != ''){
                $select .= " Where ".$this -> getCondicao();
            }

            //var_dump($select);
            $this -> ret = $this -> query($select);
            $this -> setSelect($this -> getExe());
            $this -> excluirPDO();
        }

        Private function setSelect($select){
            $this -> retselect = $select;
        }

        Public function getSelect(){
            if($this -> ret == 1){
                return ["msg" => $this -> retselect, "val" => 1];
            }else{
                return ["msg" => $this -> ret, "val" => 0];
            }
        }

        Private function setColunas($colunas){
            $this -> colunas = $colunas;
        }

        Private function getColunas(){
            return $this -> colunas;
        }

        private function setTabela($tabela){
            $this -> tabela = $tabela;
        }

        Private function getTabela(){
            return $this -> tabela;
        }

        Private function setJuncao($juncao){
            $this -> juncao = $juncao;
        }

        Private function getJuncao(){
            return $this -> juncao;
        }

        Private function setCondicao($condicao){
            $this -> condicao = $condicao;
        }

        Private function getCondicao(){
            return $this -> condicao;
        }
    }