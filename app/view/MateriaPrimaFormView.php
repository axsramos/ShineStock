<?php

$attCmpMprCod = '';
$attCmpMprDca = date('Y-m-d');
$attCmpMprDsc = '';
$attCmpMprBlq = '';
$attCmpMprObs = '';

if (isset($data_content['DataRow']['CmpMprCod'])) {
    $attCmpMprCod = $data_content['DataRow']['CmpMprCod'];
    $attCmpMprDca = substr($data_content['DataRow']['CmpMprDca'], 0, 10);
    $attCmpMprDsc = $data_content['DataRow']['CmpMprDsc'];
    $attCmpMprBlq = $data_content['DataRow']['CmpMprBlq'];
    $attCmpMprObs = $data_content['DataRow']['CmpMprObs'];
}

$isDisabled = ($data_content['ActionMode'] == 'modeDisplay' ? 'disabled' : '');

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
                <form action="/ShineStock/MateriaPrima/Show/<?= $attCmpMprCod; ?>" method="post">
                    <div class="container-fluid">
                        <h1 class="mt-4">Mat&eacute;ria Prima</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Mat&eacute;ria Prima</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-list mr-1"></i>
                                Detalhes do cadastro
                            </div>
                            <div class="card-body">
                                <div class="table">
                                    <div class="mb-3 row">
                                        <label for="attCmpMprCod" class="col-sm-2 col-form-label">C&oacute;digo</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="attCmpMprCod" name="CmpMprCod" value="<?= $attCmpMprCod; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attCmpMprDca" class="col-sm-2 col-form-label">Cadastro</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="attCmpMprDca" name="CmpMprDca" value="<?= $attCmpMprDca; ?>" <?= $isDisabled ?>>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attCmpMprDsc" class="col-sm-2 col-form-label">Descri&ccedil;&atilde;o</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="attCmpMprDsc" name="CmpMprDsc" value="<?= $attCmpMprDsc; ?>" <?= $isDisabled ?>>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attCmpMprBlq" class="col-sm-2 col-form-label">Bloqueado</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="attCmpMprBlq" name="CmpMprBlq" <?= $isDisabled ?>>
                                                <option value="N" <?= ($attCmpMprBlq == 'N' ? 'selected' : ''); ?>>N&atilde;o</option>
                                                <option value="S" <?= ($attCmpMprBlq == 'S' ? 'selected' : ''); ?>>Sim</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attCmpMprObs" class="col-sm-2 col-form-label">Grupo</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="attCmpMprObs" name="CmpMprObs" value="<?= $attCmpMprObs; ?>" <?= $isDisabled; ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-block">
                            <a class="btn btn-secondary" type="button" href="/ShineStock/MateriaPrima">Fechar</a>
                            <button class="btn btn-success" type="submit" name="btnConfirm" <?= ($data_content['ActionMode'] == 'modeDisplay' ? 'hidden' : ''); ?>>Confirmar</button>
                            <button class="btn btn-primary" type="submit" name="btnUpdate" <?= ($data_content['ActionMode'] == 'modeDisplay' ? '' : 'hidden'); ?>>Editar</button>
                            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#msgModal" <?= ($data_content['ActionMode'] == 'modeDisplay' ? '' : 'hidden'); ?>>Excluir</button>
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
                </form>
            </main>

            <?php include_once('section/body_footer.php'); ?>

        </div>
    </div>

    <?php include_once('section/body_scripts_src.php'); ?>

</body>

</html>