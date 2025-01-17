<?php
/**
 * Su cambio - su-cambio-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-01-09
 * @link      http://www.mclibre.org
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Su cambio.
    Selección (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Su cambio (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$deuda = recoge("deuda");
$b200  = recoge("b200");
$b100  = recoge("b100");

$deudaOk = false;
$b200Ok  = false;
$b100Ok  = false;

if ($deuda == "") {
    print "  <p class=\"aviso\">No ha escrito la cantidad a pagar.</p>\n";
    print "\n";
} elseif (!is_numeric($deuda)) {
    print "  <p class=\"aviso\">No ha escrito la cantidad a pagar como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($deuda)) {
    print "  <p class=\"aviso\">No ha escrito la cantidad a pagar como número entero.</p>\n";
    print "\n";
} elseif ($deuda % 100 != 0) {
    print "  <p class=\"aviso\">La cantidad no es un múltiplo de cien.</p>\n";
    print "\n";
} else {
    $deudaOk = true;
}

if ($b200 == "") {
    print "  <p class=\"aviso\">No ha escrito el número de billetes de doscientos.</p>\n";
    print "\n";
} elseif (!is_numeric($b200)) {
    print "  <p class=\"aviso\">No ha escrito el número de billetes de doscientos como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($b200)) {
    print "  <p class=\"aviso\">No ha escrito el número de billetes de doscientos como número entero.</p>\n";
    print "\n";
} else {
    $b200Ok = true;
}

if ($b100 != 0 && $b100 != 1 && $b100 != 2 && $b100 != 3) {
    print "  <p class=\"aviso\">El número de billetes de cien no es correcto.</p>\n";
    print "\n";
} else {
    $b100Ok = true;
}

if ($deudaOk && $b200Ok && $b100Ok) {
    $pagado = 200 * $b200 + 100 * $b100;
    print "  <p>Tiene que pagar <strong>$deuda €</strong>.</p>\n";
    print "\n";
    print "  <p>Ha entregado <strong>$pagado €</strong>.</p>\n";
    print "\n";

    if ($pagado == $deuda) {
        print "  <p>Ha entregado la cantidad exacta.</p>\n";
        print "\n";
    } elseif ($pagado < $deuda) {
        print "  <p>Le falta entregar <strong>" . ($deuda - $pagado) . " €</strong>.</p>\n";
        print "\n";
    } else {
        $cambio = $pagado - $deuda;
        $c200 = floor($cambio / 200);
        $c100 = $cambio % 200 / 100;
        print "  <p>Tome su cambio: <strong>$cambio €</strong> (<strong>$c200</strong> billetes de 200 € y <strong>$c100</strong> de 100 €).</p>\n";
    }
}
?>

  <p><a href="seleccion-1-1-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-01-09">9 de enero de 2025</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
