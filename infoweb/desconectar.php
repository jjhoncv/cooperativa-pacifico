<?php
@session_start();
session_destroy();

$pagina = $_GET['pag'];

header("Location: $pagina");

?>