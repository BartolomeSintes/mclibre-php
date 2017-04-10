<?php
/**
 * Imágenes - imagenes_3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2014 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2014-11-01
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
  <title>Imágenes 3. Imágenes.
  Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre_php_soluciones.css" rel="stylesheet" type="text/css"
  title="Color" />
</head>
<body>

<h1>Pieter Bruegel el viejo</h1>

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
$cuadro             = recoge("cuadro");
$detalle            = recoge("detalle");

// Variables auxiliares
$valorMinimoDetalle = 1;
$valorMaximoDetalle = 5;
$valorMinimoCuadro  = 1;
$valorMaximoCuadro  = 3;

// Validación de datos recibidos

// Si no llega número de cuadro, se mostrará el primero
if ($cuadro == "" || !is_numeric($cuadro) || !ctype_digit($cuadro)) {
    $cuadro = $valorMinimoCuadro;
// Si el número de cuadro es inferior al 1, se mostrará la primera imagen
} elseif ($cuadro < $valorMinimoCuadro) {
    $cuadro = $valorMinimoCuadro;
// Si el número de cuadro es superior a 3, se mostrará la última imagen
} else if($cuadro > $valorMaximoCuadro) {
    $cuadro = $valorMaximoCuadro;
}

// Si no llega número de detalle, se mostrará el primero
if ($detalle == "" || !is_numeric($detalle) || !ctype_digit($detalle)) {
    $detalle = $valorMinimoDetalle;
// Si el número de detalle es inferior al 1, se mostrará la primera imagen
} elseif ($detalle < $valorMinimoDetalle) {
    $detalle = $valorMinimoDetalle;
// Si el número de detalle es superior a 5, se mostrará la última imagen
} else if($detalle > $valorMaximoDetalle) {
    $detalle = $valorMaximoDetalle;
}

// Cuerpo del programa

// Se genera el formulario del cuadro
print "<form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
print "<table style=\"margin-left: auto; margin-right: auto\">\n";
print "  <tbody>\n";
print "    <tr>\n";
// Si no es el primer cuadro, muestra el botón izquierdo; si es el primero la celda está vacía
if ($cuadro > $valorMinimoCuadro) {
    print "      <td><button type=\"submit\" name=\"cuadro\" value=\""
        . ($cuadro - 1)."\"><img src=\"img/arrow-left-b.svg\" "
        . "height=\"80\" alt=\"anterior\" /></button></td>\n";
} else {
    print "      <td width=\"100\"></td>\n";
}
print "      <td><img src=\"img/bruegel/bruegel_$cuadro.jpg\" "
. "alt=\"Cuadro de Pieter Bruegel el viejo\" /></td>\n";
// Si no es el último cuadro, muestra el botón derecho; si es el último la celda está vacía
if ($cuadro < $valorMaximoCuadro) {
    print "      <td><button type=\"submit\" name=\"cuadro\" value=\""
        . ($cuadro + 1)."\"><img src=\"img/arrow-right-b.svg\" height=\"80\" "
        . "alt=\"siguiente\" /></button></td>\n";
} else {
    print "      <td width=\"100\"></td>\n";
}
print "    </tr>\n";
print "  </tbody>\n";
print "</table>\n";
print "</form>\n\n";

// Se genera el formulario del detalle del cuadro
print "<form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
print "<table style=\"margin-left: auto; margin-right: auto\">\n";
print "  <tbody>\n";
print "    <tr>\n";
// Si no es el primer detalle, muestra el botón izquierdo; si es el primero la celda está vacía
if ($detalle > $valorMinimoDetalle) {
    print "      <td><button type=\"submit\" name=\"detalle\" value=\""
        . ($detalle - 1)."\"><img src=\"img/arrow-left-b.svg\" "
        . "height=\"80\" alt=\"anterior\" /></button></td>\n";
} else {
    print "      <td width=\"100\"></td>\n";
}
print "      <td><img src=\"img/bruegel/bruegel_{$cuadro}_$detalle.jpg\" "
. "alt=\"Detalle\" /></td>\n";
// Si no es el último detalle, muestra el botón derecho; si es el último la celda está vacía
if ($detalle < $valorMaximoDetalle) {
    print "      <td><button type=\"submit\" name=\"detalle\" value=\""
        . ($detalle + 1)."\"><img src=\"img/arrow-right-b.svg\" height=\"80\" "
        . "alt=\"siguiente\" /></button></td>\n";
} else {
    print "      <td width=\"100\"></td>\n";
}
print "    </tr>\n";
print "  </tbody>\n";
print "</table>\n";
// El número de cuadro se envía en un control oculto
print "<p><input type=\"hidden\" name=\"cuadro\" value=\"$cuadro\" /></p>\n";
print "</form>\n";

?>

<p class="ultmod">Última modificación de esta página: 1 de noviembre de 2014</p>

<p class="licencia">
Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
<cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
El programa PHP que genera esta página está bajo
<a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o
posterior</a></p>
</body>
</html>
