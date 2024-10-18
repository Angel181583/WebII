<?php
$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    die('Error al conectar: ' . mysqli_connect_error());
}
$db_selected = mysqli_select_db($link, 'criminalnexus');
if (!$db_selected) {
    die('No se puede conectar: ' . mysqli_error($link));
} 

// Retornar el enlace de conexión para que se use en otros archivos
return $link;
