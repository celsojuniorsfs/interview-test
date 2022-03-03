<?php
/*
Considere o conteúdo do seguinte arquivo rep.txt
0001878553211020190705099999999999
0001878563211020190708088888888888
0001878573211020190709077777777777
0001878583211020190710066666666666
0001878593211020190713055555555555
0001878603211020190714044444444444

Esse arquivo é resultado da extração das batidas de ponto em um relógio digital
Sabendo que:
- Os 9 primeiros digitos formam o ID do Registro
- O 10º digito é um Digito Verificador
- Entre o 11º e 18º digitos temos a Data no formato ddmmaaaa
- Entre o 19º e 22º digitos temos a Hora no formato hhmm
- Entre o 23º e 34º digitos temos o Pis do colaborador

Implemente em PHP (sem frameworks ou libs) um rotina capaz de abrir o arquivo (public/uploads/rep.txt) e armazenar em um array os seguintes dados, ao finalizar use print_r para mostrar os dados do array:
ID do Registro
Digito Verificador
Data
Hora
PIS
*/

$lines = file('rep.txt');
$ponto = array();
$id = "";
$digito = "";
$data = "";
$hora = "";
$pis = "";

foreach ($lines as $line) {
    $id = substr($line, 0, 9);
    $digito = substr($line, 9, 1);
    $dt = new DateTime(substr($line, 10, 2) . "-" . substr($line, 12, 2) . "-" . substr($line, 14, 4));
    $data = $dt->format("d/m/Y");
    $dt = new DateTime(substr($line, 18, 4));
    $hora = $dt->format("H:i");
    $pis = substr($line, 22, 12);

    array_push($ponto, array(
        "id" => $id,
        "digito" => $digito,
        "data" => $data,
        "hora" => $hora,
        "pis" => $pis
    ));
}

print_r($ponto);
