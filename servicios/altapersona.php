<?php 
    //incorporar ficheros externos comunes
	require_once('servicios/validardatos.php');
    
    try {
        //validar datos
        validarDatos($nif, $nombre, $apellidos, $direccion, $telefono, $email, $fechaalta);

        //conexión base de datos
		require_once('servicios/conexion.php');

        //Confeccionar la sentencia SQL
        $sql = "INSERT INTO personas VALUES (NULL, :nif, :nombre, :apellidos, :direccion, :telefono, :email, :fechaalta)";

        //preparar la sentencia sql
        $stmt = $conexion->prepare($sql);

        //comprobar si email y fecha de alta llega informada y asignar null en caso contrario
        if (empty($email)) {
            $email = null;
        }
        if (empty($fechaalta)) {
            $fechaalta = null;
        }

        //bind de los parámetros
        $stmt->bindParam(':nif', $nif);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':fechaalta', $fechaalta);
        
        //trasladar la sentencia sql al SGBD
        $stmt->execute();

        //mensaje de alta efectuada
        $mensajes = "Alta persona efectuada";

        //limpiar los campos del formulario
        $idpersona = $nif = $nombre = $apellidos = $direccion = $telefono = $email = $fechaalta = null;

    } catch (PDOException $e) {
        //print_r($e->errorInfo);
        //comprobar si el código de error corresponde a una clave única duplicada
        if ($e->errorInfo[1] == 1062) {
            //relanzar una excepción para poder capturarla en el fichero principal
            throw new Exception("El nif $nif ya existe en la base de datos");
        }

        throw new Exception($e->errorInfo[2]);
    }
