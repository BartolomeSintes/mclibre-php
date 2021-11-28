<?php
/**
 * Sesiones (1) 13 - sesiones-1-13-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-11-25
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

// Accedemos a la sesión
session_name("sesiones-1-13");
session_start();

// Si alguna posición no está guardada en la sesión, ponemos los dos valores a cero
if (!isset($_SESSION["x"]) || !isset($_SESSION["y"])) {
    $_SESSION["x"] = $_SESSION["y"] = 0;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Mover un punto en dos dimensiones.
    Sesiones (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Mover un punto en dos dimensiones</h1>

  <form action="sesiones-1-13-2.php" method="get">
    <p>Haga clic en los botones para mover el punto:</p>

    <table>
      <tr>
        <td>
          <table style="float: left">
            <tr>
              <th style="width:70px"></th>
              <th style="width:70px"><button type="submit" name="accion" value="arriba" style="font-size: 60px; line-height: 60px;">&#x1F446;</button></th>
              <th style="width:70px"></th>
            </tr>
            <tr>
              <th><button type="submit" name="accion" value="izquierda" style="font-size: 60px; line-height: 60px;">&#x1F448;</button></th>
              <th><button type="submit" name="accion" value="centro">Volver al<br>centro</button></th>
              <th><button type="submit" name="accion" value="derecha" style="font-size: 60px; line-height: 60px;">&#x1F449;</button></th>
            </tr>
            <tr>
              <th></th>
              <th><button type="submit" name="accion" value="abajo" style="font-size: 60px; line-height: 60px;">&#x1F447;</button></th>
              <th></th>
            </tr>
          </table>
        </td>
        <td>
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
            width="400" height="400" viewbox="-200 -200 400 400" style="border: black 2px solid">
<?php
// Dibujamos el círculo en su posición
print "            <circle cx=\"$_SESSION[x]\" cy=\"$_SESSION[y]\" r=\"8\" fill=\"red\" />\n";
?>
          </svg>
        </td>
      </tr>
    </table>
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
