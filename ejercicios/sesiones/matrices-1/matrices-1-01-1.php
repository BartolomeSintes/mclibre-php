<?php
/**
 * Sesiones Matrices (1) 1 - matrices-1-01-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-12-04
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
session_name("matrices-1-01");
session_start();

// Si la variable de sesión no está definida ...
if (!isset($_SESSION["nombres"])) {
    // ... creamos la variable de sesión
    $_SESSION["nombres"] = [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Almacenamiento de datos en sesión.
    Matrices (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Almacenamiento de datos en sesión</h1>

  <form action="matrices-1-01-2.php" method="get">
    <p><label>Escriba algún nombre: <input type="text" name="nombre" size="30" maxlength="30"></label></p>

    <p>
      <input type="submit" value="Añadir">
      <input type="reset" value="Borrar">
    </p>

<?php
// Si no hay ningún dato guardado ...
if (!count($_SESSION["nombres"])) {
    // ... lo indicamos
    print "    <p>Todavía no se han introducido nombres.</p>\n";
} else {
    // si lo hay, los mostramos
    print "    <p>Datos introducidos:</p>\n";
    print "    <ul>\n";
    foreach ($_SESSION["nombres"] as $valor) {
        print "      <li>$valor</li>\n";
    }
    print "    </ul>\n";
    print "\n";
    print "    <p><input type=\"submit\" name=\"accion\" value=\"Cerrar sesión\"> "
        . "(se perderán los datos almacenados).</p>\n";
}
?>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2021-12-04">4 de diciembre de 2021</time>
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
