<?php
/**
 * Matrices (2) 03 - matrices-2-03.php
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
  <meta charset="utf-8" />
  <title>
    Tirada multilingüe.
    Matrices (2). Sin formularios.
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
<?php
$palabras = [
    ["uno", "one", "un", "uno"],
    ["dos", "two", "deux", "due"],
    ["tres", "three", "trois", "tre"],
    ["cuatro", "four", "quatre", "quattro"],
    ["cinco", "five", "cinq", "cinque"],
    ["seis", "six", "six", "sei"]
];

$mensajes = [
    ["Tirada de dado", "Dieroll", "Jet de dé", "Tiro di dado"],
    ["Actualice la página para mostrar una nueva tirada.", "Refresh the page to display a new dieroll.",
        "Rafraîchir la page pour afficher un nouveau jet de dé.", "Aggiornare la pagina per visualizzare un nuovo tiro di dado."],
    ["Ha obtenido un", "You have thrown a", "Vous avez emporté un", "Hai ottenuto un"]
];

$idioma = rand(0, count($palabras[0]) - 1);
$dado = rand(1, 6);

print "  <h1>{$mensajes[0][$idioma]}</h1>\n";
print "\n";
print "  <p>{$mensajes[1][$idioma]}</p>\n";
print "\n";
print "  <p><img src=\"img/$dado.svg\" alt=\"$dado\" title=\"$dado\" width=\"140\" height=\"140\" /></p>\n";
print "\n";
print "  <p>{$mensajes[2][$idioma]} <strong>{$palabras[$dado-1][$idioma]}</strong>.</p>\n";
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
