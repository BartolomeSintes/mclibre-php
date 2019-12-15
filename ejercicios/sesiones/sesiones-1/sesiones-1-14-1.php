<?php
/**
 * Sesiones (1) 06 - sesiones-1-14-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-13
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
session_name("sesiones-1-14");
session_start();

// Si algún contador no está guardado en la sesión, los pone a cero
if (!isset($_SESSION["a"]) || !isset($_SESSION["b"])) {
    $_SESSION["a"] = $_SESSION["b"] = 0;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Votar una opción.
    Sesiones (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Votar una opción</h1>

  <form action="sesiones-1-14-2.php" method="get">
    <p>Haga clic en los botones para votar por una opción:</p>

    <table>
      <tr>
        <td style="vertical-align: top;"><button type="submit" name="accion" value="a" style="font-size: 60px; line-height: 50px; color: hsl(200, 100%, 50%);">&#x2714;</button></td>
        <td>
<?php
// Dibuja una barra de votos
print "          <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n";
print "            width=\"$_SESSION[a]\" height=\"50\">\n";
print "            <line x1=\"0\" y1=\"25\" x2=\"$_SESSION[a]\" y2=\"25\" stroke=\"hsl(200, 100%, 50%)\" stroke-width=\"50\" />\n";
print "          </svg>\n";
?>
        </td>
      </tr>
      <tr>
        <td><button type="submit" name="accion" value="b" style="font-size: 60px; line-height: 50px; color: hsl(35, 100%, 50%)">&#x2714;</button></td>
<?php
// Dibuja la otra barra de votos
print "        <td>\n";
print "          <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n";
print "            width=\"$_SESSION[b]\" height=\"50\">\n";
print "            <line x1=\"0\" y1=\"25\" x2=\"$_SESSION[b]\" y2=\"25\" stroke=\"hsl(35, 100%, 50%)\" stroke-width=\"50\" />\n";
print "          </svg>\n";
print "        </td>\n";
?>
      </tr>
    </table>

    <p>
      <button type="submit" name="accion" value="cero">Poner a cero</button>
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-11-13">13 de noviembre de 2018</time>
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
