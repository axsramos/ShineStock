<?php

$attBasEtpCod = '';
$attBasEtpDca = date('Y-m-d');
$attBasEtpDsc = '';
$attBasEtpBlq = '';
$attBasEtpGrp = '';

if (isset($data_content['DataHeader']['BasEtpCod'])) {
    $attBasEtpCod = $data_content['DataHeader']['BasEtpCod'];
    $attBasEtpDca = substr($data_content['DataHeader']['BasEtpDca'], 0, 10);
    $attBasEtpDsc = $data_content['DataHeader']['BasEtpDsc'];
    $attBasEtpBlq = $data_content['DataHeader']['BasEtpBlq'];
    $attBasEtpGrp = $data_content['DataHeader']['BasEtpGrp'];
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
                <form action="/ShineStock/EtapaItem/Show/<?= $attBasEtpCod; ?>" method="post">
                    <div class="container-fluid">
                        <h1 class="mt-4">Itens por Etapa</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Itens por etapa do fluxo do processo</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-list mr-1"></i>
                                Detalhes do cadastro
                            </div>
                            <div class="card-body">
                                <div class="table">
                                    <div class="mb-3 row">
                                        <label for="attBasEtpCod" class="col-sm-2 col-form-label">C&oacute;digo</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="attBasEtpCod" name="BasEtpCod" value="<?= $attBasEtpCod; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attBasEtpDca" class="col-sm-2 col-form-label">Cadastro</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="attBasEtpDca" name="BasEtpDca" value="<?= $attBasEtpDca; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attBasEtpDsc" class="col-sm-2 col-form-label">Descri&ccedil;&atilde;o</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="attBasEtpDsc" name="BasEtpDsc" value="<?= $attBasEtpDsc; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attBasEtpBlq" class="col-sm-2 col-form-label">Bloqueado</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="attBasEtpBlq" name="BasEtpBlq" disabled>
                                                <option value="N" <?= ($attBasEtpBlq == 'N' ? 'selected' : ''); ?>>N&atilde;o</option>
                                                <option value="S" <?= ($attBasEtpBlq == 'S' ? 'selected' : ''); ?>>Sim</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attBasEtpGrp" class="col-sm-2 col-form-label">Grupo</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="attBasEtpGrp" name="BasEtpGrp" value="<?= $attBasEtpGrp; ?>" disabled>
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
                                                    echo '<td><a type="button" class="btn btn-outline-danger" href="/ShineStock/EtapaItem/Remove/' . $attBasEtpCod . '/' . $data_item['BasEtpItmCod'] . '">Remover</a></td>';
                                                    echo '<td hidden>' . $data_item['BasEtpItmCod'] . '</td>';
                                                    echo '<td>' . $data_item['BasEtpItmDca'] . '</td>';
                                                    echo '<td>' . $data_item['BasEtpItmDsc'] . '</td>';
                                                    if ($data_item['BasEtpItmBlq'] == 'N') {
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
                                <a class="btn btn-secondary" type="button" href="/ShineStock/Etapa">Fechar</a>
                                <!-- <a type="button" class="btn btn-primary" href="/ShineStock/Etapa/Show/0">Novo</a> -->
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
                                            Lista de etapas
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
                                                        if ($data_content_selection['DataRowsSelection']) {
                                                            foreach ($data_content_selection['DataRowsSelection'] as $data_item_selection) {
                                                                echo '<tr>';
                                                                echo '<td><a type="button" class="btn btn-outline-primary" href="/ShineStock/EtapaItem/Add/' . $attBasEtpCod . '/' . $data_item_selection['BasEtpCod'] . '">Selecionar</a></td>';
                                                                echo '<td hidden>' . $data_item_selection['BasEtpCod'] . '</td>';
                                                                echo '<td>' . $data_item_selection['BasEtpDsc'] . '</td>';
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