<?php
require_once('../valida_session/valida_session.php');
require_once('../layout/header.php'); 
require_once('../layout/sidebar.php'); 
require_once ('../Classes/Ordem.class.php');
require_once ('../Classes/Cliente.class.php');
require_once ('../Classes/Terceirizado.class.php');

$objUsu = new Ordem();
$objCli = new Clientes();
$objTer = new Tercerizado();
$tabela = "ordem";
?>

<!-- Main Content -->
<div id="content">
 <?php require_once('../layout/navbar.php');?>

 <!-- Begin Page Content -->
 <div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4" id="cards-notice">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Ordens de Serviço Abertas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                if ($_SESSION['perfil'] == 1) {
                                    $status = 1;
                                    $total = $objUsu->consultaStatusUsuario($status);
                                    $totalValue = $total['0']['total'];
                                    echo '<a href="../ordem_card/ordem_aberta.php" style="color: #e74a3b;">' . $totalValue . '</a>';
                                }
                                if ($_SESSION['perfil'] == 2) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 1;
                                    $total = $objCli->consultaStatusCliente($tabela,$cod_usuario,$status);
                                    $totalValue = $total['0']['total'];
                                    echo '<a href="../ordem_card/ordem_aberta.php" style="color: #e74a3b;">' . $totalValue . '</a>';
                                }
                                if ($_SESSION['perfil'] == 3) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 1;
                                    $total = $objTer->consultaStatusTercerizado($tabela,$cod_usuario,$status);
                                    $totalValue = $total['0']['total'];
                                    echo '<a href="../ordem_card/ordem_aberta.php" style="color: #e74a3b;">' . $totalValue . '</a>';
                                }
                            ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4" id="cards-notice">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Ordens de Serviço em Execussão</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                              <?php
                                if ($_SESSION['perfil'] == 1) {
                                    $status = 2;
                                    $total = $objUsu->consultaStatusUsuario($status);
                                    $totalValue = $total['0']['total'];
                                    echo '<a href="../ordem_card/ordem_execucao.php" style="color: #f6c23e;">' . $totalValue. '</a>';
                                }
                                if ($_SESSION['perfil'] == 2) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 2;
                                    $total = $objCli->consultaStatusCliente($tabela,$cod_usuario,$status);
                                    $totalValue = $total['0']['total'];
                                    echo '<a href="../ordem_card/ordem_execucao.php" style="color: #f6c23e;">' . $totalValue. '</a>';
                                }
                                if ($_SESSION['perfil'] == 3) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 2;
                                    $tabela= "ordem";
                                    $total = $objTer->consultaStatusTercerizado($tabela,$cod_usuario,$status);
                                    $totalValue = $total['0']['total'];
                                    echo '<a href="../ordem_card/ordem_execucao.php" style="color: #f6c23e;">' . $totalValue. '</a>';
                                }
                            ?>  
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4" id="cards-notice">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Ordens de Serviço Concluídas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                if ($_SESSION['perfil'] == 1) {
                                    $status = 3;
                                    $total = $objUsu->consultaStatusUsuario($status);
                                    $totalValue = $total['0']['total'];
                                    echo '<a href="../ordem_card/ordem_comcluidas.php" style="color: #36b9cc;">' . $totalValue . '</a>';
                                }
                                if ($_SESSION['perfil'] == 2) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 3;
                                    $tabela= "ordem";
                                    $total = $objCli->consultaStatusCliente($tabela,$cod_usuario,$status);
                                    $totalValue = $total['0']['total'];
                                    echo '<a href="../ordem_card/ordem_comcluidas.php" style="color: #36b9cc;">' . $totalValue . '</a>';
                                }
                                if ($_SESSION['perfil'] == 3) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 3;
                                    $tabela= "ordem";
                                    $total = $objTer->consultaStatusTercerizado($tabela,$cod_usuario,$status);
                                    $totalValue = $total['0']['total'];
                                    echo '<a href="../ordem_card/ordem_comcluidas.php" style="color: #36b9cc;">' . $totalValue . '</a>';
                                }
                            ?>  
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


</div>
<!-- /.container-fluid -->

</div>


<?php
require_once('../layout/footer.php');
?>