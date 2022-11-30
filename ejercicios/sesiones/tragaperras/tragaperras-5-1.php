<?php
/**
 * Minijuegos: Tragaperras (5) - tragaperras-5-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2022 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-11-30
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
session_name("tragaperras-5");
session_start();

// Valores iniciales variables sesión
if (!isset($_SESSION["monedas"]) || !isset($_SESSION["fruta1"])
    || !isset($_SESSION["fruta2"]) || !isset($_SESSION["fruta3"])
    || !isset($_SESSION["apuesta"])  || !isset($_SESSION["premio"])
    || !isset($_SESSION["cara"])) {
    header("Location:tragaperras-5-2.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Tragaperras (5).
    Minijuegos.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Tragaperras (5)</h1>

<?php
// Se genera el formulario
print "  <form action=\"tragaperras-5-2.php\" method=\"get\">\n";
print "    <table style=\"margin-left: auto; margin-right: auto; border: black 4px solid; border-spacing: 10px;\">\n";
print "      <tr>\n";
// Se muestran las tres imágenes de la combinación actual
print "        <td style=\"border: black 4px solid; padding: 10px\">"
    . "<img src=\"img/frutas/$_SESSION[fruta1].svg\" width=\"160\" alt=\"Imagen\"></td>\n";
print "        <td style=\"border: black 4px solid; padding: 10px\">"
    . "<img src=\"img/frutas/$_SESSION[fruta2].svg\" width=\"160\" alt=\"Imagen\"></td>\n";
print "        <td style=\"border: black 4px solid; padding: 10px\">"
    . "<img src=\"img/frutas/$_SESSION[fruta3].svg\" width=\"160\" alt=\"Imagen\"></td>\n";
print "        <td style=\"vertical-align: top; text-align: center\">\n";
// Se muestra la apuesta
print "          <p><button type=\"submit\" name=\"accion\" value=\"apostar\">Aumentar apuesta</button></p>\n";
print "          <p style=\"margin: 0; font-size: 300%; border: black 4px solid; padding: 2px\">$_SESSION[apuesta]</p>\n";
// Se muestra el botón de Jugar
print "          <p><button type=\"submit\" name=\"accion\" value=\"jugar\">Jugar</button></p>\n";
// Si se ha jugado se muestra cara y resultado, si no cara neutra
print "          <p style=\"margin: 1px; font-size: 300%; border: black 4px solid; padding: 2px\">";
if (isset($_SESSION["cara"])) {
    print "<img src=\"img/face-$_SESSION[cara].svg\" alt=\"Mal\" height=\"50\">";
    print "$_SESSION[premio]</p>\n";
} else {
    print "<img src=\"img/face-plain.svg\" alt=\"Normal\" height=\"50\"></p>\n";
}
print "        </td>\n";
print "        <td style=\"vertical-align: top; text-align: center\">\n";
// Se muestra el contador de monedas
print "          <p><button type=\"submit\" name=\"accion\" value=\"moneda\">Meter moneda</button></p>\n";
print "          <p style=\"margin: 0; font-size: 300%; border: black 4px solid; padding: 2px\">$_SESSION[monedas]</p>\n";
print "        </td>\n";
print "      </tr>\n";
print "    </table>\n";
print "  </form>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2022-11-30">30 de noviembre de 2022</time>
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
