<?php
/**
 * Sesiones (1) 3 - index.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2015 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2015-11-15
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

session_name("sesiones_2_03");
session_start();

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Nombre y apellidos (Inicio). Sesiones 3. Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre_php_soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
<h1>Nombre y apellidos (Inicio)</h1>

<?php
if (!isset($_SESSION["nombre"]) and !isset($_SESSION["apellidos"])) {
    print "<p>Usted no ha escrito todavía ni su nombre ni sus apellidos</p>\n";
} elseif (isset($_SESSION["nombre"]) and !isset($_SESSION["apellidos"])) {
    print "<p>Usted sólo ha escrito su nombre: <strong>$_SESSION[nombre]</strong></p>\n";
} elseif (!isset($_SESSION["nombre"]) and isset($_SESSION["apellidos"])) {
    print "<p>Usted sólo ha escrito sus apellidos: <strong>$_SESSION[apellidos]</strong></p>\n";
} else {
    print "<p>Usted ha escrito su nombre: <strong>$_SESSION[nombre]</strong></p>\n\n";
    print "<p>Usted ha escrito sus apellidos: <strong>$_SESSION[apellidos]</strong></p>\n";
}

?>

<p>Elija una opción:</p>

<ul>
  <li><a href="nombre_1.php">Escribir su nombre</a></li>
  <li><a href="apellidos_1.php">Escribir sus apellidos</a></li>
  <li><a href="cerrar.php">Borrar la información</a></li>
</ul>

<footer>
  <p class="ultmod">
    Última modificación de esta página:
    <time datetime="2015-11-15">15 de noviembre de 2015</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
    </footer>
  </body>
</html>
