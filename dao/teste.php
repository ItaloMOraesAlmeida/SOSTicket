<?php
    require_once 'import.base.php';
    
    $e = new ImpBase();
    $t = $e -> ImpbaseMysql();
    if($t == 1){
        var_dump($t);
    }else{
        var_dump($t);
    }