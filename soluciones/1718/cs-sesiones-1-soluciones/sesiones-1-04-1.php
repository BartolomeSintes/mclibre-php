<?php
/**
 * Sesiones (1) 04 - sesiones-1-04-1.php
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
session_name("sesiones-1-04");
session_start();

// Si la posición no está guardada en la sesión, la pone a cero
if (!isset($_SESSION["posicion"])) {
    $_SESSION["posicion"] = 0;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Mover un punto a derecha e izquierda. Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Mover un punto a derecha e izquierda</h1>

  <form action="sesiones-1-04-2.php" method="get">
    <p>Haga clic en los botones para mover el punto:</p>

    <table>
      <tr>
        <th>
          <button type="submit" name="accion" value="izquierda" style="font-size: 60px; line-height: 40px;">&#x261C;</button>
          <button type="submit" name="accion" value="derecha" style="font-size: 60px; line-height: 40px;">&#x261E;</button>
        <th>
      </tr>
      <tr>
        <th>
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
            width="600" height="20" viewbox="-300 0 600 20">
            <line x1="-300" y1="10" x2="300" y2="10" stroke="black" stroke-width="5" />
<?php
// Dibuja el círculo en su posición
print "            <circle cx=\"$_SESSION[posicion]\" cy=\"10\" r=\"8\" fill=\"red\" />\n";
?>
          </svg>
        </th>
      </tr>
    </table>

    <p><input type="submit" name="accion" value="Volver al centro" /></p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-11-09">9 de noviembre de 2017</time></p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>
