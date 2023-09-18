<?php 

    try {
        //conexión base de datos
		require_once('servicios/conexion.php');

        //Confeccionar la sentencia SQL
        $sql = "SELECT * FROM personas ORDER BY nombre, apellidos";
      

        //preparar la sentencia sql
        $stmt = $conexion->prepare($sql);

        //trasladar la sentencia sql al SGBD
        $stmt->execute();

        //comprobar si se ha modificado alguna fila
        if ($stmt->rowCount() == 0) {
            throw new Exception('Sin datos');
        }

        //especificar que, para las columnas, queremos solo claves asociativas
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        //obtener las filas de la tabla que nos devuelve el SGBD
        $personas = $stmt->fetchAll();

    } catch (PDOException $e) {
        $mensajes = $e->errorInfo[2];
    } catch (Exception $e) {
        $mensajes = $e->getMessage();
    }
    ?>
