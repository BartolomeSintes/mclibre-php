<?php
/**
 * Calculadora de letra del DNI - calculadora-dni-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2014 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2014-11-04
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
  <meta charset="utf-8" />
  <title>Calculadora de letra del DNI (Resultado). Repaso (1).
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-soluciones.css" title="Color" />
</head>

<body>
  <h1>Calculadora de letra del DNI (Resultado)</h1>

<?php
// Funciones auxiliares
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

// Recogida de datos
$dni       = recoge("dni");
$dniOk     = false;

$maximo    = 9999999999;
$letrasDNI = "TRWAGMYFPDXBNJZSQVHLCKE";

// Comprobación de $dni
if ($dni == "") {
    print "  <p class=\"aviso\">No ha escrito el número de DNI.</p>\n";
    print "\n";
} elseif (!is_numeric($dni)) {
    print "  <p class=\"aviso\">No ha escrito el número de DNI como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($dni)) {
    print "  <p class=\"aviso\">No ha escrito el número de DNI como número entero positivo (sin parte decimal)</p>\n";
    print "\n";
} elseif ($dni > $maximo) {
    print "  <p class=\"aviso\">El número de DNI no es inferior o igual a "
         . number_format($maximo, 0, ",", ".") . ".</p>\n";
    print "\n";
} else {
    $dniOk = true;
}

if ($dniOk) {
    print "  <p>El DNI completo es $dni{$letrasDNI[$dni%23]}</p>\n";
    print "\n";
}
?>
  <p><a href="calculadora-dni-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2015-11-18">18 de noviembre de 2015</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br />
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
