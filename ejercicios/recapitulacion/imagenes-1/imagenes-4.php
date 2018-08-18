<?php
/**
 * Imágenes - imagenes-5.php
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Selector de colores. Imágenes.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Selector de colores</h1>

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
     . "src=\"img/juegos/cuatro-colores.svg\" height=\"$valorMaximo\" /></p>\n";
print "  </form>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2014-11-01">1 de noviembre de 2014</time>
    </p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>
