<?php

$modal = '  <script>
            function editarSituacao(tr){
                var linha = document.getElementById(tr);
                var colunas = linha.getElementsByTagName("td");
                document.getElementById("ModalempSit").value = colunas[2].firstChild.nodeValue;
                document.getElementById("ModalIdSituacao").value = colunas[1].firstChild.nodeValue;
            }
        </script>
        <div class="modal fade" role="dialog" id="Situacao-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Editar Situação</h3>
                    </div>
                    <div class="modal-body">
                        <div id="modalSituacaoRetornos"></div>
                        <form class="form-horizontal" data-toggle="validator" onsubmit="return false">
                            <label>Situação</label>
                            <input class="form-control" type="text" placeholder="Digite a Situação dos Empregados de Sua Empresa" id="ModalempSit" name="ModalempSit"><br>
                            <input class="form-control" type="hidden" id="ModalIdSituacao" name="ModalIdSituacao">
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="'.$loc = "ajaxPost('../model/update.modal.editar.situacao.php', '#modalSituacaoRetornos')".'" >Salvar</button>
                        </form>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" >Sair</button>
                    </div>
                </div>
            </div>
        </div>';
echo $modal;