<?php

require_once 'perfil.php';

$archivo = $_FILES['archivo_subido']['tmp_name'];

$lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$perfiles = [];
$nombre_perfil = '';
$mac_perfil = '';

foreach ($lineas as $num_linea => $linea) {
    if (strpos($linea, '"') !== false) {
        $nombre_perfil = substr(trim($linea), 5);
    }
    if (strpos($linea, ':') !== false) {
        $mac_perfil = substr(trim($linea), 8);
        $perfiles[] = new Perfil($nombre_perfil, $mac_perfil);
    }
}

$texto = "config firewall address\n";

foreach ($perfiles as $perfil) {
    $texto .= "edit {$perfil->nombre}\n";
    $texto .= "    set type mac\n";
    $texto .= "    set start-mac {$perfil->mac}\n";
    $texto .= "    set end-mac {$perfil->mac}\n";
    $texto .= "    set color 2\n";
    $texto .= "next\n";
}

$new_file = file_put_contents('mac-resultado.txt', $texto);
