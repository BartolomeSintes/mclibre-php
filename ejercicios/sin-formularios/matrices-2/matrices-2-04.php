<?php
/**
 * Matrices (2) 04 - matrices-2-04.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-11-26
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
    Diccionario multilingüe.
    Matrices (2). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
<?php
$idiomas = [
    ["español", "spanish", "espagnol", "spagnolo"],
    ["inglés", "engligh", "anglais", "inglese"],
    ["francés", "french", "français", "francese"],
    ["italiano", "italian", "italien", "italiano"]
];

$palabras = [
    ["lunes", "monday", "lundi", "lunedi"],
    ["martes", "tuesday", "mardi", "martedi"],
    ["miércoles", "wednesday", "mercredi", "mercoledì"],
    ["jueves", "thursday", "jeudi", "giovedì"],
    ["viernes", "friday", "vendredi", "venerdì"],
    ["sábado", "saturday", "samedi", "sabato"],
    ["domingo", "sunday", "dimanche", "domenica"],
];

$mensajes = [
    ["diccionario multilingüe", "multilingual dictionary", "Dictionnaire multilingue", "Dizionario multilingue"],
    ["Actualice la página para mostrar una nueva palabra.", "Refresh the page to display a new word.",
        "Rafraîchir la page pour afficher un nouveau mot.", "Aggiornare la pagina per visualizzare una nuova parola."],
    ["quiere decir", "means", "veut dire", "significa"],
    ["en", "in", "en", "in"]
];

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
      <time datetime="2018-11-05">5 de noviembre de 2018</time>
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
