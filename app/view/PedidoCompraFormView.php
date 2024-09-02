<?php

$attCmpPncCod = '';
$attCmpPncDca = date('Y-m-d');
$attCmpPncDsc = '';
$attCmpPncEtp = '';
$attCmpPncUsr = '';
$attCmpPncObs = '';

if (isset($data_content['DataRow']['CmpPncCod'])) {
    $attCmpPncCod = $data_content['DataRow']['CmpPncCod'];
    $attCmpPncDca = substr($data_content['DataRow']['CmpPncDca'], 0, 10);
    $attCmpPncDsc = $data_content['DataRow']['CmpPncDsc'];
    $attCmpPncEtp = $data_content['DataRow']['CmpPncEtp'];
    $attCmpPncUsr = $data_content['DataRow']['CmpPncUsr'];
    $attCmpPncObs = $data_content['DataRow']['CmpPncObs'];
}

$isDisabled = ($data_content['ActionMode'] == 'modeDisplay' ? 'disabled' : '');

$etapas = $this->getSelectionBasEtp();

$proxima_etapa = $this->getNextStepBasEtp($attCmpPncEtp);

$isDisabledNextStep = '';
if (!$proxima_etapa) {
    $isDisabledNextStep = 'hidden';
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
                <form action="/ShineStock/PedidoCompra/Show/<?= $attCmpPncCod; ?>" method="post">
                    <div class="container-fluid">
                        <h1 class="mt-4">Pedido Necessidade de Compra</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Pedido Necessidade de Compra</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-list mr-1"></i>
                                Detalhes do cadastro
                            </div>
                            <div class="card-body">
                                <div class="table">
                                    <div class="mb-3 row">
                                        <label for="attCmpPncCod" class="col-sm-2 col-form-label">C&oacute;digo</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="attCmpPncCod" name="CmpPncCod" value="<?= $attCmpPncCod; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attCmpPncDca" class="col-sm-2 col-form-label">Cadastro</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="attCmpPncDca" name="CmpPncDca" value="<?= $attCmpPncDca; ?>" <?= $isDisabled ?>>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attCmpPncDsc" class="col-sm-2 col-form-label">Descri&ccedil;&atilde;o</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="attCmpPncDsc" name="CmpPncDsc" value="<?= $attCmpPncDsc; ?>" <?= $isDisabled ?> required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attCmpPncEtp" class="col-sm-2 col-form-label">Etapa</label>
                                        <div class="col-sm-10">
                                            <select class="form-control form-select" aria-label="Default select example" id="attCmpPncEtp" name="CmpPncEtp" value="<?= $attCmpPncEtp; ?>" <?= $isDisabled ?>>
                                                <!-- <option selected>Open this select menu</option> -->
                                                <?php if ($etapas) {
                                                    foreach ($etapas as $etapa_item) {
                                                        $isSelected = ($etapa_item['BasEtpCod'] == $attCmpPncEtp ? 'selected' : '');
                                                        echo '<option ' . $isSelected . ' value="' . $etapa_item['BasEtpCod'] . '">' . $etapa_item['BasEtpGrp'] . ' | ' . $etapa_item['BasEtpDsc'] . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="">NONE</option>';
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attCmpPncUsr" class="col-sm-2 col-form-label">Usu&aacute;rio</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="attCmpPncUsr" name="CmpPncUsr" value="<?= $attCmpPncUsr; ?>" <?= $isDisabled ?> required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attCmpPncObs" class="col-sm-2 col-form-label">Observa&ccedil;&otilde;es</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="attCmpPncObs" name="CmpPncObs" value="<?= $attCmpPncObs; ?>" <?= $isDisabled; ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-block">
                            <a class="btn btn-secondary" type="button" href="/ShineStock/PedidoCompra">Fechar</a>
                            <button class="btn btn-success" type="submit" name="btnConfirm" <?= ($data_content['ActionMode'] == 'modeDisplay' ? 'hidden' : ''); ?>>Confirmar</button>
                            <button class="btn btn-primary" type="submit" name="btnUpdate" <?= ($data_content['ActionMode'] == 'modeDisplay' ? '' : 'hidden'); ?>>Editar</button>
                            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#msgModal" <?= ($data_content['ActionMode'] == 'modeDisplay' ? '' : 'hidden'); ?>>Excluir</button>
                            <a class="btn btn-info" type="button" href="/ShineStock/MateriaPrimaPedidoCompra/Index/<?= $attCmpPncCod ?>" <?= ($data_content['ActionMode'] == 'modeDisplay' ? '' : 'hidden'); ?>>Mat&eacute;ria Prima</a>
                            <button class="btn btn-warning" type="button" name="btnNextStep" data-toggle="modal" data-target="#msgEtapa" <?= ($data_content['ActionMode'] == 'modeDisplay' ? $isDisabledNextStep : 'hidden'); ?>>Avan&ccedil;ar Etapa</button>
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
                    
                    <div id="msgEtapa" class="modal fade" role="dialog">
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
                                                        if ($proxima_etapa) {
                                                            foreach ($proxima_etapa as $proxima_etapa_item) {
                                                                echo '<tr>';
                                                                echo '<td><a type="button" class="btn btn-outline-primary" href="/ShineStock/PedidoCompra/NextStep/' . $attCmpPncCod . '/' . $proxima_etapa_item['BasEtpItmCod'] . '">Aplicar</a></td>';
                                                                echo '<td hidden>' . $proxima_etapa_item['BasEtpItmCod'] . '</td>';
                                                                echo '<td>' . $proxima_etapa_item['BasEtpItmDsc'] . '</td>';
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