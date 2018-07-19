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
        <h1 class="texto-banner">SOSTicket - Instalação</h1>
    </div>

    <!-- MASCARA PARA COBRIR O SITE -->
    <div id="mascara"></div>
    <!-- FIM DA MASCARA -->

    <!-- TELA DE INSTALAÇÃO -->

    <!-- CONTAINER DE INSTALAÇÃO -->
    <div class="container">

        <!-- JUMBOTRON -->
        <div class="jumbotron index">

            <!-- ALERTAS -->

            <div id="retornos"></div>

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
                                        <li class="active"><a href="#tabUsuAdm" data-toggle="tab">Administrador</a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="tabUsuAdm">
                                            <!-- COL ADMINISTRADOR -->
                                                <div class="col-md-12">
                                                <fieldset>
                                                    <legend>Cadastro do Administrador</legend>
                                                        <form class="form-horizontal" data-toggle="validator" onsubmit="return false"> <!-- FORMULÁRIO -->
                                                            <label>Nome</label>
                                                            <input class="form-control" type="text" placeholder="Digite o Nome do Usuário Administrador" id="nomAdm" name="nomAdm" ><br>
                                                            <label>Sobrenome</label>
                                                            <input class="form-control" type="text" placeholder="Digite o Sobrenome do Usuário Administrador" id="sobAdm" name="sobAdm" ><br>
                                                            <label>Email</label>
                                                            <input class="form-control" type="email" placeholder="Digite o Email do Usuário Administrador" id="emaAdm" name="emaAdm" ><br>
                                                            <label>Login</label>
                                                            <input class="form-control" type="text" placeholder="Digite o Login do Usuário Administrador" id="logAdm" name="logAdm" ><br>
                                                            <label>Senha</label>
                                                            <input class="form-control" type="password" placeholder="Digite a Senha do Usuário Administrador" id="pasAdm" name="pasAdm" data-minlength="1" ><br>
                                                </fieldset>
                                                
                                                <!-- CONCLUSÇÃO INSTALAÇÃO -->
                                                <fieldset>
                                                    <div>
                                                        <input type="button" class="btn btn-inverse btn-site" name="btnUsuAdm" id="btnUsuAdm" onclick="ajaxPost('../model/conclusao.instalacao.php', '#retornos')" value="Concluir">
                                                    </div>
                                                </fieldset>
                                                <!-- FIM CONCLUSÃO INSTALAÇÃO -->
                                            </div>
                                            <!-- FIM COL ADMINISTRADOR -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIM MENU TABELADO -->

            </div>
            <!-- FIM LINHA -->

            <div></div>

        </div>
        <!-- FIM JUMBOTRON -->

    </div>
    <!-- FIM DO CONTAINER DE INSTALAÇÃO -->

    <!--JavaScript-->
    <script type="text/javascript" src="../resources/js/jquery.js"></script>
    <script type="text/javascript" src="../resources/js/post.js"></script> 
    <script type="text/javascript" src="../resources/js/bootstrap.js"></script>
    <script type="text/javascript" src="../resources/js/index.js"></script>
    
</body>
</html>