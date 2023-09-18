<?php 
// Incorporar ficheros externos comunes
require_once('servicios/validaridpersona.php');

try {
    // Validar id de la persona
    $idpersona = $_POST['consulta'] ?? null;
    validarIdPersona($idpersona);

    // Conexión a la base de datos
    require_once('servicios/conexion.php');

    // Confeccionar la sentencia SQL
    $sql = "SELECT * FROM personas WHERE idpersona = :idpersona";

    // Preparar la sentencia SQL
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':idpersona', $idpersona);

    // Ejecutar la sentencia SQL
    $stmt->execute();

    // Comprobar si se ha encontrado alguna fila
    if ($stmt->rowCount() == 0) {
        throw new Exception('La persona no existe');
    }

    // Obtener los resultados de la consulta
    $persona = $stmt->fetch(PDO::FETCH_ASSOC);

    // Extraer las claves asociativas del array para informar las variables del formulario
    extract($persona);

} catch (PDOException $e) {
    throw new Exception($e->errorInfo[2]);
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}
?>
