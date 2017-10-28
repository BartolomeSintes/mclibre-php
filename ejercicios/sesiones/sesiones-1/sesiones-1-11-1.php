<?php
/**
 * Sesiones (1) 11 - sesiones-1-11-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-11-17
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

session_name("sesiones_1_11");
session_start();
if (!isset($_SESSION["dados"])) {
    $_SESSION["dados"] = 1;
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Tirada de dados. Sesiones.
      Ejercicios. PHP. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
  </head>

  <body>
    <h1>Tirada de dados</h1>

<?php
print "    <p style=\"font-size: 5rem; line-height: 4rem; margin:0; \">";
for ($i = 1; $i <= $_SESSION["dados"]; $i++) {
    print "&#" . rand(9856, 9861) . "; ";
}
print "</p>\n";

?>
    <form action="sesiones-1-11-2.php" method="get">
      <p>Haga clic en los botones para aumentar o disminuir el número de dados o para volver a tirarlos:</p>

      <p>
        <button type="submit" name="accion" value="bajar" style="font-size: 2rem">-</button>
<?php
print "        <span style=\"font-size: 2rem\">$_SESSION[dados]</span>\n";
?>
        <button type="submit" name="accion" value="subir" style="font-size: 2rem">+</button>
      </p>

      <p><button type="submit" name="accion" value="tirar">Tirar dados</button></p>
    </form>

    <footer>
      <p class="ultmod">
        Última modificación de esta página:
        <time datetime="2016-11-17">17 de noviembre de 2016</time></p>

      <p class="licencia">
        Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
        y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
        Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
    </footer>
  </body>
</html>
