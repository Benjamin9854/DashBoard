<?php
    function conexion_db(){
        $hostname="localhost";
        $username="user_topicos_B";
        $password="Bmiranda12.,";
        $database="bd_empresa";
        $conexion = mysqli_connect($hostname, $username, $password, $database);
        if(!$conexion){
            die('Error de conexion: ' . mysqli_connect_error());
        }   
        return $conexion; 
    }
?>