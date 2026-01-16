<?php
/**
 * Sesiones Minijuegos (1) 2 - minijuegos-1-2-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-02-08
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
session_name("minijuegos-1-2");
session_start();

// Si los valores de sesión no existen, ponemos los dos valores de sesión a uno
if (!isset($_SESSION["carta"])) {
    $_SESSION["carta"] = $_SESSION["maximo"] = 1;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    La carta más alta (1).
    Minijuegos (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>La carta más alta (1)</h1>

  <form action="minijuegos-1-2-2.php">
<?php
// Mostramos la carta, guardada en la sesión
print "    <p><img src=\"img/cartas/p$_SESSION[carta].svg\" alt=\"$_SESSION[carta] de picas\" height=\"150\"></p>\n";
print "\n";
// Mostramos el máximo, guardado en la sesión
print "    <p>Carta más alta obtenida: $_SESSION[maximo]</p>\n";
print "\n";
?>
    <p>
      <button type="submit" name="accion" value="nueva">Nueva carta</button>
      <button type="submit" name="accion" value="reiniciar">Reiniciar</button>
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-02-08">8 de febrero de 2025</time>
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
