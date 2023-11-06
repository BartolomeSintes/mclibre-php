<?php
/**
 * Imágenes - imagenes-5.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2014 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2014-11-01
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
    Selector de colores. Imágenes.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Selector de colores</h1>

<?php
// Funciones auxiliares
// Función de recogida de datos
function recoge($key, $type = "")
{
    if ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): argument #2 (\$type) must be an empty array or an empty string.", E_USER_ERROR);
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
$imagenX     = recoge("imagen_x");
$imagenY     = recoge("imagen_y");

// Variables auxiliares
$valorMinimo = 1;
$valorMaximo = 150;

// Calcula los límites de cada zona de colores
$unidad          = $valorMaximo / 15;

$minimoAzulX     =  1 * $unidad;
$maximoAzulX     =  7 * $unidad;
$minimoAzulY     =  1 * $unidad;
$maximoAzulY     =  7 * $unidad;

$minimoRojoX     =  1 * $unidad;
$maximoRojoX     =  7 * $unidad;
$minimoRojoY     =  8 * $unidad;
$maximoRojoY     = 14 * $unidad;

$minimoVerdeX    =  8 * $unidad;
$maximoVerdeX    = 14 * $unidad;
$minimoVerdeY    =  8 * $unidad;
$maximoVerdeY    = 14 * $unidad;

$minimoAmarilloX =  8 * $unidad;
$maximoAmarilloX = 14 * $unidad;
$minimoAmarilloY =  1 * $unidad;
$maximoAmarilloY =  7 * $unidad;

// Cuerpo del programa

// Si no se reciben ambos datos no se dice nada sobre el color elegido
if ($imagenX == "" && $imagenY == "") {
    print "  <p>Elija un color haciendo clic en él:</p>\n";
    print "\n";
} else {
    // Validación de datos recibidos
    // Si no se reciben valores válidos de coordenadas, se coge la esquina
    if ($imagenX == "" || !is_numeric($imagenX) || !ctype_digit($imagenX)
        || $imagenX < $valorMinimo || $imagenX > $valorMaximo) {
        $imagenX = $valorMinimo;
    }

    if ($imagenY == "" || !is_numeric($imagenY) || !ctype_digit($imagenY)
        || $imagenY < $valorMinimo || $imagenY > $valorMaximo) {
        $imagenY = $valorMinimo;
    }

    // Se comprueba si se ha hecho clic en alguna de las zonas de colores
    if ($imagenX > $minimoAzulX && $imagenX < $maximoAzulX
        && $imagenY > $minimoAzulY && $imagenY < $maximoAzulY) {
        print "  <p>Ha elegido el color <strong>Azul</strong>. Elija de nuevo:</p>\n";
        print "\n";
    } elseif ($imagenX > $minimoRojoX && $imagenX < $maximoRojoX
        && $imagenY > $minimoRojoY && $imagenY < $maximoRojoY) {
        print "  <p>Ha elegido el color <strong>Rojo</strong>. Elija de nuevo:</p>\n";
        print "\n";
    } elseif ($imagenX > $minimoVerdeX && $imagenX < $maximoVerdeX
        && $imagenY > $minimoVerdeY && $imagenY < $maximoVerdeY) {
        print "  <p>Ha elegido el color <strong>Verde</strong>. Elija de nuevo:</p>\n";
        print "\n";
    } elseif ($imagenX > $minimoAmarilloX && $imagenX < $maximoAmarilloX
        && $imagenY > $minimoAmarilloY && $imagenY < $maximoAmarilloY) {
        print "  <p>Ha elegido el color <strong>Amarillo</strong>. Elija de nuevo:</p>\n";
        print "\n";
    } else {
        print "  <p>No ha elegido ningún color. Elija un color haciendo clic en él:</p>\n";
        print "\n";
    }
}

// Se genera el formulario
print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
print "    <p><input type=\"image\" name=\"imagen\" alt=\"Cuatro colores\" "
     . "src=\"img/juegos/cuatro-colores.svg\" height=\"$valorMaximo\"></p>\n";
print "  </form>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2014-11-01">1 de noviembre de 2014</time>
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
