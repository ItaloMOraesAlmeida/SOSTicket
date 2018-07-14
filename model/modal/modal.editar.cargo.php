<?php

$modal = '  <script>
            function editarCargo(tr){
                var linha = document.getElementById(tr);
                var colunas = linha.getElementsByTagName("td");
                document.getElementById("ModalempCar").value = colunas[2].firstChild.nodeValue;
                document.getElementById("ModalIdCargo").value = colunas[1].firstChild.nodeValue;
            }
        </script>
        <div class="modal fade" role="dialog" id="Cargo-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Editar Cargo</h3>
                    </div>
                    <div class="modal-body">
                        <div id="modalCargoRetornos"></div>
                        <form class="form-horizontal" data-toggle="validator" onsubmit="return false">
                            <label>Cargo</label>
                            <input class="form-control" type="text" placeholder="Digite o Cargo de Sua Empresa" id="ModalempCar" name="ModalempCar"><br>
                            <input class="form-control" type="hidden" id="ModalIdCargo" name="ModalIdCargo">
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="'.$loc = "ajaxPost('../model/update.modal.editar.cargo.php', '#modalCargoRetornos')".'" >Salvar</button>
                        </form>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" >Sair</button>
                    </div>
                </div>
            </div>
        </div>';
echo $modal;