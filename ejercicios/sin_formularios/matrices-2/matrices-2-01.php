<?php
/**
 * Matrices (2) 01 - matrices-2-01.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-10-10
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
  <title>Fichas informativa de animales. Matrices (2).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Fichas informativas de animales</h1>

  <p>Actualice la página para mostrar un nuevo animal.</p>

<?php
$animales = array (
    array("Ballena", "ballena.svg", "https://es.wikipedia.org/wiki/Balaenidae"),
    array("Caballito de mar", "caballito-mar.svg", "https://es.wikipedia.org/wiki/Hippocampus"),
    array("Camello", "camello.svg", "https://es.wikipedia.org/wiki/Camelus"),
    array("Cebra", "cebra.svg", "https://es.wikipedia.org/wiki/Cebra"),
    array("Elefante", "elefante.svg", "https://es.wikipedia.org/wiki/Elephantidae"),
    array("Hipopótamo", "hipopotamo.svg", "https://es.wikipedia.org/wiki/Hippopotamidae"),
    array("Jirafa", "jirafa.svg", "https://es.wikipedia.org/wiki/Giraffa_camelopardalis"),
    array("León", "leon.svg", "https://es.wikipedia.org/wiki/Panthera_leo"),
    array("Leopardo", "leopardo.svg", "https://es.wikipedia.org/wiki/Panthera_pardus"),
    array("Medusa", "medusa.svg", "https://es.wikipedia.org/wiki/Medusa_(animal)"),
    array("Mono", "mono.svg", "https://es.wikipedia.org/wiki/Mono"),
    array("Oso", "oso.svg", "https://es.wikipedia.org/wiki/Ursidae"),
    array("Oso blanco", "oso-blanco.svg","https://es.wikipedia.org/wiki/Ursus_maritimus" ),
    array("Pájaro", "pajaro.svg", "https://es.wikipedia.org/wiki/Aves"),
    array("Pingüino", "pinguino.svg", "https://es.wikipedia.org/wiki/Spheniscidae"),
    array("Rinoceronte", "rinoceronte.svg", "https://es.wikipedia.org/wiki/Rhinocerotidae"),
    array("Serpiente", "serpiente.svg", "https://es.wikipedia.org/wiki/Serpentes"),
    array("Tigre", "tigre.svg", "https://es.wikipedia.org/wiki/Panthera_tigris"),
    array("Tortuga marina", "tortuga-marina.svg", "https://es.wikipedia.org/wiki/Chelonioidea"),
    array("Tortuga", "tortuga.svg", "https://es.wikipedia.org/wiki/Testudines")
);

$animal = rand(0, count($animales) - 1);

print "  <h2>" . $animales[$animal][0] . "</h2>\n";
print "\n";
print "  <p><img src=\"img/animales/" . $animales[$animal][1] . "\" alt=\""
    . $animales[$animal][0] . "\" title=\"" . $animales[$animal][0] . "\" height=\"250\" /></p>\n";

print "\n";
print "  <p>Más <a href=\"" . $animales[$animal][2] . "\">información sobre este animal</a> en la Wikipedia</p>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-10-10">10 de octubre de 2017</time></p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
