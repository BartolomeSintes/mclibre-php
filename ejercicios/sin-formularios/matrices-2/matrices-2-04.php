<?php
/**
 * Matrices (2) 04 - matrices-2-04.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-10-23
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
  <title>Diccionario multilingüe. Matrices (2).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
<?php
$idiomas = array(
    array("español", "spanish", "espagnol", "spagnolo"),
    array("inglés", "engligh", "anglais", "inglese"),
    array("francés", "french", "français", "francese"),
    array("italiano", "italian", "italien", "italiano")
);

$palabras = array (
    array("lunes", "monday", "lundi", "lunedi"),
    array("martes", "tuesday", "mardi", "martedi"),
    array("miércoles", "wednesday", "mercredi", "mercoledì"),
    array("jueves", "thursday", "jeudi", "giovedì"),
    array("viernes", "friday", "vendredi", "venerdì"),
    array("sábado", "saturday", "samedi", "sabato"),
    array("domingo", "sunday", "dimanche", "domenica"),
);

$mensajes = array(
    array("diccionario multilingüe", "multilingual dictionary", "Dictionnaire multilingue", "Dizionario multilingue"),
    array("Actualice la página para mostrar una nueva palabra.", "Refresh the page to display a new word.",
        "Rafraîchir la page pour afficher un nouveau mot.", "Aggiornare la pagina per visualizzare una nuova parola."),
    array("quiere decir", "means", "veut dire", "significa"),
    array("en", "in", "en", "in")
);

$idioma = rand(0, count($idiomas) - 1);
do {
    $idioma2 = rand(0, count($idiomas) - 1);
} while ($idioma2 == $idioma);

$palabra = rand(0, count($palabras) - 1);

print "  <h1>{$mensajes[0][$idioma]}</h1>\n";
print "\n";
print "  <p>{$mensajes[1][$idioma]}</p>\n";
print "\n";

print "  <p><strong style=\"text-transform: capitalize\">{$palabras[$palabra][$idioma2]}"
    . "</strong> {$mensajes[2][$idioma]} <strong>{$palabras[$palabra][$idioma]}"
    . "</strong> {$mensajes[3][$idioma]} {$idiomas[$idioma2][$idioma]}.</p>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-10-230">23 de octubre de 2017</time></p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
