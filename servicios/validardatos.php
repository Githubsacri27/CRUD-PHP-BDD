<?php

    function validarDatos($nif, $nombre, $apellidos, $direccion, $telefono, $email){
        $errores = '';

        if (empty($nif)) {
            $errores .= "Nif obligatorio<br>";
        }

        if (empty($nombre)) {
            $errores .= "nombre obligatorio<br>";
        }

        if (empty($apellidos)) {
            $errores .= "apellidos obligatorios<br>";
        }

        if (empty($direccion)) {
            $errores .= "dirección obligatoria<br>";
        }
        if (empty($telefono)) {
            $errores .= "teléfono obligatoria<br>";
        }
        if (!empty($email)) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores .= "email no válido<br>";
            }
        }
     

        if (!empty($errores)) {
            throw new Exception($errores);
        }

    }
    ?>