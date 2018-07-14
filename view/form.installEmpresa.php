<?php
require_once "../dao/class.select.php";
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
    <?php
    require_once "../model/modal/modal.editar.local.php";
    require_once "../model/modal/modal.editar.cargo.php";
    require_once "../model/modal/modal.editar.situacao.php";
    require_once "../model/modal/modal.editar.servico.php";
    ?>

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
                                        <li class="active"><a href="#tabEmpresa" data-toggle="tab">Informações</a></li>
                                        <li><a href="#tabLocais" data-toggle="tab">Locais/Setores</a></li>
                                        <li><a href="#tabCargos" data-toggle="tab">Cargos</a></li>
                                        <li><a href="#tabSituacao" data-toggle="tab">Situações/Status</a></li>
                                        <li><a href="#tabServicos" data-toggle="tab">Serviços</a></li>
                                        <li><a href="#tabConc" data-toggle="tab">Etapa Final</a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="tabEmpresa">
                                            <!-- COL EMPRESA -->
                                            <fieldset>
                                                <legend>Informações Sobre a Empresa</legend>
                                                <!-- FORMULÁRIO -->
                                                <form class="form-horizontal" data-toggle="validator" onsubmit="return false">
                                                    <label>Nome</label>
                                                    <input class="form-control" type="text" placeholder="Digite o Nome da Empresa" id="empNom" name="empNom"><br>
                                                    <label>CNPJ</label>
                                                    <input class="form-control" type="numeric" placeholder="Digite o CNPJ da Empresa" id="empCnpj" name="empCnpj" maxlength="14" ><br>
                                                    <label>CEP</label>
                                                    <input class="form-control" type="numeric" placeholder="Digite o CEP da Empresa" id="empCep" name="empCep" maxlength="8" ><br>
                                                    <label>Pais</label>
                                                    <input class="form-control" type="text" placeholder="Digite o Pais da Empresa" id="empPais" name="empPais" ><br>
                                                    <label>Estado</label>
                                                    <input class="form-control" type="text" placeholder="Digite o Estado da Empresa" id="empEstado" name="empEstado" ><br>
                                                    <label>Cidade</label>
                                                    <input class="form-control" type="text" placeholder="Digite a Cidade da Empresa" id="empCidade" name="empCidade" ><br>
                                                    <label>Complemento</label>
                                                    <input class="form-control" type="text" placeholder="Digite o Complemento do Local da Empresa" id="empComplemento" name="empComplemento" ><br>
                                                    <label>Telefone</label>
                                                    <input class="form-control" type="numeric" placeholder="Digite o Telefone da Empresa" id="empTel" name="empTel" maxlength="11" ><br>
                                                    <label>Logo da Empresa</label>
                                                    <input class="form-control" type="file" placeholder="teste" id="empLogo" name="MAX_FILE_SIZE" value="2097152" ><br> <!-- "VALUE" equivalente a 2M para o tamanho maximo do arquivo -->

                                                    <div>
                                                        <input type="button" class="btn btn-inverse btn-site" name="btnSavDadosEmp" id="btnSavDadosEmp" onclick="ajaxPost('../model/install.empresa.php?tip=1', '#retornos')" value="Salvar">
                                                    </div>
                                            </fieldset>
                                            <!-- FIM COL EMPRESA -->
                                        </div>

                                        <div class="tab-pane fade" id="tabLocais">
                                            <!-- COL SETORES/LOCAIS -->
                                            <fieldset>
                                                    <legend>Setores</legend>
                                                    <label>Empresa</label>

                                                    <select class="form-control" id="empresaEmpresa" name="empresaEmpresa">
                                                        <option>Selecione a Empresa...</option>
                                                        <?php
                                                            $comboBox = new Select('codEmp,EmpNom','tEmpresa','','');
                                                            $array = $comboBox -> getSelect();
                                                            if($array['val'] == 1){
                                                                foreach ($array['msg'] as $row){ 
                                                                    ?>
                                                                    <option value="<?php echo $row['codEmp']?>"><?php echo $row['EmpNom']?></option>
                                                                    <?php
                                                                }
                                                            }else{
                                                                ?>
                                                                <option><?php echo $array['msg']?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                    
                                                    <label>Setor</label>
                                                    <input class="form-control" type="text" placeholder="Digite o Setor de Sua Empresa" id="empLoc" name="empLoc"><br>
                                                    <div>
                                                        <input type="button" class="btn btn-inverse btn-site" name="btnAddSet" id="btnAddSet" onclick="ajaxPost('../model/install.empresa.php?tip=2', '#retornos')" value="Adicionar">
                                                    </div>
                                                    
                                                    <input type="button" class="btn btn-inverse btn-site" name="btnGridSet" id="btnGridSet" onclick="ajaxPost('../model/grid.php?nc=Local/Setor;Empresa;Data de Cadastro&m=Local&b=delete&s=l.codLoc,l.locNom,e.empNom,l.locDca;tLocal l;tEmpresa e On (l.codEmp = e.codEmp);', '#retGridSet')" value="Atualizar">
                                                    <div id="retGridSet">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th>Local/Setor</th>
                                                                            <th>Empresa</th>
                                                                            <th>Data de Cadastro</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tboby>
                                                                        <?php
                                                                            $gridSet = new Select('l.codLoc,l.locNom,e.empNom,l.locDca','tLocal l','tEmpresa e On (l.codEmp = e.codEmp)','');
                                                                            $array = $gridSet -> getSelect();
                                                                            if($array['val'] == 1){
                                                                                $id = "Local";
                                                                                foreach ($array['msg'] as $row){
                                                                                    $value  += 1;
                                                                                    ?>
                                                                                    <tr id="<?php echo $id.$value ?>">
                                                                                        <td>
                                                                                            <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Local-modal' onclick='editarLocal("<?php echo $id.$value ?>")'>Editar</button>
                                                                                            <button type='button' class='btn btn-danger' onclick="ajaxFunction('../model/class.delete.Local.php',<?php echo $row['codLoc']; ?>,'#retornos')">Excluir</button>
                                                                                        </td>
                                                                                        <td style="visibility: hidden;"><?php echo $row['codLoc']; ?></td>
                                                                                        <td><?php echo $row['locNom']; ?></td>
                                                                                        <td><?php echo $row['empNom']; ?></td>
                                                                                        <td><?php echo $row['locDca']; ?></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            }else{
                                                                                echo $array['msg'];
                                                                            }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </fieldset>
                                            <!-- FIM COL SETORES/LOCAIS -->
                                        </div>

                                        <div class="tab-pane fade" id="tabCargos">
                                            <!-- COL CARGOS -->
                                            <fieldset>
                                                <legend>Cargos</legend>
                                                <input class="form-control" type="text" placeholder="Digite o Cargo de Sua Empresa" id="empCarg" name="empCarg"><br>
                                                <div>
                                                    <input type="button" class="btn btn-inverse btn-site" name="btnAddCarg" id="btnAddCarg" onclick="ajaxPost('../model/install.empresa.php?tip=3', '#retornos')" value="Adicionar">
                                                </div>

                                                <input type="button" class="btn btn-inverse btn-site" name="btnGridCar" id="btnGridCar" onclick="ajaxPost('../model/grid.php?nc=Cargo;Data de Cadastro&m=Cargo&b=delete&s=c.codCar,c.carNom,c.carDca;tCargo c;', '#retGridCar')" value="Atualizar">
                                                <div id="retGridCar">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th>Cargo</th>
                                                                        <th>Data de Cadastro</th>
                                                                    </tr>
                                                                </thead>
                                                                <tboby>
                                                                    <?php
                                                                        $gridCar = new Select('codCar,carNom,carDca','tCargo','','');
                                                                        $array = $gridCar -> getSelect();
                                                                        if($array['val'] == 1){
                                                                            $id = "Cargo";
                                                                            foreach ($array['msg'] as $row){
                                                                                $value += 1;
                                                                                ?>
                                                                                <tr id="<?php echo $id.$value ?>">
                                                                                    <td>
                                                                                        <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Cargo-modal' onclick='editarCargo("<?php echo $id.$value ?>")'>Editar</button>
                                                                                        <button type='button' class='btn btn-danger' onclick="ajaxFunction('../model/class.delete.Cargo.php',<?php echo $row['codCar']; ?>,'#retornos')">Excluir</button>
                                                                                    </td>
                                                                                    <td style="visibility: hidden;"><?php echo $row['codCar']; ?></td>
                                                                                    <td><?php echo $row['carNom']; ?></td>
                                                                                    <td><?php echo $row['carDca']; ?></td>
                                                                                </tr>
                                                                                <?php
                                                                            }
                                                                        }else{
                                                                            echo $array['msg'];
                                                                        }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!-- FIM COL CARGOS -->
                                        </div>

                                        <div class="tab-pane fade" id="tabSituacao">
                                            <!-- COL SITUAÇÃO/STATUS -->
                                            <fieldset>
                                                <legend>Situação</legend>
                                                <input class="form-control" type="text" placeholder="Digite a Situação dos Empregados de Sua Empresa" id="empSit" name="empSit"><br>
                                                <div>
                                                    <input type="button" class="btn btn-inverse btn-site" name="btnAddSit" id="btnAddSit" onclick="ajaxPost('../model/install.empresa.php?tip=4', '#retornos')" value="Adicionar">
                                                </div>

                                                <input type="button" class="btn btn-inverse btn-site" name="btnGridSit" id="btnGridSit" onclick="ajaxPost('../model/grid.php?nc=Situação;Data de Cadastro&m=Situacao&b=delete&s=s.codSit,s.sitNom,s.sitDca;tSituacao s;', '#retGridSit')" value="Atualizar">
                                                <div id="retGridSit">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th>Situação</th>
                                                                        <th>Data de Cadastro</th>
                                                                    </tr>
                                                                </thead>
                                                                <tboby>
                                                                    <?php
                                                                        $gridSit = new Select('codSit,sitNom,sitDca','tSituacao','','');
                                                                        $array = $gridSit -> getSelect();
                                                                        if($array['val'] == 1){
                                                                            $id = "Situacao";
                                                                            foreach ($array['msg'] as $row){
                                                                                $value += 1;
                                                                                ?>
                                                                                <tr id="<?php echo $id.$value ?>">
                                                                                    <td>
                                                                                        <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Situacao-modal' onclick='editarSituacao("<?php echo $id.$value ?>")'>Editar</button>
                                                                                        <button type='button' class='btn btn-danger' onclick="ajaxFunction('../model/class.delete.Situacao.php',<?php echo $row['codSit']; ?>,'#retornos')">Excluir</button>
                                                                                    </td>
                                                                                    <td style="visibility: hidden;"><?php echo $row['codSit']; ?></td>
                                                                                    <td><?php echo $row['sitNom']; ?></td>
                                                                                    <td><?php echo $row['sitDca']; ?></td>
                                                                                </tr>
                                                                                <?php
                                                                            }
                                                                        }else{
                                                                            echo $array['msg'];
                                                                        }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!-- FIM COL SITUAÇÃO/STATUS -->
                                        </div>

                                        <div class="tab-pane fade" id="tabServicos">
                                            <!-- COL SERVIÇOS -->
                                            <fieldset>
                                                <legend>Serviços</legend>
                                                <label>Local/Setor</label>
                                                <select class="form-control" id="setorEmpresa" name="setorEmpresa">
                                                    <option>Selecione o Setor...</option>
                                                    <?php
                                                        $comboBox = new Select('codLoc,LocNom','tLocal','','');
                                                        $array = $comboBox -> getSelect();
                                                        if($array['val'] == 1){
                                                            foreach ($array['msg'] as $row) { 
                                                                ?>
                                                                <option value="<?php echo $row['codLoc']?>"><?php echo $row['LocNom']?></option>
                                                                <?php
                                                            }
                                                        }else{
                                                            ?>
                                                            <option><?php echo $array['msg']?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                                <label>Tempo de Conclusão</label>
                                                <select class="form-control" id="tempoConclusaoEmpresa" name="tempoConclusaoEmpresa">
                                                    <option>Selecione o Tempo de Concusão do Serviço...</option>
                                                    <?php
                                                        $comboBox = new Select('codTco,TcoNom','tTempoConclusao','','');
                                                        $array = $comboBox -> getSelect();
                                                        if($array['val'] == 1){
                                                            foreach ($array['msg'] as $row) { 
                                                                ?>
                                                                <option value="<?php echo $row['codTco']?>"><?php echo $row['TcoNom']?></option>
                                                                <?php
                                                            }
                                                        }else{
                                                            ?>
                                                            <option><?php echo $array['msg']?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                                <label>Serviço</label>
                                                <input class="form-control" type="text" placeholder="Digite o Serviço do Setor Selecionado de Sua Empresa" id="empServ" name="empServ"><br>
                                                <div>
                                                    <input type="button" class="btn btn-inverse btn-site" name="btnAddServ" id="btnAddServ" onclick="ajaxPost('../model/install.empresa.php?tip=5', '#retornos')" value="Adicionar">
                                                </div>

                                                <input type="button" class="btn btn-inverse btn-site" name="btnGridSer" id="btnGridSer" onclick="ajaxPost('../model/grid.php?nc=Serviço;Local/Setor;Data de Cadastro&m=Servico&b=delete&s=s.codSer,s.serNom,l.locNom,s.serDca;tServico s;tLocal l On (s.codSer = l.codLoc)', '#retGridSer')" value="Atualizar">
                                                <div id="retGridSer">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th>Serviço</th>
                                                                        <th>Local/Setor</th>
                                                                        <th>Data de Cadastro</th>
                                                                    </tr>
                                                                </thead>
                                                                <tboby>
                                                                    <?php
                                                                        $gridSer = new Select('s.codSer,s.serNom,s.serDca,l.locNom','tServico s','tLocal l On (s.codSer = l.codLoc)','');
                                                                        $array = $gridSer -> getSelect();
                                                                        if($array['val'] == 1){
                                                                            $id = "Servico";
                                                                            foreach ($array['msg'] as $row){
                                                                                $value += 1;
                                                                                ?>
                                                                                <tr id="<?php echo $id.$value ?>">
                                                                                    <td>
                                                                                        <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#Servico-modal' onclick='editarServico("<?php echo $id.$value ?>")'>Editar</button>
                                                                                        <button type='button' class='btn btn-danger' onclick="ajaxFunction('../model/class.delete.Servico.php',<?php echo $row['codSer']; ?>,'#retornos')">Excluir</button>
                                                                                    </td>
                                                                                    <td style="visibility: hidden;"><?php echo $row['codSer']; ?></td>
                                                                                    <td><?php echo $row['serNom']; ?></td>
                                                                                    <td><?php echo $row['locNom']; ?></td>
                                                                                    <td><?php echo $row['serDca']; ?></td>
                                                                                </tr>
                                                                                <?php
                                                                            }
                                                                        }else{
                                                                            echo $array['msg'];
                                                                        }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!-- FIM COL SERVIÇOS -->
                                        </div>

                                        <div class="tab-pane fade" id="tabConc">
                                            <!-- COL ETAPA FINAL -->
                                            <fieldset>
                                                <div>
                                                    <a href="../model/install.empresa.php?tip=6" /><input type="button" class="btn btn-inverse btn-site" name="btnEnvDados" id="btnEnvDados" value="Enviar Dados">
                                                </div>
                                            </fieldset>
                                            <!-- FIM COL ETAPA FINAL -->
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