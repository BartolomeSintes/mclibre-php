<?php
/**
 * Sesiones (1) 12 - sesiones-1-12-1.php
*
* @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
* @copyright 2017 Bartolomé Sintes Marco
* @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
* @version   2017-11-09
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
// Se accede a la sesión
session_name("sesiones-1-12");
session_start();
if (!isset($_SESSION["ax"]) || !isset($_SESSION["bx"]) || !isset($_SESSION["ad"]) || !isset($_SESSION["bd"])) {
    $_SESSION["ax"] = $_SESSION["bx"] = 0;
    $_SESSION["ad"] = $_SESSION["bd"] = 1;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Carrera de coches (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Carrera de coches (1)</h1>

  <form action="sesiones-1-12-2.php" method="get">
    <p>Haga clic en los botones para tirar el dado y mover el punto:</p>

    <table>
      <tr>
        <td><button type="submit" name="accion" value="a" style="font-size: 40px; line-height: 40px;">A</button></td>
<?php
if (isset($_SESSION["ad"])) {
    print "        <td><span style=\"font-size: 3rem; line-height: 1rem\">&#" . (9855 + $_SESSION["ad"]) . ";</span></td>\n ";
} else {
    print "        <td></td>\n";
}
print "        <td>\n";
print "          <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n";
print "            width=\"620\" height=\"20\" viewbox=\"-10 0 610 20\">\n";
print "            <line x1=\"0\" y1=\"10\" x2=\"600\" y2=\"10\" stroke=\"black\" stroke-width=\"5\" />\n";
print "            <circle cx=\"$_SESSION[ax]\" cy=\"10\" r=\"8\" fill=\"red\" />\n";
print "          </svg>\n";
print "        </td>\n";
?>
      </tr>
      <tr>
        <td><button type="submit" name="accion" value="b" style="font-size: 40px; line-height: 40px;">B</button></td>
<?php
if (isset($_SESSION["bd"])) {
    print "        <td><span style=\"font-size: 3rem; line-height: 1rem\">&#" . (9855 + $_SESSION["bd"]) . ";</span></td>\n ";
} else {
    print "        <td></td>\n";
}
print "        <td>\n";
print "          <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n";
print "            width=\"620\" height=\"20\" viewbox=\"-10 0 610 20\">\n";
print "            <line x1=\"0\" y1=\"10\" x2=\"600\" y2=\"10\" stroke=\"black\" stroke-width=\"5\" />\n";
print "            <circle cx=\"$_SESSION[bx]\" cy=\"10\" r=\"8\" fill=\"red\" />\n";
print "          </svg>\n";
print "        </td>\n";
?>
      </tr>
    </table>

    <p><button type="submit" name="accion" value="empezar">Volver a empezar</button></p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-11-09">9 de noviembre de 2017</time>
    </p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>
