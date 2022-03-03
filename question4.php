<?php
header('Content-Type: text/html; charset=utf-8');
class Modelo
{

    function calcular($n1, $n2, $oper)
    {
        switch ($oper) {
            case "+":
                return $n1 + $n2;
            case "-":
                return $n1 - $n2;
            case "*":
                return $n1 * $n2;
            case "/":
                if ($n2 == 0) {
                    return 0;
                }
                return $n1 / $n2;
            default:
                return 0;
        }
    }
}
//controller    
//variáveis do lado do servidor
$res = isset($_REQUEST['resultado']) ? $_REQUEST['resultado'] : 0;
$n1 = isset($_REQUEST['n1']) ? $_REQUEST['n1'] : 0;
$operador = isset($_REQUEST['operador']) ? $_REQUEST['operador'] : "";
//Início, substituir o start
if (isset($_REQUEST['clear'])) {
    $res = 0;
    $n1 = 0;
    $operador = "";
}
//Cria o modelo
$model = new Modelo();
//Processa número
if (isset($_REQUEST['numero'])) {
    $res = (int)($res . $_REQUEST['numero']);
}
//processa operador
if (isset($_REQUEST['oper'])) {
    $oper = $_REQUEST['oper'];
    if ($oper != "=") {
        if ($operador == "") {
            $operador = $oper;
            $n1 = $res;
            $res = 0;
        }
    } else {
        if ($operador != "") {
            $n2 = $res;
            $res = $model->calcular($n1, $n2, $operador);
            $operador = "";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<body>
    <!-- view -->
    <h1>Calculadora</h1>

    <form method="POST">
        <!-- variaveis do lado do cliente -->
        <input type="hidden" name="operador" value="<?= $operador ?>">
        <input type="hidden" name="n1" value="<?= $n1 ?>">
        <!-- variaveis do lado do cliente -->
        <table>
            <tr>
                <td colspan="4"><input type="text" readonly="readonly" name="resultado" value="<?= $res ?>"></td>
            </tr>
            <tr>
                <td><button type="submit" name="numero" value="7">7</button></td>
                <td><button type="submit" name="numero" value="8">8</button></td>
                <td><button type="submit" name="numero" value="9">9</button></td>
                <td><button type="submit" name="oper" value="/">/</button></td>
            </tr>
            <tr>
                <td><button type="submit" name="numero" value="4">4</button></td>
                <td><button type="submit" name="numero" value="5">5</button></td>
                <td><button type="submit" name="numero" value="6">6</button></td>
                <td><button type="submit" name="oper" value="*">*</button></td>
            </tr>
            <tr>
                <td><button type="submit" name="numero" value="1">1</button></td>
                <td><button type="submit" name="numero" value="2">2</button></td>
                <td><button type="submit" name="numero" value="3">3</button></td>
                <td><button type="submit" name="oper" value="+">+</button></td>
            </tr>
            <tr>
                <td><button type="submit" name="numero" value="0">0</button></td>
                <td><button type="submit" name="oper" value="=">=</button></td>
                <td><button type="submit" name="oper" value="-">-</button></td>
                <td><button type="submit" name="clear">c</button></td>
            </tr>
        </table>

    </form>

</body>

</html>