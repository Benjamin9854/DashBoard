<?php
    include("conexion.php");

    //PARA LOS CARDS
    //Obtener las ganancias del mes actual
    function GananciaMesActual(){
        $conexion=conexion_db();
        $consulta= "SELECT SUM(Precio_Unitario * Cantidad) AS Ganancia_Mes_Actual FROM ventas WHERE Fecha > '2024-04-30' AND Fecha < '2024-06-01'";
        $result=mysqli_query($conexion, $consulta);
        return $result;
    }

    //Obtener las ganacias del año actual
    function GananciasAnnoActual(){
        $conexion=conexion_db();
        $consulta= "SELECT SUM(Precio_Unitario * Cantidad) AS Ganancia_Anno_Actual FROM ventas WHERE Fecha > '2023-12-31' AND Fecha < '2025-01-01'";
        $result=mysqli_query($conexion, $consulta);
        return $result;
    }

    //Pais con mas ventas
    function PaisMayorVentas(){
        $conexion=conexion_db();
        $consulta= "SELECT subquery.Pais, SUM(subquery.Cantidad) AS TotalCantidad FROM ( SELECT ventas.ID_Cliente, clientes.Pais, ventas.Cantidad, ventas.Precio_Unitario FROM ventas INNER JOIN clientes ON ventas.ID_Cliente = clientes.ID_Cliente ) AS subquery GROUP BY subquery.Pais ORDER BY `TotalCantidad` DESC";
        $result=mysqli_query($conexion, $consulta);
        return $result;
    }

    //Producto mas vendido
    function ProductoMasVendido(){
        $conexion=conexion_db();
        $consulta= "SELECT subquery.Nombre, SUM(subquery.Cantidad) AS TotalCantidad FROM ( SELECT ventas.ID_producto, productos.Nombre, ventas.Cantidad, ventas.Precio_Unitario FROM ventas INNER JOIN productos ON ventas.ID_producto = productos.ID_Producto ) AS subquery GROUP BY subquery.Nombre ORDER BY `TotalCantidad` DESC";
        $result=mysqli_query($conexion, $consulta);
        return $result;
    }




    //PARA EL PRIMER GRAFICO
    //Obtener las ganancias de los ultimos 12 meses
    function GananciasDoceMeses(){
        $conexion=conexion_db();
        $consulta= "SELECT DATE_FORMAT(Fecha, '%Y-%m') AS Mes, SUM(Precio_Unitario * Cantidad) AS Ganancia FROM ventas WHERE Fecha >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) GROUP BY DATE_FORMAT(Fecha, '%Y-%m') ORDER BY Mes DESC";
        $result=mysqli_query($conexion, $consulta);
        $ganancias = [];
        while ($fila = $result->fetch_assoc()) {
            $ganancias[] = $fila['Ganancia'];
        }
        return $ganancias;
    }

    // Función para crear una cadena de texto con todas las ganancias separadas por una coma
    function CrearStringDeGanancias() {
        $ganancias = GananciasDoceMeses();
        $ganancias_string = implode(",", $ganancias);
        return $ganancias_string;
    }


    

    //PARA EL GRAFICO CIRCULAR
    // Obtener los nombre de los 5 productos más vendido
    function NombreProductoMasVendidos(){
        $conexion = conexion_db();
        $consulta = "SELECT subquery.Nombre, SUM(subquery.Cantidad) AS TotalCantidad 
                    FROM (
                        SELECT ventas.ID_producto, productos.Nombre, ventas.Cantidad, ventas.Precio_Unitario 
                        FROM ventas 
                        INNER JOIN productos ON ventas.ID_producto = productos.ID_Producto 
                    ) AS subquery 
                    GROUP BY subquery.Nombre 
                    ORDER BY TotalCantidad DESC 
                    LIMIT 5";
        $result = mysqli_query($conexion, $consulta);
        $productos = [];
        while ($fila = $result->fetch_assoc()) {
            $productos[] = $fila['Nombre'];
        }
        return $productos;
    }

    function StringNombreProductoMasVendidos($productos){
        $productos_string = implode(",", $productos);
        return $productos_string;
    }

    // Obtener la cantidad de los 5 producto más vendido
    function CantidadProductoMasVendidos(){
        $conexion = conexion_db();
        $consulta = "SELECT subquery.Nombre, SUM(subquery.Cantidad) AS TotalCantidad 
                    FROM (
                        SELECT ventas.ID_producto, productos.Nombre, ventas.Cantidad, ventas.Precio_Unitario 
                        FROM ventas 
                        INNER JOIN productos ON ventas.ID_producto = productos.ID_Producto 
                    ) AS subquery 
                    GROUP BY subquery.Nombre 
                    ORDER BY TotalCantidad DESC 
                    LIMIT 5";
        $result = mysqli_query($conexion, $consulta);
        $productos = [];
        while ($fila = $result->fetch_assoc()) {
            $productos[] = $fila['TotalCantidad'];
        }
        $productos_string = implode(",", $productos);
        return $productos_string;
    }


    

    //PARA EL CARD DE LOS PAISES MAS DEMANDANTES
    //Obtener el nombre de los 5 paises con mas ventas
    function NombresPaisesMayorVentas(){
        $conexion=conexion_db();
        $consulta= "SELECT subquery.Pais, SUM(subquery.Cantidad) AS TotalCantidad FROM ( SELECT ventas.ID_Cliente, clientes.Pais, ventas.Cantidad, ventas.Precio_Unitario FROM ventas INNER JOIN clientes ON ventas.ID_Cliente = clientes.ID_Cliente ) AS subquery GROUP BY subquery.Pais ORDER BY `TotalCantidad` DESC LIMIT 5";
        $result=mysqli_query($conexion, $consulta);
        $nombres = [];
        while ($fila = $result->fetch_assoc()) {
            $nombres[] = $fila['Pais'];
        }
        return $nombres;
    }

    function StringNombrePaisesMasVentas($nombres){
        $nombres_string = implode(",", $nombres);
        return $nombres_string;
    }

    //Obtener la cantidad de ventas de los 5 paises con mas ventas
    function CantidadPaisesMayorVentas(){
        $conexion=conexion_db();
        $consulta= "SELECT subquery.Pais, SUM(subquery.Cantidad) AS TotalCantidad FROM ( SELECT ventas.ID_Cliente, clientes.Pais, ventas.Cantidad, ventas.Precio_Unitario FROM ventas INNER JOIN clientes ON ventas.ID_Cliente = clientes.ID_Cliente ) AS subquery GROUP BY subquery.Pais ORDER BY `TotalCantidad` DESC LIMIT 5";
        $result=mysqli_query($conexion, $consulta);
        $cantidad = [];
        while ($fila = $result->fetch_assoc()) {
            $cantidad[] = $fila['TotalCantidad'];
        }
        return $cantidad;
    }

    function StringCantidadPaisesMasVentas($cantidad){
        $cantidad_string = implode(",", $cantidad);
        return $cantidad_string;
    }

    //Pasar la cantidad de ventas a porcentajes
    function CantidadesAPorcentajes($cantidades){
        $total = array_sum($cantidades);
        $porcentajes = [];
        foreach ($cantidades as $cantidad) {
            $porcentaje = ($cantidad / $total) * 100;
            $porcentajes[] = $porcentaje;
        }
        return $porcentajes;
    }





    //PARA EL SEGUNDO GRAFICOS DE GANANCIAS ANUALES
    function GananciasAnualesDesde2018() {
        $conexion = conexion_db();
        $consulta = "SELECT DATE_FORMAT(Fecha, '%Y') AS Año, SUM(Precio_Unitario * Cantidad) AS Ganancia 
                     FROM ventas 
                     WHERE YEAR(Fecha) >= 2018 
                     GROUP BY DATE_FORMAT(Fecha, '%Y') 
                     ORDER BY Año DESC";
        $result = mysqli_query($conexion, $consulta);
        $ganancias = [];
        while ($fila = $result->fetch_assoc()) {
            $ganancias[] = $fila['Ganancia'];
        }
        return $ganancias;
    }

    function CrearStringDeGananciasAnuales() {
        $ganancias = GananciasAnualesDesde2018();
        $ganancias_string = implode(",", $ganancias);
        return $ganancias_string;
    }    
?>