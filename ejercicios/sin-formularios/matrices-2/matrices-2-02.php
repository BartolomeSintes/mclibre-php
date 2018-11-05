<?php
/**
 * Matrices (2) 02 - matrices-2-02.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-05
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
  <title>
    Diccionario multilingüe.
    Matrices (2). Sin formularios.
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Diccionario multilingüe</h1>

  <p>Actualice la página para mostrar una nueva palabra.</p>

<?php
$idiomas = ["español", "inglés", "francés", "italiano"];

$palabras = [
    ["lunes", "monday", "lundi", "lunedi"],
    ["martes", "tuesday", "mardi", "martedi"],
    ["miércoles", "wednesday", "mercredi", "mercoledì"],
    ["jueves", "thursday", "jeudi", "giovedì"],
    ["viernes", "friday", "vendredi", "venerdì"],
    ["sábado", "saturday", "samedi", "sabato"],
    ["domingo", "sunday", "dimanche", "domenica"],
    ["cachimba", "", "", ""]
];

$idioma = rand(1, count($idiomas) - 1);
$palabra = rand(0, count($palabras) - 1);

if ($palabras[$palabra][$idioma] == "") {
    print "  <p>Lo siento, pero no está disponible la traducción de <strong>"
        . "{$palabras[$palabra][0]}</strong> al $idiomas[$idioma].</p>\n";
} else {
    print "  <p><strong style=\"text-transform: capitalize\">{$palabras[$palabra][$idioma]}"
        . "</strong> quiere decir <strong>{$palabras[$palabra][0]}"
        . " </strong> en $idiomas[$idioma].</p>\n";
}
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-11-05">5 de noviembre de 2018</time>
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
