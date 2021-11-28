<?php
/**
 * Sesiones (1) 12 - sesiones-1-12-1.php
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
session_name("sesiones-1-12");
session_start();

// Si la posición no está guardada en la sesión, ponemos el valor a cero
if (!isset($_SESSION["posicion"])) {
    $_SESSION["posicion"] = 0;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Mover un punto a derecha e izquierda.
    Sesiones (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Mover un punto a derecha e izquierda</h1>

  <form action="sesiones-1-12-2.php" method="get">
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
// Dibujamos el círculo en su posición
print "            <circle cx=\"$_SESSION[posicion]\" cy=\"10\" r=\"8\" fill=\"red\" />\n";
?>
          </svg>
        </th>
      </tr>
    </table>

    <p>
      <button type="submit" name="accion" value="centro">Volver al centro</button>
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
