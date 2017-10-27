<?php
/**
 * Imágenes - imagenes-4.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2014 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2014-10-19
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

print "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Imágenes 4. Imágenes.
  Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css"
  title="Color" />
  <style type="text/css">
    table { border-collapse: collapse; }
    img { vertical-align: bottom; }
  </style>
</head>
<body>

<h1>Retrato Robot</h1>

<?php

function recogeMatriz($var)
{
    $tmpMatriz = array();
    if (isset($_REQUEST[$var]) && is_array($_REQUEST[$var])) {
        foreach ($_REQUEST[$var] as $indice => $valor) {
            $indiceLimpio = trim(htmlspecialchars($indice, ENT_QUOTES, "UTF-8"));
            $valorLimpio  = trim(htmlspecialchars($valor,  ENT_QUOTES, "UTF-8"));
            $tmpMatriz[$indiceLimpio] = $valorLimpio;
        }
    }
    return $tmpMatriz;
}

// Recogida de datos

$mod = recogeMatriz("mod");
$ima = recogeMatriz("ima");
$valorMinimo = 1;
$valorMaximo = 7;

// Validación (si el valor de imagen no es bueno se coge una imagen al azar)

for($i = 1; $i <= 3; $i++) {
    if (!isset($ima[$i]) || !is_numeric($ima[$i]) || $ima[$i] < $valorMinimo
        || $ima[$i] > $valorMaximo) {
        $ima[$i] = rand($valorMinimo, $valorMaximo);
    }
}

for($i = 1; $i <= 3; $i++) {
    if (!isset($mod[$i]) || !is_numeric($mod[$i])
        || ($mod[$i] != 1 && $mod[$i] != -1)) {
        $mod[$i] = 0;
    }
}

// Cambia los valores a mostrar
for($i = 1; $i <= 3; $i++) {
    $ima[$i] += $mod[$i];
    if ($ima[$i] < $valorMinimo) {
        $ima[$i] = $valorMaximo;
    } elseif ($ima[$i] > $valorMaximo) {
        $ima[$i] = $valorMinimo;
    }
}

// Muestra formulario con retrato robot

print "<form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
print "<table cellpadding=\"0\" style=\"margin-left: auto; margin-right: auto\">\n";
print "  <tbody>\n";
print "    <tr>\n";
print "      <td><button type=\"submit\" name=\"mod[3]\" value=\"-1\">"
    . "<img src=\"img/arrow-left-b.svg\" height=\"80\" alt=\"anterior\" /></button></td>\n";
print "      <td><img src=\"img/retratos/retratos_{$ima[3]}_3.jpg\" alt=\"ojos\" /></td>\n";
print "      <td><button type=\"submit\" name=\"mod[3]\" value=\"+1\">"
    . "<img src=\"img/arrow-right-b.svg\" height=\"80\" alt=\"siguiente\" /></button></td>\n";
print "    </tr>\n";
print "    <tr>\n";
print "      <td><button type=\"submit\" name=\"mod[2]\" value=\"-1\">"
    . "<img src=\"img/arrow-left-b.svg\" height=\"80\" alt=\"anterior\" /></button></td>\n";
print "      <td><img src=\"img/retratos/retratos_{$ima[2]}_2.jpg\" alt=\"ojos\" /></td>\n";
print "      <td><button type=\"submit\" name=\"mod[2]\" value=\"+1\">"
    . "<img src=\"img/arrow-right-b.svg\" height=\"80\" alt=\"siguiente\" /></button></td>\n";
print "    </tr>\n";
print "    <tr>\n";
print "      <td><button type=\"submit\" name=\"mod[1]\" value=\"-1\">"
    . "<img src=\"img/arrow-left-b.svg\" height=\"80\" alt=\"anterior\" /></button></td>\n";
print "      <td><img src=\"img/retratos/retratos_{$ima[1]}_1.jpg\" alt=\"ojos\" /></td>\n";
print "      <td><button type=\"submit\" name=\"mod[1]\" value=\"+1\">"
    . "<img src=\"img/arrow-right-b.svg\" height=\"80\" alt=\"siguiente\" /></button></td>\n";
print "    </tr>\n";
print "  </tbody>\n";
print "</table>\n";
print "<p><input type=\"hidden\" name=\"ima[1]\" value=\"$ima[1]\" />"
    . "<input type=\"hidden\" name=\"ima[2]\" value=\"$ima[2]\" />"
    . "<input type=\"hidden\" name=\"ima[3]\" value=\"$ima[3]\" /></p>\n";
print "</form>\n";

?>

<p class="ultmod">Última modificación de esta página: 19 de octubre de 2014</p>

<p class="licencia">
Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
<cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
El programa PHP que genera esta página está bajo
<a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o
posterior</a></p>
</body>
</html>
