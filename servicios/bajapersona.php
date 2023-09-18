<?php 
    //incorporar ficheros externos comunes
    require_once('servicios/validaridpersona.php');

    try {
        //validar id del paciente
        validarIdPersona($idpersona);

        //conexión base de datos
		require_once('servicios/conexion.php');

        //Confeccionar la sentencia SQL
        $sql = "DELETE FROM personas WHERE idpersona = $idpersona";

        //preparar la sentencia sql
        $stmt = $conexion->prepare($sql);

        //trasladar la sentencia sql al SGBD
        $stmt->execute();

         //comprobar si se ha modificado alguna fila
         if ($stmt->rowCount() == 0) {
            throw new Exception('Persona no existe');
        }

        //mensaje de alta efectuada
        $mensajes = "Baja paciente efectuada";

        //limpiar los campos del formulario
        $idpersona = $nif = $nombre = $apellidos = $direccion = $telefono = $email = $fechaalta = null;

    } catch (PDOException $e) {
        throw new Exception($e->errorInfo[2]);
    }
?>