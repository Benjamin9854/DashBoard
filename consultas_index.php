<?php
    include("conexion.php");

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





    //VENTAS
    //PREGUNTA 3
    //Obtener las 10 ventas con menor valor al multiplicar CANTIDAD por PRECIO_UNITARIO
    function ventasPregunta3(){
        $conexion=conexion_db();
        $consulta= "SELECT *, Cantidad * Precio_Unitario AS Ganancia FROM ventas ORDER BY Ganancia LIMIT 10";
        $result=mysqli_query($conexion, $consulta);
        return $result;
    }

    //VENTAS
    //PREGUNTA 4
    //Obtener las ventas que tengan una cantidad menor o igual a 10
    function ventasPregunta4(){
        $conexion=conexion_db();
        $consulta= "SELECT * FROM ventas WHERE Cantidad <= 10";
        $result=mysqli_query($conexion, $consulta);
        return $result;
    }

    //VENTAS
    //PREGUNTA 5
    //Obtener el promedio de cantidad de ventas de cada 3 meses hasta 24 meses
    function ventasPregunta5(){
        $conexion=conexion_db();
        $consulta= "SELECT YEAR(Fecha) AS Anio, QUARTER(Fecha) AS Trimestre, ROUND(AVG(Cantidad)) AS Promedio_Ventas FROM ventas WHERE Fecha >= DATE_SUB(CURDATE(), INTERVAL 2 YEAR) GROUP BY YEAR(Fecha), QUARTER(Fecha) ORDER BY Anio DESC, Trimestre DESC";
        $result=mysqli_query($conexion, $consulta);
        return $result;
    }

    //CLIENTES
    //PREGUNTA 1
    //Cuanto clientes son del PAIS China
    function clientesPregunta1(){
        $conexion=conexion_db();
        $consulta= "SELECT * FROM clientes WHERE Pais = 'China'";
        $result=mysqli_query($conexion, $consulta);
        return $result;
    }

    //CLIENTES
    //PREGUNTA 2
    //Desde que pais se compran mas productos
    function clientesPregunta2(){
        $conexion=conexion_db();
        $consulta= "SELECT subquery.Pais, SUM(subquery.Cantidad) AS TotalCantidad FROM ( SELECT ventas.ID_Cliente, clientes.Pais, ventas.Cantidad, ventas.Precio_Unitario FROM ventas INNER JOIN clientes ON ventas.ID_Cliente = clientes.ID_Cliente ) AS subquery GROUP BY subquery.Pais ORDER BY `TotalCantidad` DESC";


        $result=mysqli_query($conexion, $consulta);
        return $result;
    }
?>