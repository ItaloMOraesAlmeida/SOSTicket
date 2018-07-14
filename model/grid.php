<?php
require_once "../dao/class.select.php";

$grid = "
<div class='row'>
    <div class='col-md-12'>
        <table class='table'>
            <thead>
                <tr>
                    <th></th>
                    <th></th>";
                    $array = explode(';',$_GET['nc']);
                    foreach ($array as $valores){
                        $grid .= "<th>".$valores."</th>";
                    }
        $grid .="</tr>
            </thead>
            <tboby>";
                $dados = explode(';',$_GET['s']);
                $linhas = explode(',',$dados[0]);
                $gridSet = new Select($dados[0],$dados[1],$dados[2],$dados[3]);
                $array = $gridSet -> getSelect();
                if($array['val'] == 1){
                    foreach ($array['msg'] as $row){
                        $id += 1;
                        $hidden = 1;
                        $grid .= '
                        <tr id='.$_GET['m'].$id.'>
                            <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#'.$_GET['m'].'-modal" onclick="editar'.$_GET['m'].'(\''.$_GET['m'].$id.'\')" >Editar</button>
                                <button type="button" class="btn btn-danger" onclick="ajaxFunction(\'../model/class.'.$_GET['b'].'.'.$_GET['m'].'.php\','.$row['cod'.substr($_GET['m'],0,3)].',\'#retornos\')" >Excluir</button>
                            </td>';
                            foreach ($linhas as $valores){
                                $cov = substr($valores,2);
                                if($hidden == 1){
                                    $grid .= "<td style='visibility: hidden;'>".$row[$cov]."</td>";
                                    $hidden = 2;
                                }else{
                                    $grid .= "<td>".$row[$cov]."</td>";
                                }
                            }
                $grid .="</tr>";
                    }
                }else{
                    $grid = $array['msg'];
                }           
            "</tbody>
        </table>
    </div>
</div>
";

echo $grid;