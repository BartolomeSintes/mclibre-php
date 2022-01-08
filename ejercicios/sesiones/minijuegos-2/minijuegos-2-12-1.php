<?php
/**
 * Combinación de dados - minijuegos-2-12-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-11-23
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
// Se accede a la sesión
session_name("minijuegos-2-12");
session_start();

if (!isset($_SESSION["nDados"])) {
    $_SESSION["nDados"]   = 1;
    $_SESSION["objetivo"] = rand(3, 4);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Combinación de dados.
    Minijuegos (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>El juego infinito: combinación de dados</h1>

  <form action="minijuegos-2-12-2.php" method="get">

<?php
print "     <p>Objetivo a conseguir: $_SESSION[objetivo]</p>\n";
print "\n";
print "<p>Tirada de dados:</p>\n";
print "\n";
print "     <p>\n";
$total = 0;
for ($i = 0; $i < $_SESSION["nDados"]; $i++) {
    $dado = rand(1, 6);
    $total += $dado;
    print "      <img src=\"img/dados/$dado.svg\" alt=\"$dado\" width=\"90\" height=\"90\">\n";
}
print "    </p\n";
if ($total == $_SESSION["objetivo"]) {
    print "    <p>¡Objetivo conseguido! ¡A por el próximo!</p>\n";
    print "\n";
    print "    <p>\n";
    print "        <input type=\"submit\" name=\"accion\" value=\"Siguiente objetivo\">\n";
    print "        <input type=\"submit\" name=\"accion\" value=\"Reiniciar\">\n";
    print "    </p>\n";
} else {
    print "    <p>¡Inténtalo de nuevo!</p>\n";
    print "\n";
    print "    <p>\n";
    print "        <input type=\"submit\" name=\"accion\" value=\"Volver a lanzar\">\n";
    print "        <input type=\"submit\" name=\"accion\" value=\"Reiniciar\">\n";
    print "    </p>\n";

}
print "\n";
?>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2021-11-23">23 de noviembre de 2021</time>
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
