<?php
/**
 * Memorión (4) - memorion-4-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-01
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

// Nos unimos a la sesión
session_name("memorion-4");
session_start();

// Si no está guardado en la sesión el número de dibujos ....
if (!isset($_SESSION["numeroDibujos"])) {
    // ... guardamos el número de dibujos en la sesión
    $_SESSION["numeroDibujos"] = 5;
}

// Si no están guardado en la sesión los dibujos de la partida ....
if (!isset($_SESSION["dibujos"])) {
    // ... creamos una matriz con todos los valores posibles (61 valores)
    $valores = [];
    for ($i = 128000; $i <= 128060; $i++) {
        $valores[] = $i;
    }

    // Los barajamos
    shuffle($valores);

    // Cogemos los N primeros (N es el número de dibujos)
    for ($i = 0; $i < $_SESSION["numeroDibujos"]; $i++) {
        $_SESSION["dibujos"][$i] = $valores[$i];
        // Las fichas estarán boca abajo
        $_SESSION["lado"][$i]   = "dorso";
    }

    // Duplicamos los valores (creamos valores de N a 2N-1)
    for ($i = 0; $i < $_SESSION["numeroDibujos"]; $i++) {
        $_SESSION["dibujos"][$_SESSION["numeroDibujos"] + $i] = $valores[$i];
        $_SESSION["lado"][$_SESSION["numeroDibujos"] + $i]    = "dorso";
    }

    // Los barajamos de nuevo
    shuffle($_SESSION["dibujos"]);

    // No se ha elegido ni la primera ficha ni la segunda de la jugada
    $_SESSION["primera"] = -1;
    $_SESSION["segunda"] = -1;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Memoríón (4).
    Memorión. Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Memorión (4)</h1>

  <form action="memorion-4-2.php">
    <p>
      <button type="submit" name="accion" value="nueva">Nueva partida</button>
      <button type="submit" name="accion" value="numero">Cambiar número de dibujos</button>
    </p>

    <p>
<?php
// Mostramos los dibujos seleccionados en botones
for ($i = 0; $i < 2*$_SESSION["numeroDibujos"]; $i++) {
    // La ficha puede estar boca arriba (se ve el dibujo) ...
    if ($_SESSION["primera"] == $i || $_SESSION["segunda"] == $i) {
        print "      <button type=\"button\" style=\"font-size: 70px; width: 100px; height: 100px;\">&#{$_SESSION["dibujos"][$i]};</button> \n";
    } else { // ... o boca abajo (se ve el dibujo común)
        print "      <button type=\"submit\" name=\"gira\" value=\"$i\" style=\"font-size: 70px; width: 100px; height: 100px; color: black;\">&#10026;</button> \n";
    }
}
?>
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-11-01">1 de noviembre de 2018</time>
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
