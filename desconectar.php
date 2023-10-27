<?php
@session_start();
session_destroy();

$pagina = htmlspecialchars($_GET['pag']);

header("Location: $pagina");

?>