<?php
/**
 * Simon (4) - simon-4-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-11-30
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
session_name("simon-4");
session_start();

$colores = ["red", "yellow", "green", "blue"];

// Reinicia cuando falta alguno o cuando fallo es true
if (!isset($_SESSION["longitud"]) || !isset($_SESSION["objetivo"]) || !isset($_SESSION["jugador"]) || !isset($_SESSION["fallo"]) || !isset($_SESSION["completado"]) || $_SESSION["fallo"]) {
    $_SESSION["longitud"] = 3;
    unset($_SESSION["objetivo"]);
    for ($i = 0; $i < $_SESSION["longitud"]; $i++) {
        $_SESSION["objetivo"][] = $colores[array_rand($colores)];
    }
    $_SESSION["jugador"] = [];
    $_SESSION["fallo"] = false;
    $_SESSION["completado"] = false;
    $_SESSION["jugar"] = false;
}

if ($_SESSION["completado"]) {
    $_SESSION["longitud"] += 1;
    unset($_SESSION["objetivo"]);
    for ($i = 0; $i < $_SESSION["longitud"]; $i++) {
        $_SESSION["objetivo"][] = $colores[array_rand($colores)];
    }
    $_SESSION["jugador"] = [];
    $_SESSION["fallo"] = false;
    $_SESSION["completado"] = false;
    $_SESSION["jugar"] = false;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Simon (4).
    Minijuegos (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Simon (4)</h1>

  <?php
    print "    <p>Secuencia a reproducir:</p>\n";
    print "\n";
    print "    <p>\n";
    foreach ($_SESSION["objetivo"] as $color) {
        print "      <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n";
        print "           width=\"50\" height=\"50\" viewBox=\"0 0 50 50\" style=\"background-color: $color\">\n";
        print "      </svg>\n";
    }
    print "    </p>\n";

?>
  <form action="simon-4-2.php" method="get">
    <p>Haga clic para comenzar el juego:</p>

    <p><input type="submit" name="eleccion" value="Comenzar"></p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2021-11-30">30 de noviembre de 2021</time>
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
