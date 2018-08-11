<?php

class UploadSimples{
    Private $pasta = '../resources/upload/';
    Private $nome;
    Private $tamanho = 1024 * 1024 * 2;
    Private $extensoes = array('png', 'jpg', 'pdf');
    Private $tipoExtensoes;
    Private $erro;

    Public function Upload($arquivo){
        if($arquivo['error'] != 0){
            $this -> setErro($arquivo['error']);
            echo $this -> getErro();
            exit;
        }else{
            $this -> setTipoExtensoes($arquivo['name']);
        }

        if(array_search($this -> getTipoExtensoes(), $this -> extensoes) === false){
            $this -> setErro(9);
            echo $this -> getErro();
            exit;
        }

        if($this -> tamanho < $arquivo['size']){
            $this -> setErro(10);
            echo $this -> getErro();
            exit;
        }

        if(move_uploaded_file($arquivo['tmp_name'],$this -> getPasta().$this -> getNome())){
            $this -> setErro(11);
            echo $this -> getErro()."<br>";
            echo "<img src='".$this -> getPasta().$this -> getNome()."' id='previsualizar'>";
            return array('arquivo' => $this -> getNome(), 'ret' => 1);
        }else{
            $this -> setErro(12);
            echo $this -> getErro();
            exit;
        }
    }

    Private function getPasta(){
        return $this -> pasta;
    }

    Private function getNome(){
        return md5(time()).".".$this -> getTipoExtensoes();
    }

    Private function getTamanho(){
        return $this -> tamanho;
    }

    Private function getExtensoes(){
        return $this -> extensoes;
    }

    Private function setTipoExtensoes($tipo){
        $this -> tipoExtensoes = strtolower(end(explode('.', $tipo)));
    }

    Private function getTipoExtensoes(){
        return $this -> tipoExtensoes;
    }

    Private function setErro($erro){
        $msg = array(   0 => '<div class="alert alert-danger"><strong>Sucesso:</strong> Não houve erro.</div>', 
                        1 => '<div class="alert alert-danger"><strong>Erro:</strong> O arquivo enviado excede o limite definido na diretiva.</div>',
                        2 => '<div class="alert alert-danger"><strong>Erro:</strong> O arquivo excede o limite definido no formulário HTML.</div>',
                        3 => '<div class="alert alert-danger"><strong>Erro:</strong> O upload do arquivo foi feito parcialmente.</div>',
                        4 => '<div class="alert alert-danger"><strong>Erro:</strong> Nenhum arquivo foi anexado.</div>',
                        6 => '<div class="alert alert-danger"><strong>Erro:</strong> Pasta temporária ausênte.</div>',
                        7 => '<div class="alert alert-danger"><strong>Erro:</strong> Falha em escrever o arquivo em disco.</div>',
                        8 => '<div class="alert alert-danger"><strong>Erro:</strong> Uma extensão do PHP interrompeu o upload do arquivo.</div>',
                        9 => '<div class="alert alert-danger"><strong>Erro:</strong> Formato do arquivo não é permitido.</div>',
                        10 => '<div class="alert alert-danger"><strong>Erro:</strong> O arquivo enviado excedeu o limite permitido (2MB).</div>',
                        11 => '<div class="alert alert-success"><strong>Sucesso:</strong> Arquivo anexado com sucesso.</div>',
                        12 => '<div class="alert alert-danger"><strong>Erro:</strong> Não foi possivel enviar o arquivo em anexo.</div>');
        $this -> erro = $msg[$erro];
    }

    Private function getErro(){
        return $this -> erro;
    }
}