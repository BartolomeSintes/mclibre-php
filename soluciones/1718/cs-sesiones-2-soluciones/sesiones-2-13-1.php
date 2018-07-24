<?php
/**
 * Sesiones (2) 13 - sesiones-2-13-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-11-16
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

session_name("sesiones_2_13");
session_start();

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Almacenamiento de datos en sesión. Sesiones (2) 013. Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Almacenamiento de datos en sesión</h1>

  <form action="sesiones-2-13-2.php" method="get">
    <p>Escriba algún nombre: <input type="text" name="nombre" size="30" maxlength="30" /></p>

    <p>
      <input type="submit" value="Añadir" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

<?php
if (!count($_SESSION)) {
    print "  <p>Todavía no se han introducido nombres.</p>\n";
} else {
    print "  <p>Datos introducidos:</p>\n";
    print "\n";
    sort($_SESSION["nombres"]);
    print "  <ul>\n";
    foreach ($_SESSION["nombres"] as $valor) {
        print "    <li>$valor</li>\n";
    }
    print "  </ul>\n";
    print "\n";
    print "  <p><a href=\"sesiones-2-13-2.php?accion=Cerrar\">Cerrar sesión "
        . "(se perderán los datos almacenados).</a></p>\n";
}
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-11-15">15 de noviembre de 2017</time></p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
