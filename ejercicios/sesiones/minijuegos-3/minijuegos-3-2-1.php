<?php
/**
 * Minijuegos (3) 2 - minijuegos-3-2-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2023 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2023-02-08
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
session_name("minijuegos-3-2");
session_start();
if (!isset($_SESSION["ax"]) || !isset($_SESSION["bx"]) || !isset($_SESSION["ad"]) || !isset($_SESSION["bd"])) {
    $_SESSION["ax"] = $_SESSION["bx"] = 0;
    $_SESSION["ad"] = $_SESSION["bd"] = 0;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Carrera de puntos.
    Minijuegos (3). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Carrera de puntos</h1>

  <form action="minijuegos-3-2-2.php" method="get">
    <p>Haga clic en los botones para tirar el dado y mover el punto:</p>

<?php
print "    <table>\n";
print "      <tr>\n";
print "        <td><button type=\"submit\" name=\"accion\" value=\"a\" style=\"font-size: 40px; line-height: 40px;\">A</button></td>\n";
print "        <td><img src=\"img/dados/$_SESSION[ad].svg\" alt=\"$_SESSION[ad]\" width=\"50\" height=\"50\"></td>\n ";
print "        <td>\n";
print "          <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n";
print "            width=\"620\" height=\"20\" viewBox=\"-10 0 610 20\">\n";
print "            <line x1=\"0\" y1=\"10\" x2=\"600\" y2=\"10\" stroke=\"gray\" stroke-width=\"5\" />\n";
print "            <circle cx=\"$_SESSION[ax]\" cy=\"10\" r=\"8\" fill=\"red\" />\n";
print "          </svg>\n";
print "        </td>\n";
print "      </tr>\n";
print "      <tr>\n";
print "        <td><button type=\"submit\" name=\"accion\" value=\"b\" style=\"font-size: 40px; line-height: 40px;\">B</button></td>\n";
print "        <td><img src=\"img/dados/$_SESSION[bd].svg\" alt=\"$_SESSION[bd]\" width=\"50\" height=\"50\"></td>\n ";
print "        <td>\n";
print "          <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n";
print "            width=\"620\" height=\"20\" viewBox=\"-10 0 610 20\">\n";
print "            <line x1=\"0\" y1=\"10\" x2=\"600\" y2=\"10\" stroke=\"gray\" stroke-width=\"5\" />\n";
print "            <circle cx=\"$_SESSION[bx]\" cy=\"10\" r=\"8\" fill=\"blue\" />\n";
print "          </svg>\n";
print "        </td>\n";
print "      </tr>\n";
print "    </table>\n";
?>
    <p>
      <button type="submit" name="accion" value="empezar">Volver a empezar</button>
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2023-02-08">8 de febrero de 2023</time>
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
