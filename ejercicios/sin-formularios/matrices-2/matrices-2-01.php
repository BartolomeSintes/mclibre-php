<?php
/**
 * Matrices (2) 01 - matrices-2-01.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-12-02
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Fichas informativa de animales.
    Matrices (2). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Fichas informativas de animales</h1>

  <p>Actualice la página para mostrar un nuevo animal.</p>

<?php
$animales = [
    ["Ballena",          "ballena.svg",        "https://es.wikipedia.org/wiki/Balaenidae"],
    ["Caballito de mar", "caballito-mar.svg",  "https://es.wikipedia.org/wiki/Hippocampus"],
    ["Camello",          "camello.svg",        "https://es.wikipedia.org/wiki/Camelus"],
    ["Cebra",            "cebra.svg",          "https://es.wikipedia.org/wiki/Cebra"],
    ["Elefante",         "elefante.svg",       "https://es.wikipedia.org/wiki/Elephantidae"],
    ["Hipopótamo",       "hipopotamo.svg",     "https://es.wikipedia.org/wiki/Hippopotamidae"],
    ["Jirafa",           "jirafa.svg",         "https://es.wikipedia.org/wiki/Giraffa_camelopardalis"],
    ["León",             "leon.svg",           "https://es.wikipedia.org/wiki/Panthera_leo"],
    ["Leopardo",         "leopardo.svg",       "https://es.wikipedia.org/wiki/Panthera_pardus"],
    ["Medusa",           "medusa.svg",         "https://es.wikipedia.org/wiki/Medusa_(animal)"],
    ["Mono",             "mono.svg",           "https://es.wikipedia.org/wiki/Mono"],
    ["Oso",              "oso.svg",            "https://es.wikipedia.org/wiki/Ursidae"],
    ["Oso blanco",       "oso-blanco.svg",     "https://es.wikipedia.org/wiki/Ursus_maritimus"],
    ["Pájaro",           "pajaro.svg",         "https://es.wikipedia.org/wiki/Aves"],
    ["Pingüino",         "pinguino.svg",       "https://es.wikipedia.org/wiki/Spheniscidae"],
    ["Rinoceronte",      "rinoceronte.svg",    "https://es.wikipedia.org/wiki/Rhinocerotidae"],
    ["Serpiente",        "serpiente.svg",      "https://es.wikipedia.org/wiki/Serpentes"],
    ["Tigre",            "tigre.svg",          "https://es.wikipedia.org/wiki/Panthera_tigris"],
    ["Tortuga marina",   "tortuga-marina.svg", "https://es.wikipedia.org/wiki/Chelonioidea"],
    ["Tortuga",          "tortuga.svg",        "https://es.wikipedia.org/wiki/Testudines"],
];

$animal = rand(0, count($animales) - 1);

print "  <h2>{$animales[$animal][0]}</h2>\n";
print "\n";

print "  <p><img src=\"img/animales/{$animales[$animal][1]}\" alt=\"{$animales[$animal][0]}\" height=\"250\"></p>\n";
print "\n";

print "  <p>Más <a href=\"{$animales[$animal][2]}\">información sobre este animal</a> en la Wikipedia</p>\n";
print "\n";
?>
  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-12-02">2 de diciembre de 2025</time>
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
