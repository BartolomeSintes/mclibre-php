<?php
/**
 * Minijuegos: Tragaperras (4) - tragaperras-4-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-10-31
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
session_name("tragaperras-4");
session_start();

$simbolosNumero = 8;   // Número de frutas

// Valores iniciales variables sesión
if (!isset($_SESSION["monedas"]) || !isset($_SESSION["fruta1"])
    || !isset($_SESSION["fruta2"]) || !isset($_SESSION["fruta3"])
    || !isset($_SESSION["premio"]) || !isset($_SESSION["cara"])) {
    $_SESSION["monedas"] = 0;
    $_SESSION["fruta1"] = rand(1, $simbolosNumero);
    $_SESSION["fruta2"] = rand(1, $simbolosNumero);
    $_SESSION["fruta3"] = rand(1, $simbolosNumero);
    $_SESSION["premio"] = 0;
    $_SESSION["cara"] = "plain";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Tragaperras (4).
    Minijuegos.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Tragaperras (4)</h1>

<?php
// Se genera el formulario
print "  <form action=\"tragaperras-4-2.php\" method=\"get\">\n";
print "    <table style=\"margin-left: auto; margin-right: auto; border: black 4px solid; border-spacing: 10px;\">\n";
print "      <tbody>\n";
print "        <tr>\n";
// Se muestran las tres imágenes de la combinación actual
print "          <td style=\"border: black 4px solid; padding: 10px\">"
    . "<img src=\"img/frutas/$_SESSION[fruta1].svg\" width=\"160\" alt=\"Imagen\"></td>\n";
print "          <td style=\"border: black 4px solid; padding: 10px\">"
    . "<img src=\"img/frutas/$_SESSION[fruta2].svg\" width=\"160\" alt=\"Imagen\"></td>\n";
print "          <td style=\"border: black 4px solid; padding: 10px\">"
    . "<img src=\"img/frutas/$_SESSION[fruta3].svg\" width=\"160\" alt=\"Imagen\"></td>\n";
print "          <td style=\"vertical-align: top; text-align: center\">\n";
// Se muestra el contador de monedas
print "            <p><button type=\"submit\" name=\"accion\" value=\"moneda\">Meter moneda</button></p>\n";
print "            <p style=\"margin: 0; font-size: 300%; border: black 4px solid; padding: 2px\">$_SESSION[monedas]</p>\n";
// Se muestra el botón de Jugar
print "            <p><button type=\"submit\" name=\"accion\" value=\"jugar\">Jugar</button></p>\n";
if (isset($_SESSION["cara"])) {
    print "            <p style=\"margin: 1px; font-size: 300%; border: black 4px solid; padding: 2px\">";
    print "<img src=\"img/face-$_SESSION[cara].svg\" alt=\"Mal\" height=\"50\">$_SESSION[premio]</p>\n";
}
print "          </td>\n";
print "        </tr>\n";
print "      </tbody>\n";
print "    </table>\n";
print "  </form>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-10-31">31 de octubre de 2018</time>
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
