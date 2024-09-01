<?php

$attCmpFncCod = '';
$attCmpFncDca = date('Y-m-d');
$attCmpFncDsc = '';
$attCmpFncBlq = '';
$attCmpFncObs = '';

if (isset($data_content['DataHeader']['CmpFncCod'])) {
    $attCmpFncCod = $data_content['DataHeader']['CmpFncCod'];
    $attCmpFncDca = substr($data_content['DataHeader']['CmpFncDca'], 0, 10);
    $attCmpFncDsc = $data_content['DataHeader']['CmpFncDsc'];
    $attCmpFncBlq = $data_content['DataHeader']['CmpFncBlq'];
    $attCmpFncObs = $data_content['DataHeader']['CmpFncObs'];
}

// $isDisabled = ($data_content['ActionMode'] == 'modeDisplay' ? 'disabled' : '');

$data_content_selection = array();

if ($data_content['DataRowsSelection']) {
    $data_content_selection = array("DataRowsSelection" => $data_content['DataRowsSelection']);
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>

    <?php include_once('section/head_meta_link.php'); ?>

</head>

<body class="sb-nav-fixed">
    <?php include_once('section/body_topnav.php'); ?>

    <div id="layoutSidenav">

        <?php include_once('section/body_sidenav.php'); ?>

        <div id="layoutSidenav_content">
            <main>
                <form action="/ShineStock/MateriaPrimaFornecedor/Show/<?= $attCmpFncCod; ?>" method="post">
                    <div class="container-fluid">
                        <h1 class="mt-4">Mat&eacute;ria Prima Fornecedor</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Itens de Mat&eacute;ria Prima do Fornecedor</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-list mr-1"></i>
                                Detalhes do cadastro
                            </div>
                            <div class="card-body">
                                <div class="table">
                                    <div class="mb-3 row">
                                        <label for="attCmpFncCod" class="col-sm-2 col-form-label">C&oacute;digo</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="attCmpFncCod" name="CmpFncCod" value="<?= $attCmpFncCod; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attCmpFncDca" class="col-sm-2 col-form-label">Cadastro</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="attCmpFncDca" name="CmpFncDca" value="<?= $attCmpFncDca; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attCmpFncDsc" class="col-sm-2 col-form-label">Descri&ccedil;&atilde;o</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="attCmpFncDsc" name="CmpFncDsc" value="<?= $attCmpFncDsc; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attCmpFncBlq" class="col-sm-2 col-form-label">Bloqueado</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="attCmpFncBlq" name="CmpFncBlq" disabled>
                                                <option value="N" <?= ($attCmpFncBlq == 'N' ? 'selected' : ''); ?>>N&atilde;o</option>
                                                <option value="S" <?= ($attCmpFncBlq == 'S' ? 'selected' : ''); ?>>Sim</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attCmpFncObs" class="col-sm-2 col-form-label">Grupo</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="attCmpFncObs" name="CmpFncObs" value="<?= $attCmpFncObs; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Lista
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th hidden>C&oacute;digo</th>
                                                <th>Cadastro</th>
                                                <th>Descri&ccedil;&atilde;o</th>
                                                <th>Bloqueado</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Item</th>
                                                <th hidden>C&oacute;digo</th>
                                                <th>Cadastro</th>
                                                <th>Descri&ccedil;&atilde;o</th>
                                                <th>Bloqueado</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            if ($data_content['DataRows']) {
                                                foreach ($data_content['DataRows'] as $data_item) {
                                                    echo '<tr>';
                                                    echo '<td><a type="button" class="btn btn-outline-danger" href="/ShineStock/MateriaPrimaFornecedor/Remove/' . $attCmpFncCod . '/' . $data_item['CmpMprCod'] . '">Remover</a></td>';
                                                    echo '<td hidden>' . $data_item['CmpMprCod'] . '</td>';
                                                    echo '<td>' . $data_item['CmpMpfDca'] . '</td>';
                                                    echo '<td>' . $data_item['CmpMpfDsc'] . '</td>';
                                                    if ($data_item['CmpMpfBlq'] == 'N') {
                                                        echo '<td>Não</td>';
                                                    } else {
                                                        echo '<td>Sim</td>';
                                                    }
                                                    echo '</tr>';
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-block">
                            <div class="mb-4">
                                <a class="btn btn-secondary" type="button" href="/ShineStock/Fornecedor">Fechar</a>
                                <!-- <a type="button" class="btn btn-primary" href="/ShineStock/MateriaPrimaFornecedor/Show/0">Novo</a> -->
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#msgNovo">Novo</button>
                            </div>
                            <!-- <button class="btn btn-success" type="submit" name="btnConfirm" <?= ($data_content['ActionMode'] == 'modeDisplay' ? 'hidden' : ''); ?>>Confirmar</button> -->
                            <!-- <button class="btn btn-primary" type="submit" name="btnUpdate" <?= ($data_content['ActionMode'] == 'modeDisplay' ? '' : 'hidden'); ?>>Editar</button> -->
                        </div>
                    </div>

                    <!-- Modal -->
                    <div id="msgModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Conteúdo do modal-->
                            <div class="modal-content">

                                <!-- Cabeçalho do modal -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Confirma a opera&ccedil;&atilde;o?</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Corpo do modal -->
                                <div class="modal-body">
                                    <p>Voc&ecirc; tem certeza que deseja realizar esta a&ccedil;&atilde;o?&nbsp; </p>
                                    <p>Confirmar a exclus&atilde;o.</p>
                                </div>

                                <!-- Rodapé do modal-->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger" name="btnDelete">Excluir</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="msgNovo" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Conteúdo do modal-->
                            <div class="modal-content">

                                <!-- Cabeçalho do modal -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Selecione uma op&ccedil;&atilde;o da lista</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Corpo do modal -->
                                <div class="modal-body">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-table mr-1"></i>
                                            Lista de mat&eacute;ria prima
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Item</th>
                                                            <th hidden>C&oacute;digo</th>
                                                            <th>Descri&ccedil;&atilde;o</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Item</th>
                                                            <th hidden>C&oacute;digo</th>
                                                            <th>Descri&ccedil;&atilde;o</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                        <?php
                                                        if ($data_content_selection) {
                                                            foreach ($data_content_selection['DataRowsSelection'] as $data_item_selection) {
                                                                echo '<tr>';
                                                                echo '<td><a type="button" class="btn btn-outline-primary" href="/ShineStock/MateriaPrimaFornecedor/Add/' . $attCmpFncCod . '/' . $data_item_selection['CmpMprCod'] . '">Selecionar</a></td>';
                                                                echo '<td hidden>' . $data_item_selection['CmpMprCod'] . '</td>';
                                                                echo '<td>' . $data_item_selection['CmpMprDsc'] . '</td>';
                                                                echo '</tr>';
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Rodapé do modal-->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </main>

            <?php include_once('section/body_footer.php'); ?>

        </div>
    </div>

    <?php include_once('section/body_scripts_src.php'); ?>

</body>

</html>