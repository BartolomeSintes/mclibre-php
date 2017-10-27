<?php
/**
 * Retrato Robot - retrato_robot.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2015 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2015-10-29
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
  <title>Retato Robot (Formulario). Minijuegos (1).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre_php_soluciones.css" rel="stylesheet" type="text/css" title="Color" />
  <style type="text/css">
    table { border-collapse: collapse; ; margin-left: auto; margin-right: auto; }
    td { padding: 0; }
    img { vertical-align: bottom; }
  </style>
</head>
<body>

<h1>Retrato Robot</h1>

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
$a           = recoge("a");
$b           = recoge("b");
$c           = recoge("c");
$mod         = recoge("mod");

// Variables auxiliares
$valorMinimo = 1;
$valorMaximo = 7;

// Validación de datos recibidos

// Si no se reciben valores válidos de imagen, se coge una imagen al azar
if ($a =="" || !is_numeric($a)  || !ctype_digit($a)
    ||  $a < $valorMinimo || $a > $valorMaximo) {
    $a = rand($valorMinimo, $valorMaximo);
}

if ($b =="" || !is_numeric($b) || !ctype_digit($b)
    || $b < $valorMinimo || $b > $valorMaximo) {
    $b = rand($valorMinimo, $valorMaximo);
}

if ($c =="" || !is_numeric($c) || !ctype_digit($c)
    || $c < $valorMinimo || $c > $valorMaximo) {
    $c = rand($valorMinimo, $valorMaximo);
}

// Si no se reciben un valor válido de imagen a modificar, no se modifica ninguna
if ($mod =="" || !is_numeric($mod) || $mod < $valorMinimo || $mod > $valorMaximo) {
    $mod = 0;
}

// Cuerpo del programa

// Se renueva la imagen solicitada
if ($mod == 1) {
    $a = rand($valorMinimo, $valorMaximo);
} elseif ($mod == 2) {
    $b = rand($valorMinimo, $valorMaximo);
} elseif ($mod == 3) {
    $c = rand($valorMinimo, $valorMaximo);
}

// Se genera el formulario
print "<form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
print "  <table>\n";
print "    <tbody>\n";
print "      <tr>\n";
print "        <td><img src=\"img/retratos/retratos_{$c}_3.jpg\" alt=\"ojos\" /></td>\n";
print "        <td><button type=\"submit\" name=\"mod\" value=\"3\">"
    . "<img src=\"img/refresh.svg\" height=\"60\" alt=\"cambiar\" /></button></td>\n";
print "      </tr>\n";
print "      <tr>\n";
print "        <td><img src=\"img/retratos/retratos_{$b}_2.jpg\" alt=\"nariz\" /></td>\n";
print "        <td><button type=\"submit\" name=\"mod\" value=\"2\">"
    . "<img src=\"img/refresh.svg\" height=\"60\" alt=\"cambiar\" /></button></td>\n";
print "      </tr>\n";
print "      <tr>\n";
print "        <td><img src=\"img/retratos/retratos_{$a}_1.jpg\" alt=\"boca\" /></td>\n";
print "        <td><button type=\"submit\" name=\"mod\" value=\"1\">"
    . "<img src=\"img/refresh.svg\" height=\"60\" alt=\"cambiar\" /></button></td>\n";
print "      </tr>\n";
print "    </tbody>\n";
print "  </table>\n\n";
print "  <p><input type=\"hidden\" name=\"a\" value=\"$a\" />"
    . "<input type=\"hidden\" name=\"b\" value=\"$b\" />"
    . "<input type=\"hidden\" name=\"c\" value=\"$c\" /></p>\n";
print "</form>\n";

?>

<footer>
  <p class="ultmod">
    Última modificación de esta página:
    <time datetime="2015-10-29">29 de octubre de 2015</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
    </footer>
  </body>
</html>
