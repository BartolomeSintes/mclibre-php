<?php
/**
 * Irregular verbs 2_1 - irregular-verbs-2-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-11-07
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
  <title>Irregular verbs 2 (Formulario).Matrices (2).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-soluciones.css" title="Color" />
</head>

<body>
  <h1>Irregular verbs 2 (Formulario)</h1>

  <form action="irregular-verbs-2-2.php" method="get">

<?php
include "irregular-verbs-list.php";

$numeroVerbos = count($irregularVerbs);

$formaVerbalNombre = ["infinitivo", "pasado", "participio"];

$formaVerbal = rand(0, 2);
$verbo       = rand(0, $numeroVerbos - 1);

print "    <p>¿Cuál es el <strong>$formaVerbalNombre[$formaVerbal]</strong> de <strong>{$irregularVerbs[$verbo][3]}</strong>? ";

print "<input type=\"text\" name=\"respuesta\" size=\"20\" /></p>\n";
print "\n";

print "    <p>\n";
print "      <input type=\"hidden\" name=\"verbo\" value=\"$verbo\" />\n";
print "      <input type=\"hidden\" name=\"formaVerbal\" value=\"$formaVerbal\" />\n";
print "    </p>\n";
print "\n";
?>
    <p>
      <input type="submit" value="Corregir" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-07">7 de noviembre de 2016</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br />
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
