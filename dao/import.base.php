<?php
    require_once '../model/class.conexao.php';

    class ImpBase {
        Private $base;
        Private $pdo;
        Private $exec;

        public function __construct(){
            $this -> setBase(new Conexao());
        }
        
        public function ImpbaseMysql(){
            try{
                $this -> setPdo($this -> getBase() -> conectarDb());
                $this -> setExec($this -> getPdo() -> prepare("
                "));
                $this -> getExec() -> execute();
            }catch(PDOException $e){
                echo 'ERROR: ' . $e->getMessage();
            }
        }

        public function ImpbaseSqlserver(){
            
        }

        Private function setBase($base){
            $this -> base = $base;
        }

        Private function getBase(){
            return $this -> base;
        }

        Private function setPdo($pdo){
            $this -> pdo = $pdo;
        }

        Private function getPdo(){
            return $this -> pdo;
        }

        Private function setExec($exec){
            $this -> exec = $exec;
        }

        Private function getExec(){
            return $this -> exec;
        }
    }