<?php
    include("conexion.php");

    //VENTAS
    //PREGUNTA 1
    //Obtener las ventas por su año en la FECHA
    function ventasPregunta1(){
        $conexion=conexion_db();
        $consulta= "SELECT * FROM ventas WHERE Fecha > '2019-12-31'";
        $result=mysqli_query($conexion, $consulta);
        return $result;
    }

    //VENTAS
    //PREGUNTA 2
    //Obtener las 50 ventas con mas CANTIDAD
    function ventasPregunta2(){
        $conexion=conexion_db();
        $consulta= "SELECT * FROM ventas ORDER BY Cantidad DESC LIMIT 50";
        $result=mysqli_query($conexion, $consulta);
        return $result;
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