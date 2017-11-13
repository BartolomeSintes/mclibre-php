<?php
/**
 * Memorión (4) - memorion-4-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-11-13
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

session_name("memorion-4");
session_start();

if (!isset($_SESSION["numeroFichas"])) {
    $_SESSION["numeroFichas"] = 10;
}

if (!isset($_SESSION["fichas"])) {
    for ($i = 128000; $i <= 128060; $i++) {
        $valores[] = $i;
    }
    shuffle($valores);
    for ($i = 0; $i < $_SESSION["numeroFichas"]; $i++) {
        $_SESSION["fichas"][$i] = $valores[$i];
    }
    for ($i = 0; $i < $_SESSION["numeroFichas"]; $i++) {
        $_SESSION["fichas"][$_SESSION["numeroFichas"]+$i] = $valores[$i];
    }
    shuffle($_SESSION["fichas"]);
    $_SESSION["muestra1"] = -1;
    $_SESSION["muestra2"] = -1;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Memoríón (3). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
<?php
print "  <h1>$_SESSION[numeroFichas] parejas de fichas distintas</h1>\n";
print "\n";
print "  <form action=\"memorion-4-2.php\">\n";
print "    <p>\n";
print "      <button type=\"submit\" name=\"accion\" value=\"numero\">Cambiar número de fichas</button> \n";
print "      <button type=\"submit\" name=\"accion\" value=\"nuevo\">Cambiar imagenes</button> \n";
print "    </p>\n";
print "\n";
print "  <p>\n";
for ($i = 0; $i < 2*$_SESSION["numeroFichas"]; $i++) {
    if ($_SESSION["muestra1"] == $i || $_SESSION["muestra2"] == $i) {
        print "    <button type=\"submit\" name=\"muestra\" value=\"$i\" style=\"font-size: 400%;\">&#{$_SESSION["fichas"][$i]};</button> \n";
    } else {
        print "    <button type=\"submit\" name=\"muestra\" value=\"$i\" style=\"font-size: 400%;\">&#10026;</button> \n";
    }
}
print "  </p>\n";
print_r($_SESSION);
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-11-13">13 de noviembre de 2017</time></p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
