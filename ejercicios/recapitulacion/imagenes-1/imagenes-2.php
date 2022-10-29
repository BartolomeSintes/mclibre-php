<?php
/**
 * Imágenes - imagenes-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2022 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-10-10
 * @link      https://www.mclibre.org
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
  <title>
    Imágenes 2. Imágenes.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Pieter Bruegel el viejo</h1>

<?php
// Funciones auxiliares
function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = is_array($m) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var]));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor));
        });
    }
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
print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
print "    <table style=\"margin-left: auto; margin-right: auto\">\n";
print "      <tr>\n";
print "        <td><button type=\"submit\" name=\"cuadro\" value=\""
    . $cuadro - 1 . "\"><img src=\"img/arrow-left-b.svg\" "
    . "height=\"80\" alt=\"anterior\"></button></td>\n";
print "        <td><img src=\"img/bruegel/bruegel-$cuadro.jpg\" "
    . "alt=\"Cuadro de Pieter Bruegel el viejo\"></td>\n";
print "        <td><button type=\"submit\" name=\"cuadro\" value=\""
    . $cuadro + 1 . "\"><img src=\"img/arrow-right-b.svg\" height=\"80\" "
    . "alt=\"siguiente\"></button></td>\n";
print "      </tr>\n";
print "    </table>\n";
print "  </form>\n";
print "\n";

// Se genera el formulario del detalle del cuadro
print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
print "    <table style=\"margin-left: auto; margin-right: auto\">\n";
print "      <tr>\n";
print "        <td><button type=\"submit\" name=\"detalle\" value=\""
    . $detalle - 1 . "\"><img src=\"img/arrow-left-b.svg\" "
    . "height=\"80\" alt=\"anterior\"></button></td>\n";
// $cuadro debe ponerse entre llaves (o sacarse de la cadena). Si no se ponen,
// PHP piensa que la variable se llama $cuadro_ y genera un aviso
print "        <td><img src=\"img/bruegel/bruegel-{$cuadro}-$detalle.jpg\" "
    . "alt=\"Detalle\"></td>\n";
print "        <td><button type=\"submit\" name=\"detalle\" value=\""
    . $detalle + 1 . "\"><img src=\"img/arrow-right-b.svg\" height=\"80\" "
    . "alt=\"siguiente\"></button></td>\n";
print "      </tr>\n";
print "    </table>\n";
print "\n";
// El número de cuadro se envía en un control oculto
print "    <p><input type=\"hidden\" name=\"cuadro\" value=\"$cuadro\"></p>\n";
print "  </form>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2022-10-10">10 de octubre de 2022</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="https://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="https://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
