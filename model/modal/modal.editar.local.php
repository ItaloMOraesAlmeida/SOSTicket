<?php

$modal = '  <script>
            function editarLocal(tr){
                var linha = document.getElementById(tr);
                var colunas = linha.getElementsByTagName("td");
                document.getElementById("ModalempLoc").value = colunas[2].firstChild.nodeValue;
                document.getElementById("ModalIdLocal").value = colunas[1].firstChild.nodeValue;
            }
        </script>
        <div class="modal fade" role="dialog" id="Local-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Editar Setores</h3>
                    </div>
                    <div class="modal-body">
                        <div id="modalSetoresRetornos"></div>
                        <form class="form-horizontal" data-toggle="validator" onsubmit="return false">
                            <label>Empresa</label>
                            <select class="form-control" id="ModalempresaEmpresa" name="ModalempresaEmpresa">
                                <option>Selecione a Empresa...</option>';
                                    $comboBox = new Select('codEmp,EmpNom','tEmpresa','','');
                                    $array = $comboBox -> getSelect();
                                    if($array['val'] == 1){
                                        foreach ($array['msg'] as $row){
                                            $modal .= '<option value="'.$row['codEmp'].'">'.$row['EmpNom'].'</option>';
                                        }
                                    }else{
                                        $modal .= '<option>'.$array['msg'].'</option>';
                                    }
                    $modal .='</select>
                            <label>Setor</label>
                            <input class="form-control" type="text" placeholder="Digite o Setor de Sua Empresa" id="ModalempLoc" name="ModalempLoc"><br>
                            <input class="form-control" type="hidden" id="ModalIdLocal" name="ModalIdLocal">
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="'.$loc = "ajaxPost('../model/update.modal.editar.local.php', '#modalSetoresRetornos')".'" >Salvar</button>
                        </form>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" >Sair</button>
                    </div>
                </div>
            </div>
        </div>';
echo $modal;