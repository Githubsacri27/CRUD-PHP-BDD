<?php
	//parámetros de conexión a la base de datos
    $parametros = "mysql:host=localhost;dbname=banco;charset=UTF8";

    //conexón a la base de datos
    $conexion = new PDO($parametros, 'root', '');

    //permitir la captura de excepciones 
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
?>