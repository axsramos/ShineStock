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
                <div class="container-fluid">
                    <h1 class="mt-4">Mat&eacute;ria Prima</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Mat&eacute;ria Prima</li>
                    </ol>
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
                                            <th>Descri&ccedil;&atilde;o</th>
                                            <th>Bloqueado</th>
                                            <th>Observa&ccedil;&otilde;es</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Item</th>
                                            <th hidden>C&oacute;digo</th>
                                            <th>Descri&ccedil;&atilde;o</th>
                                            <th>Bloqueado</th>
                                            <th>Observa&ccedil;&otilde;es</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        if ($data_content['DataRows']) {
                                            foreach ($data_content['DataRows'] as $data_item) {
                                                echo '<tr>';
                                                echo '<td><a type="button" class="btn btn-outline-primary" href="/ShineStock/MateriaPrima/Show/' . $data_item['CmpMprCod'] . '">Item</a></td>';
                                                echo '<td hidden>' . $data_item['CmpMprCod'] . '</td>';
                                                echo '<td>' . $data_item['CmpMprDsc'] . '</td>';
                                                if ($data_item['CmpMprBlq'] == 'N') {
                                                    echo '<td>Não</td>';
                                                } else {
                                                    echo '<td>Sim</td>';
                                                }
                                                echo '<td>' . $data_item['CmpMprObs'] . '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- add button here -->
                    <div class="mb-4">
                        <a type="button" class="btn btn-primary" href="/ShineStock/MateriaPrima/Show/0">Novo</a>
                    </div>
                </div>
            </main>

            <?php include_once('section/body_footer.php'); ?>

        </div>
    </div>

    <?php include_once('section/body_scripts_src.php'); ?>

</body>

</html>