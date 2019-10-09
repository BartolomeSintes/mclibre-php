<?php
/**
 * Imágenes - imagenes-1.php
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
  <meta charset="utf-8">
  <title>
    Imágenes 1. Imágenes.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Pieter Bruegel el viejo. La torre de Babel</h1>

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
$imagen      = recoge("imagen");

// Variables auxiliares
$valorMinimo = 1;
$valorMaximo = 5;

// Validación de datos recibidos

// Si no llega número de imagen, se mostrará la primera
if ($imagen == "" || !is_numeric($imagen) || !ctype_digit($imagen)) {
    $imagen = $valorMinimo;
// Si el número de imagen es inferior al 1, se mostrará la primera imagen
} elseif ($imagen < $valorMinimo) {
    $imagen = $valorMinimo;
// Si el número de imagen es superior a 5, se mostrará la última imagen
} else if($imagen > $valorMaximo) {
    $imagen = $valorMaximo;
}

// Cuerpo del programa

// Se genera el formulario
print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
print "    <table style=\"margin-left: auto; margin-right: auto\">\n";
print "      <tbody>\n";
print "        <tr>\n";
print "          <td><button type=\"submit\" name=\"imagen\" value=\"" . ($imagen - 1). "\">"
     . "<img src=\"img/arrow-left-b.svg\" height=\"80\" alt=\"anterior\"></button></td>\n";
print "          <td><img src=\"img/bruegel/bruegel-1-$imagen.jpg\" alt=\"La torre de Babel, de Pieter Bruegel el viejo\"></td>\n";
print "          <td><button type=\"submit\" name=\"imagen\" value=\"" . ($imagen + 1). "\">"
     . "<img src=\"img/arrow-right-b.svg\" height=\"80\" alt=\"siguiente\"></button></td>\n";
print "        </tr>\n";
print "      </tbody>\n";
print "    </table>\n";
print "  </form>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2014-11-01">1 de noviembre de 2014</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
