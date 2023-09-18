<?php 
    //incorporar ficheros externos comunes
	require_once('servicios/validardatos.php');
    require_once('servicios/validaridpersona.php');
    
    try {
        //validar id del paciente
        validarIdPersona($idpersona);

        //validar datos
        validarDatos($nif, $nombre, $apellidos, $direccion, $telefono, $email, $fechaalta);

        //conexión base de datos
		require_once('servicios/conexion.php');

        //Confeccionar la sentencia SQL
        $sql = "UPDATE personas SET nif = :nif, nombre = :nombre, apellidos = :apellidos, direccion = :direccion, telefono = :telefono, email = :email, fechaalta = :fechaalta WHERE idpersona = $idpersona";

        //preparar la sentencia sql
        $stmt = $conexion->prepare($sql);

        //comprobar si email informado y asignar null en caso contrario
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

        //comprobar si se ha modificado alguna fila
        if ($stmt->rowCount() == 0) {
            throw new Exception('Persona no existe o no se han modificado datos');
        }

        //mensaje de alta efectuada
        $mensajes = "Modificación de persona efectuada";
    } catch (PDOException $e) {
        //comprobar si el código de error corresponde a una clave única duplicada
        if ($e->errorInfo[1] == 1062) {
            //relanzar una excepción para poder capturarla en el fichero principal
            throw new Exception("El nif $nif ya existe en la base de datos");
        }

        throw new Exception($e->errorInfo[2]);
    }
?>
