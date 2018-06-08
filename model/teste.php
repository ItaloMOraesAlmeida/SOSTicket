<?php

    require_once "class.email.php";

    $e = new Email();

    $teste = $e -> enviar('italo.moraes@inec.org.br','titulo teste','assunto teste');
    var_dump($teste);