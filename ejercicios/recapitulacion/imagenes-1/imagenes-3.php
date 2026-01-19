<?php
/**
 * Imágenes - imagenes-3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-02-08
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
    Imágenes 3. Imágenes.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Pieter Bruegel el viejo</h1>

<?php
// Función de recogida de datos
function recoge($key, $type = "")
{
    if (!is_string($key) && !is_int($key) || $key == "") {
        trigger_error("Function recoge(): Argument #1 (\$key) must be a non-empty string or an integer", E_USER_ERROR);
    } elseif ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): Argument #2 (\$type) is optional, but if provided, it must be an empty array or an empty string", E_USER_ERROR);
    }
    $tmp = $type;
    if (isset($_REQUEST[$key])) {
        if (!is_array($_REQUEST[$key]) && !is_array($type)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$key]));
        } elseif (is_array($_REQUEST[$key]) && is_array($type)) {
            $tmp = $_REQUEST[$key];
            array_walk_recursive($tmp, function (&$value) {
                $value = trim(htmlspecialchars($value));
            });
        }
    }
    return $tmp;
}

// Recogida de datos
$cuadro  = recoge("cuadro");
$detalle = recoge("detalle");

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
} elseif ($cuadro > $valorMaximoCuadro) {
    $cuadro = $valorMaximoCuadro;
}

// Si no llega número de detalle, se mostrará el primero
if ($detalle == "" || !is_numeric($detalle) || !ctype_digit($detalle)) {
    $detalle = $valorMinimoDetalle;
// Si el número de detalle es inferior al 1, se mostrará la primera imagen
} elseif ($detalle < $valorMinimoDetalle) {
    $detalle = $valorMinimoDetalle;
// Si el número de detalle es superior a 5, se mostrará la última imagen
} elseif ($detalle > $valorMaximoDetalle) {
    $detalle = $valorMaximoDetalle;
}

// Cuerpo del programa

// Se genera el formulario del cuadro
print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
print "    <table style=\"margin-left: auto; margin-right: auto\">\n";
print "      <tr>\n";
// Si no es el primer cuadro, muestra el botón izquierdo; si es el primero la celda está vacía
if ($cuadro > $valorMinimoCuadro) {
    print "        <td>\n";
    print "          <button type=\"submit\" name=\"cuadro\" value=\"" . $cuadro - 1 . "\">\n";
    print "            <img src=\"img/arrow-left-b.svg\" height=\"80\" alt=\"anterior\">\n";
    print "          </button>\n";
    print "        </td>\n";
} else {
    print "        <td width=\"100\"></td>\n";
}
print "        <td>\n";
print "          <img src=\"img/bruegel/bruegel-$cuadro.jpg\" alt=\"Cuadro de Pieter Bruegel el viejo\">\n";
print "        </td>\n";
// Si no es el último cuadro, muestra el botón derecho; si es el último la celda está vacía
if ($cuadro < $valorMaximoCuadro) {
    print "        <td>\n";
    print "          <button type=\"submit\" name=\"cuadro\" value=\"" . $cuadro + 1 . "\">\n";
    print "            <img src=\"img/arrow-right-b.svg\" height=\"80\" alt=\"siguiente\">\n";
    print "          </button>\n";
    print "        </td>\n";
} else {
    print "        <td width=\"100\"></td>\n";
}
print "      </tr>\n";
print "    </table>\n";
print "  </form>\n";
print "\n";

// Se genera el formulario del detalle del cuadro
print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
print "    <table style=\"margin-left: auto; margin-right: auto\">\n";
print "      <tr>\n";
// Si no es el primer detalle, muestra el botón izquierdo; si es el primero la celda está vacía
if ($detalle > $valorMinimoDetalle) {
    print "        <td>\n";
    print "          <button type=\"submit\" name=\"detalle\" value=\"" . $detalle - 1 . "\">\n";
    print "            <img src=\"img/arrow-left-b.svg\" height=\"80\" alt=\"anterior\">\n";
    print "          </button>\n";
    print "        </td>\n";
} else {
    print "        <td width=\"100\"></td>\n";
}
print "        <td>\n";
print "          <img src=\"img/bruegel/bruegel-{$cuadro}-$detalle.jpg\" alt=\"Detalle\">\n";
print "        </td>\n";
// Si no es el último detalle, muestra el botón derecho; si es el último la celda está vacía
if ($detalle < $valorMaximoDetalle) {
    print "        <td>\n";
    print "          <button type=\"submit\" name=\"detalle\" value=\"" . $detalle + 1 . "\">\n";
    print "             <img src=\"img/arrow-right-b.svg\" height=\"80\" alt=\"siguiente\">\n";
    print "          </button>\n";
    print "        </td>\n";
} else {
    print "        <td width=\"100\"></td>\n";
}
print "      </tr>\n";
print "    </table>\n";
print "\n";
// El número de cuadro se envía en un control oculto
print "    <p><input type=\"hidden\" name=\"cuadro\" value=\"$cuadro\"></p>\n";
print "  </form>\n";
print "\n";
?>
  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-02-08">8 de febrero de 2025</time>
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
