<?php

$modal = '  <script>
            function editarServico(tr){
                var linha = document.getElementById(tr);
                var colunas = linha.getElementsByTagName("td");
                document.getElementById("ModalempSer").value = colunas[2].firstChild.nodeValue;
                document.getElementById("ModalIdServico").value = colunas[1].firstChild.nodeValue;
            }
        </script>
        <div class="modal fade" role="dialog" id="Servico-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Editar Serviço</h3>
                    </div>
                    <div class="modal-body">
                        <div id="modalServicoRetornos"></div>
                        <form class="form-horizontal" data-toggle="validator" onsubmit="return false">
                            <label>Local/Setor</label>
                            <select class="form-control" id="modalSetorEmpresa" name="modalSetorEmpresa">
                                <option>Selecione o Setor...</option>';
                                    $comboBox = new Select('codLoc,LocNom','tLocal','','');
                                    $array = $comboBox -> getSelect();
                                    if($array['val'] == 1){
                                        foreach ($array['msg'] as $row) {
                                            $modal .= '<option value="'.$row['codLoc'].'">'.$row['LocNom'].'</option>';
                                        }
                                    }else{
                                        $modal .= '<option>'.$array['msg'].'</option>';
                                    }
                    $modal .='</select>
                            <label>Tempo de Conclusão</label>
                            <select class="form-control" id="modalTempoConclusaoEmpresa" name="modalTempoConclusaoEmpresa">
                                <option>Selecione o Tempo de Concusão do Serviço...</option>';
                                    $comboBox = new Select('codTco,TcoNom','tTempoConclusao','','');
                                    $array = $comboBox -> getSelect();
                                    if($array['val'] == 1){
                                        foreach ($array['msg'] as $row) {
                                            $modal .= '<option value="'.$row['codTco'].'">'.$row['TcoNom'].'</option>';
                                        }
                                    }else{
                                        $modal .= '<option>'.$array['msg'].'</option>';
                                    }
                    $modal .='</select>
                            <label>Serviço</label>
                            <input class="form-control" type="text" placeholder="Digite o Serviço do Setor Selecionado de Sua Empresa" id="ModalempSer" name="ModalempSer"><br>
                            <input class="form-control" type="hidden" id="ModalIdServico" name="ModalIdServico">
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="'.$loc = "ajaxPost('../model/update.modal.editar.servico.php', '#modalServicoRetornos')".'" >Salvar</button>
                        </form>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" >Sair</button>
                    </div>
                </div>
            </div>
        </div>';
echo $modal;