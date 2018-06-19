<?php
    require_once '../model/class.conexao.php';

    abstract class ExecQuery{
        Private $con;
        Private $pdo;
        Private $exe;

        Protected function query($query){
            try{
                $this -> setCon(new Conexao());
                $this -> setPdo($this -> getCon() -> conectarDb());
                $this -> setExec($this -> getPdo() -> prepare("$query"));
                $this -> getExec() -> execute();
                return 1;
            }catch(PDOException $e){
                echo 'ERROR: ' . $e->getMessage();
            }
        }

        Protected function excluirPDO(){
            unset($this -> con);
            unset($this -> pdo);
            unset($this -> exe);
        }

        Private function setCon($con){
            $this -> con = $con;
        }

        Private function getCon($con){
            return $this -> con;
        }

        Private function setPdo($pdo){
            $this -> pdo = $$pdo;
        }

        Private function getPdo(){
            return $this -> pdo;
        }

        Private function setExe($exe){
            $this -> exe = $exe;
        }

        Private function getExe(){
            return $this -> exe;
        }
    }