<?php
    require_once '../model/class.conexao.php';

    abstract class ExecQuery{
        Private $con;
        Private $pdo;
        Private $exe;

        Protected function query($query){
            $this -> setCon(new Conexao());
            $this -> setPdo($this -> getCon() -> conectarDb());
            $this -> setExec($this -> getPdo() -> prepare("$query"));
            $this -> getExec() -> execute();
            excluirPDO();  // Verificar como será o retorno desta classe e onde irá ficar a exclusão
            // Se vai ser nesta classe ou an classeresponsavel por montar a query
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