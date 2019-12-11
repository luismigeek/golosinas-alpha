<?php

session_start();

/**
 * isset — Determina si una variable está definida y no es NULL
 * header — Enviar encabezado sin formato HTTP
 */

if(isset($_SESSION["type"])){

    if ($_SESSION["type"] == 1) {

        // Redirección del navegador
        header("Location: admin/");
    } else {
        header("Location: tienda/");
    }  
    
}else{
    header("Location: tienda/");
}