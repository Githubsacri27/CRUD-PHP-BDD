<?php

    function validarIdPersona($id) {
       if (empty($id) || !is_numeric($id) || $id <= 0) {
            throw new Exception("Persona no informada correctamente");
       }
    }
?>