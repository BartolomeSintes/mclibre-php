<?php
/**
 * Matrices (1) 3 - matrices-1-03-b.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-05
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
    Nombres de animales.
    Matrices (1). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Nombres de animales</h1>

  <p>Actualice la página para mostrar un nuevo animal.</p>

<?php
$animales = [
    ["Ballena",          "ballena.svg"],
    ["Caballito de mar", "caballito-mar.svg"],
    ["Camello",          "camello.svg"],
    ["Cebra",            "cebra.svg"],
    ["Elefante",         "elefante.svg"],
    ["Hipopótamo",       "hipopotamo.svg"],
    ["Jirafa",           "jirafa.svg"],
    ["León",             "leon.svg"],
    ["Leopardo",         "leopardo.svg"],
    ["Medusa",           "medusa.svg"],
    ["Mono",             "mono.svg"],
    ["Oso",              "oso.svg"],
    ["Oso blanco",       "oso-blanco.svg"],
    ["Pájaro",           "pajaro.svg"],
    ["Pingüino",         "pinguino.svg"],
    ["Rinoceronte",      "rinoceronte.svg"],
    ["Serpiente",        "serpiente.svg"],
    ["Tigre",            "tigre.svg"],
    ["Tortuga marina",   "tortuga-marina.svg"],
    ["Tortuga",          "tortuga.svg"],
];

$animal = rand(0, count($animales) - 1);

print "  <h2>{$animales[$animal][0]}</h2>\n";
print "\n";
print "  <p><img src=\"img/animales/{$animales[$animal][1]}\" alt=\"{$animales[$animal][0]}\" height=\"250\"></p>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-10-10">10 de octubre de 2019</time>
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
