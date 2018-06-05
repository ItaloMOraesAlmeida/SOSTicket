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

    <!-- JavaScript -->
    <script type="text/javascript">
        function desabilitar(){ // Efetua  a ação de desabilitar todo sos campos do Active Directory
            if(document.getElementById("checkAD").checked == true){
                document.getElementById("tipAD").disabled = true;
                document.getElementById("hostAD").disabled = true;
                document.getElementById("portaAD").disabled = true;
                document.getElementById("domiAD").disabled = true;
                document.getElementById("verProtAD").disabled = true;
            }else{
                document.getElementById("tipAD").disabled = false;
                document.getElementById("hostAD").disabled = false;
                document.getElementById("portaAD").disabled = false;
                document.getElementById("domiAD").disabled = false;
                document.getElementById("verProtAD").disabled = false;
            }
        }
    </script>

</head>
<body>

    <!-- BANNER -->
    <div class="banner col-md-12">
        <h1 class="texto-banner">SOSTicket - Instalação</h1>
    </div>

    <!-- MASCARA PARA COBRIR O SITE -->
    <div id="mascara"></div>
    <!-- FIM DA MASCARA -->

    <!-- MODAL -->
    <div class="modal fade" id="termo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle">Termos e Condições</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM DO MODAL -->

    <!-- TELA DE INSTALAÇÃO -->

    <!-- CONTAINER DE INSTALAÇÃO -->
    <div class="container">

        <!-- JUMBOTRON -->
        <div class="jumbotron index">

            <!-- ALERTAS -->

            <?php

                if($ret == 1){
                    echo '  <div class="alert alert-danger">
                                <strong>OPS! Algo Deu Errado!</strong> Termos de uso devem ser aceitos.
                            </div>';
                }else if($ret == 2){
                    echo '  <div class="alert alert-danger">'.
                                $inf
                            .'</div>';
                }else if($ret == 3){
                    echo '  <div class="alert alert-danger">'.
                                $inf
                            .'</div>';
                }

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
                                        <li class="active"><a href="#tabDataBase" data-toggle="tab">Base de Dados</a></li>
                                        <li><a href="#tabActiveDirectory" data-toggle="tab">Active Directory</a></li>
                                        <li><a href="#tabEmail" data-toggle="tab">Email</a></li>
                                        <!--<li><a href="#tabAdministrador" data-toggle="tab">Administrador</a></li>-->
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="tabDataBase">
                                            <!-- COL BASE DE DADOS -->
                                                <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                                                    <li class="list-group-item">
                                                        Excluir a Base de Dados Existente?
                                                        <div class="material-switch pull-right">
                                                            <input id="checkDB" name="checkDB" type="checkbox"/>
                                                            <label for="checkDB" class="label-success"></label>
                                                        </div>
                                                    </li>
                                                </div>
                                                <div class="col-md-12">
                                                <fieldset>
                                                    <legend>Cadastro da Base de Dados</legend>
                                                        <form class="form-horizontal" data-toggle="validator" action="../model/install.php" method="post"> <!-- FORMULÁRIO -->
                                                            <label>Tipo de Base</label>
                                                            <select class="form-control" id="tipbase" name="tipbase">
                                                                <option value="0">Selecione</option>
                                                                <option value="sqlsrv">SQL SERVER</option>
                                                                <option value="mysql">MySQL</option>
                                                            </select>
                                                            <label>Host</label>
                                                            <input class="form-control" type="text" placeholder="Digite o Host - EX: 127.0.0.1" id="hostBD" name="hostBD" maxlength="15" ><br>
                                                            <label>Base de Dados</label>
                                                            <input class="form-control" type="text" placeholder="Digite o Nome da Base de Dados" id="database" name="database" ><br>
                                                            <label>Usuário</label>
                                                            <input class="form-control" type="text" placeholder="Digite o Nome do Usuário" id="usernameBD" name="usernameBD" ><br>
                                                            <label>Senha</label>
                                                            <input class="form-control" type="password" placeholder="Digite a Senha da Base de Dados" id="passwordBD" name="passwordBD" data-minlength="1" ><br>
                                                </fieldset>
                                            </div>
                                            <!-- FIM COL BASE DE DADOS -->
                                        </div>

                                        <div class="tab-pane fade" id="tabActiveDirectory">
                                            <!-- COL ACTIVE DIRECTORY -->
                                                <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                                                    <li class="list-group-item">
                                                        Autenticação pelo Activite Directory
                                                        <div class="material-switch pull-right">
                                                            <input id="checkAD" name="checkAD" type="checkbox" onclick="desabilitar()"/>
                                                            <label for="checkAD" class="label-success"></label>
                                                        </div>
                                                    </li>
                                                </div>
                                                <div class="col-md-12">
                                                <fieldset>
                                                    <legend>Cadastro do Active Directory</legend>
                                                            <label>Tipo de Host</label>
                                                            <select class="form-control" id="tipAD" name="tipAD">
                                                                <option value="0">Selecione</option>
                                                                <option value="ldap">LDAP</option>
                                                                <option value="ldaps">LDAPS</option>
                                                            </select>
                                                            <label>Host</label>
                                                            <input class="form-control" type="text" placeholder="Digite Host - Ex: 127.0.0.1" id="hostAD" name="hostAD" maxlength="15" ><br>
                                                            <label>Porta</label>
                                                            <input class="form-control" type="text" placeholder="Digite a Porta" id="portaAD" name="portaAD" ><br>
                                                            <label>Domínio</label>
                                                            <input class="form-control" type="text" placeholder="Digite o Domínio - Exemplo: @dominio.com" id="domiAD" name="domiAD" ><br>
                                                            <label>Verção do Protocolo</label>
                                                            <input class="form-control" type="text" placeholder="Digite a Verção do Protocolo" id="verProtAD" name="verProtAD" maxlength="2" ><br>
                                                </fieldset>
                                            </div>
                                            <!-- FIM COL ACTIVE DIRECTORY -->
                                        </div>

                                        <div class="tab-pane fade" id="tabEmail">
                                            <!-- COL EMAIL -->
                                            <div class="col-md-12">
                                                <fieldset>
                                                    <legend>Cadastro do Email</legend>
                                                            <label>Charset</label>
                                                            <select class="form-control" id="charsetEmail" name="charsetEmail">
                                                                <option value="0">Selecione</option>
                                                                <option value="UTF-8">UTF-8</option>
                                                            </select>
                                                            <label>Host</label>
                                                            <input class="form-control" type="text" placeholder="Digite Host Ex: 127.0.0.1" id="hostEmail" name="hostEmail" maxlength="15" ><br>
                                                            <label>Porta</label>
                                                            <input class="form-control" type="text" placeholder="Digite a Porta" id="portaEmail" name="portaEmail" ><br>
                                                            <label>Protocolo de Segurança</label>
                                                            <select class="form-control" id="protocoloEmail" name="protocoloEmail">
                                                                <option value="0">Selecione</option>
                                                                <option value="tls">TLS (Transport Layer Security)</option>
                                                            </select>
                                                            <label>Autenticação SMTP</label>
                                                            <select class="form-control" id="autenticacaoEmail" name="autenticacaoEmail">
                                                                <option value="0">Selecione</option>
                                                                <option value="true">Sim</option>
                                                                <option value="false">Não</option>
                                                            </select>
                                                            <label>Usuário do Servidor SMTP</label>
                                                            <input class="form-control" type="text" placeholder="Digite o Usuário" id="userEmail" name="userEmail" ><br>
                                                            <label>Senha do Servidor SMTP</label>
                                                            <input class="form-control" type="password" placeholder="Digite a Senha" id="passEmail" name="passEmail" ><br>
                                                            <label>Email do Remetente</label>
                                                            <input class="form-control" type="email" placeholder="Digite o Email do Remetente" id="remetenteEmail" name="remetenteEmail" ><br>
                                                            <label>Nome do Remetente</label>
                                                            <input class="form-control" type="text" placeholder="Digite o Nome do Remetente" id="nomeRemetenteEmail" name="nomeRemetenteEmail" ><br>
                                                            <label>Email de Teste</label>
                                                            <input class="form-control" type="email" placeholder="Digite o Email. OBS: Este será usado apenas para envio de um email de teste" id="emailTeste" name="emailTeste" ><br>

                                                            <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                                                                <li class="list-group-item">
                                                                    <a data-toggle="modal" data-target="#termo">Li e Aceito os Termos de Uso!</a>
                                                                    <div class="material-switch pull-right input-termo">
                                                                        <input id="check" name="check" type="checkbox"/>
                                                                        <label for="check" class="label-success"></label>
                                                                    </div>
                                                                </li>
                                                            </div>
                                
                                                            <div>
                                                                <input type="submit" class="btn btn-inverse btn-site" name="btnCad" id="btnCad" value="Instalar">
                                                            </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tabAdministrador">
                                            <!-- COL ADIMISTRADOR -->
                                        <!--    <div class="col-md-12">
                                                <fieldset>
                                                    <legend>Cadastro do Administrador</legend>
                                                            <label>Primeiro Nome</label>
                                                            <input class="form-control" type="text" placeholder="Digite o Primeiro Nome do Administrador" id="pNomADM" name="pNomADM" ><br>
                                                            <label>Segundo Nome</label>
                                                            <input class="form-control" type="text" placeholder="Digite o Segundo Nome do Administrador" id="sNomADM" name="sNomADM" ><br>
                                                            <label>Email</label>
                                                            <input class="form-control" type="email" placeholder="Digite o Email" id="emailADM" name="emailADM" ><br>
                                                            <label>CPF</label>
                                                            <input class="form-control" type="text" placeholder="Digite o CPF do Administrador" id="cpfADM" name="cpfADM" ><br>
                                                            <label>Data de Nascimento</label>
                                                            <input class="form-control" type="date" placeholder="Digite a Data de Nascimento do Administrador" id="datNasADM" name="datNasADM" ><br>
                                                            <label>Telefone</label>
                                                            <input class="form-control" type="number" placeholder="Digite o Telefone do Administrador" id="telADM" name="telADM" ><br>
                                                            <label>Sexo</label>
                                                            <select class="form-control" id="sexoADM" name="sexoADM">
                                                                <option value="0">Selecione o Sexo do Administrador</option>
                                                                <option value="M">Masculino</option>
                                                                <option value="F">Feminino</option>
                                                            </select>
                                                            <label>Usuário</label>
                                                            <input class="form-control" type="text" placeholder="Digite o Usuário" id="userADM" name="userADM" data-minlength="6" ><br>
                                                            <label>Senha</label>
                                                            <input class="form-control" type="password" placeholder="Digite a Senha" id="passwordADM" name="passwordADM" ><br>
                                                            <span class="help-block">Mínimo de seis (6) digitos</span>
                                                            <label>Repetir Senha</label>
                                                            <input class="form-control" type="password" placeholder="Digite Novamente a Senha" id="password2ADM" name="password2ADM" ><br>
                                
                                                            <div>
                                                                <label>
                                                                    <a data-toggle="modal" data-target="#termo">Li e Aceito os Termos de Uso!</a>
                                                                </label>
                                                                <div class="material-switch pull-right input-termo">
                                                                    <input id="check" name="check" type="checkbox"/>
                                                                </div>
                                                            </div>
                                
                                                            <div>
                                                                <input type="submit" class="btn btn-inverse btn-site" name="btnCad" id="btnCad" value="Instalar">
                                                            </div> -->
                                                        </form> <!-- FIM DO FORMULÁRIO -->
                                                </fieldset>
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
    <script type="text/javascript" src="../resources/js/bootstrap.js"></script>
    <script type="text/javascript" src="../resources/js/index.js"></script>
    
</body>
</html>