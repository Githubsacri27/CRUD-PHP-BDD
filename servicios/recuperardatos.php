<?php

$idpersona = isset($_POST['idpersona']) ? addslashes($_POST['idpersona']) : null;
$nif = isset($_POST['nif']) ? addslashes($_POST['nif']) : null;
$nombre = isset($_POST['nombre']) ? addslashes($_POST['nombre']) : null;
$apellidos = isset($_POST['apellidos']) ? addslashes($_POST['apellidos']) : null;
$direccion = isset($_POST['direccion']) ? addslashes($_POST['direccion']) : null;
$telefono = isset($_POST['telefono']) ? addslashes($_POST['telefono']) : null;
$email = isset($_POST['email']) ? addslashes($_POST['email']) : null;
$fechaalta = isset($_POST['fechaalta']) ? addslashes($_POST['fechaalta']) : null;
$peticion = isset($_POST['peticion']) ? addslashes($_POST['peticion']) : null;
