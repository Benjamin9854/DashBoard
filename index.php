<?php
    include("consultas_index.php");
    $ganancia_mensual = GananciaMesActual();
    $ganancia_anual = GananciasAnnoActual();
    $pais_mayor_ventas = PaisMayorVentas();
    $producto_mas_vendido = ProductoMasVendido();
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard Pablo y Benjamin</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- ENVOLTORIO PRINCIPAL -->
    <div id="wrapper">

        <!-- MENU LATERAL -->
        <!-- MENU LATERAL -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- CARGO DEL USUARIO -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Administrador</div>
            </a>
            <hr class="sidebar-divider my-0">

            <!-- PAGINA PRINCIPAL -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- VER TABLAS -->
            <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tablas</span></a>
            </li>

            <hr class="sidebar-divider">

            <!-- BOTON PARA ESCONDER MENU -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>





        <!-- CONTENIDO DE LA PAGINA -->
        <!-- CONTENIDO DE LA PAGINA -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- BARRA SUPERIO DE NAVEGACION -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    
                </nav>



                <!-- CUERPO DE LA PAGINA -->
                <div class="container-fluid">

                    <!-- ENCABEZADO -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- CARD PRINCIPALES -->
                    <div class="row">

                        <!-- GANANCIAS DEL MES -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ganancias del mes</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                $
                                                <?php while($fila = mysqli_fetch_array($ganancia_mensual))
                                                {
                                                    ?>
                                                    <?php echo number_format($fila['Ganancia_Mes_Actual']);?>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- GANANCIAS DEL AÑO -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> Ganancias del año</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                $
                                                <?php while($fila = mysqli_fetch_array($ganancia_anual))
                                                {
                                                    ?>
                                                    <?php echo number_format($fila['Ganancia_Anno_Actual']);?>
                                                    <?php
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

                        <!-- PAIS CON MAS VENTAS -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pais con mas ventas</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php 
                                                        if ($fila = mysqli_fetch_array($pais_mayor_ventas)) {
                                                            echo $fila['Pais'];
                                                            $ventas = $fila['TotalCantidad'];
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <?php 
                                                        echo $ventas;
                                                    ?>
                                                     ventas
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Producto mas vendido -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Producto mas vendido</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    if ($fila = mysqli_fetch_array($producto_mas_vendido)) {
                                                        echo $fila['Nombre'];
                                                    }
                                                    ?>
                                                </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- PRIMERA FILA -->
                    <!-- PRIMERA FILA -->
                    <div class="row">

                        <!-- GRAFICO -->
                        <?php
                            $ganancias_doce_meses = CrearStringDeGanancias();
                        ?>
                        <input type="hidden" name="GananciasMeses" id="GananciasMeses" value="<?php echo $ganancias_doce_meses;?>">
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- ENCABEZADO GRAFICO -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Ganancias mensuales</h6>
                                </div>

                                <!-- CONTENIDO GRAFICO -->
                                <div class="card-body border-left-primary border-bottom-primary">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- GRAFICO CIRCULAR -->
                        <?php
                            $productos_nombre = NombreProductoMasVendidos();
                            $productos_nombre_string = StringNombreProductoMasVendidos($productos_nombre);
                            $productos_cantidad = CantidadProductoMasVendidos();
                        ?>
                        <input type="hidden" name="ProductosNombre" id="ProductosNombre" value="<?php echo $productos_nombre_string;?>">
                        <input type="hidden" name="ProductosCantidad" id="ProductosCantidad" value="<?php echo $productos_cantidad;?>">
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- ENCABEZADO GRAFICO CIRCULAR -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-warning">5 Productos mas vendidos</h6>
                                </div>

                                <!-- CONTENIDO GRAFICO CIRCULAR -->
                                <div class="card-body border-left-warning border-bottom-warning">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <div>
                                            <span class="mr-1">
                                                <i class="fas fa-circle text-primary"></i> <?php echo $productos_nombre[0];?>
                                            </span>
                                            <span class="mr-1">
                                                <i class="fas fa-circle text-success"></i> <?php echo $productos_nombre[1];?>
                                            </span>
                                            <span class="mr-1">
                                                <i class="fas fa-circle text-info"></i> <?php echo $productos_nombre[2];?>
                                            </span>
                                        </div>
                                        <div>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-warning"></i> <?php echo $productos_nombre[3];?>
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-danger"></i> <?php echo $productos_nombre[4];?>
                                            </span>
                                        </div>                                  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- SEGUNDA FILA -->
                    <!-- SEGUNDA FILA -->
                    <div class="row">
                        
                        <!-- GRAFICO -->
                        <?php
                            $ganancias_doce_meses2 = CrearStringDeGanancias();
                        ?>
                        <input type="hidden" name="GananciasMeses2" id="GananciasMeses2" value="<?php echo $ganancias_doce_meses2;?>">
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- ENCABEZADO GRAFICO -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Ganancias mensuales</h6>
                                </div>

                                <!-- CONTENIDO GRAFICO -->
                                <div class="card-body border-left-primary border-bottom-primary">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <!-- Content Column -->
                        <div class="col-lg-4 mb-4">

                            <!-- CARD PARA LOS PAISES MAS DEMANDANTES -->
                            <?php
                                $paises_nombre = NombresPaisesMayorVentas();
                                $paises_cantidad = CantidadPaisesMayorVentas();
                                $paises_cantidad_porcentaje = CantidadesAPorcentajes($paises_cantidad);
                                $total = array_sum($paises_cantidad);
                            ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-info">Paises mas demandantes</h6>
                                </div>
                                <div class="card-body  border-left-info border-bottom-info">
                                    <h4 class="small font-weight-bold"><?php echo $paises_nombre[0];?> <span
                                            class="float-right"><?php echo $paises_cantidad[0];?> ventas</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo round($paises_cantidad_porcentaje[0]);?>%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold"><?php echo $paises_nombre[1];?> <span
                                            class="float-right"><?php echo $paises_cantidad[1];?> ventas</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo round($paises_cantidad_porcentaje[1]);?>%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold"><?php echo $paises_nombre[2];?> <span
                                            class="float-right"><?php echo $paises_cantidad[2];?> ventas</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo round($paises_cantidad_porcentaje[2]);?>%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold"><?php echo $paises_nombre[3];?> <span
                                            class="float-right"><?php echo $paises_cantidad[3];?> ventas</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round($paises_cantidad_porcentaje[3]);?>%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold"><?php echo $paises_nombre[4];?> <span
                                            class="float-right"><?php echo $paises_cantidad[4];?> ventas</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo round($paises_cantidad_porcentaje[4]);?>%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Total<span
                                            class="float-right"><?php echo $total;?> ventas</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-dark" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>