

<?php
$classe = $_GET['class'];
$metodo = $_GET['acao'];

$classe .= 'Controller';

require_once 'controller/' . $classe . '.php';

$obj = new $classe();
$obj->$metodo();
?>