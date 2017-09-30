<?php
/**
 * Matrices (1) 12 - matrices_1_12.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-10-13
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
    <title>Diccionario multilingüe. Matrices (1)
      Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="mclibre_php_soluciones.css" rel="stylesheet" type="text/css" title="Color" />
  </head>

  <body>
    <h1>Diccionario multilingüe</h1>

    <p>Actualice la página para mostrar una nueva palabra.</p>

<?php
$idiomas = array("español", "inglés", "francés", "italiano");

$palabras = array (
    array("lunes", "monday", "lundi", "lunedi"),
    array("martes", "tuesday", "mardi", "martedi"),
    array("miércoles", "wednesday", "mercredi", "mercoledì"),
    array("jueves", "thursday", "jeudi", "giovedì"),
    array("viernes", "friday", "vendredi", "venerdì"),
    array("sábado", "saturday", "samedi", "sabato"),
    array("domingo", "sunday", "dimanche", "domenica"),
    array("cachimba", "", "", "")
);

$idioma = rand(1, count($idiomas) - 1);
$palabra = rand(0, count($palabras) - 1);

if ($palabras[$palabra][$idioma] == "") {
    print "    <p>Lo siento, pero no está disponible la traducción de <strong>"
        . $palabras[$palabra][0] . "</strong> al $idiomas[$idioma].</p>\n";
} else {
    print "    <p><strong style=\"text-transform: capitalize\">" . $palabras[$palabra][$idioma]
        . "</strong> quiere decir <strong>" . $palabras[$palabra][0]
        . " </strong> en $idiomas[$idioma].</p>\n";
}
?>

    <footer>
      <p class="ultmod">
        Última modificación de esta página:
        <time datetime="2016-10-13">13 de octubre de 2016</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
    </footer>
  </body>
</html>
