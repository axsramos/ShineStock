<?php

$attCmpFncCod = '';
$attCmpFncDca = date('Y-m-d');
$attCmpFncDsc = '';
$attCmpFncBlq = '';
$attCmpFncObs = '';

if (isset($data_content['DataRow']['CmpFncCod'])) {
    $attCmpFncCod = $data_content['DataRow']['CmpFncCod'];
    $attCmpFncDca = substr($data_content['DataRow']['CmpFncDca'], 0, 10);
    $attCmpFncDsc = $data_content['DataRow']['CmpFncDsc'];
    $attCmpFncBlq = $data_content['DataRow']['CmpFncBlq'];
    $attCmpFncObs = $data_content['DataRow']['CmpFncObs'];
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
                <form action="/ShineStock/Fornecedor/Show/<?= $attCmpFncCod; ?>" method="post">
                    <div class="container-fluid">
                        <h1 class="mt-4">Fornecedor</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Fornecedor</li>
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
                                            <input type="date" class="form-control" id="attCmpFncDca" name="CmpFncDca" value="<?= $attCmpFncDca; ?>" <?= $isDisabled ?>>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attCmpFncDsc" class="col-sm-2 col-form-label">Descri&ccedil;&atilde;o</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="attCmpFncDsc" name="CmpFncDsc" value="<?= $attCmpFncDsc; ?>" <?= $isDisabled ?> required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attCmpFncBlq" class="col-sm-2 col-form-label">Bloqueado</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="attCmpFncBlq" name="CmpFncBlq" <?= $isDisabled ?>>
                                                <option value="N" <?= ($attCmpFncBlq == 'N' ? 'selected' : ''); ?>>N&atilde;o</option>
                                                <option value="S" <?= ($attCmpFncBlq == 'S' ? 'selected' : ''); ?>>Sim</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="attCmpFncObs" class="col-sm-2 col-form-label">Grupo</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="attCmpFncObs" name="CmpFncObs" value="<?= $attCmpFncObs; ?>" <?= $isDisabled; ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-block">
                            <a class="btn btn-secondary" type="button" href="/ShineStock/Fornecedor">Fechar</a>
                            <button class="btn btn-success" type="submit" name="btnConfirm" <?= ($data_content['ActionMode'] == 'modeDisplay' ? 'hidden' : ''); ?>>Confirmar</button>
                            <button class="btn btn-primary" type="submit" name="btnUpdate" <?= ($data_content['ActionMode'] == 'modeDisplay' ? '' : 'hidden'); ?>>Editar</button>
                            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#msgModal" <?= ($data_content['ActionMode'] == 'modeDisplay' ? '' : 'hidden'); ?>>Excluir</button>
                            <a class="btn btn-info" type="button" href="/ShineStock/MateriaPrimaFornecedor/Index/<?=$attCmpFncCod?>" <?= ($data_content['ActionMode'] == 'modeDisplay' ? '' : 'hidden'); ?>>Mat&eacute;ria Prima</a>
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