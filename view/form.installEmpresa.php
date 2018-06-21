<?php
// Retorno dos aletas
    $ret = $_GET['ret'];
    $inf = $_GET['msg'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SOSTcket - Instalação</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../resources/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../resources/css/index.css">
    <link rel="stylesheet" type="text/css" href="../resources/css/aba.css">
    <link rel="stylesheet" type="text/css" href="../resources/css/cssCheckbox.css">
                                    
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="../resources/css/fonts.css">

</head>
<body>

    <!-- BANNER -->
    <div class="banner col-md-12">
        <h1 class="texto-banner">SOSTicket - Informações da Empresa</h1>
    </div>

    <!-- TELA DE INSTALAÇÃO -->

    <!-- CONTAINER DE INSTALAÇÃO -->
    <div class="container">

        <!-- JUMBOTRON -->
        <div class="jumbotron index">

            <!-- ALERTAS -->

            <?php

                

            ?>

            <!-- FIM ALERTAS -->

            <!-- Linha -->
            <div class="row">

                <!-- MENU TABELADO DE CADASTRO -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel with-nav-tabs panel-primary">
                                <div class="panel-heading">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tabEmpresa" data-toggle="tab">Informações</a></li>
                                        <li><a href="#tabLocais" data-toggle="tab">Locais/Setores</a></li>
                                        <li><a href="#tabCargos" data-toggle="tab">Cargos</a></li>
                                        <li><a href="#tabSituacao" data-toggle="tab">Situações/Status</a></li>
                                        <li><a href="#tabServicos" data-toggle="tab">Serviços</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIM MENU TABELADO -->

            </div>
            <!-- FIM LINHA -->

        </div>
        <!-- FIM JUMBOTRON -->

    </div>
    <!-- FIM DO CONTAINER DE INSTALAÇÃO -->

    <!--JavaScript-->
    <script type="text/javascript" src="../resources/js/jquery.js"></script> 
    <script type="text/javascript" src="../resources/js/bootstrap.js"></script>
    <script type="text/javascript" src="../resources/js/index.js"></script>
    
</body>
</html>