<?php
/**
 * Sesiones (2) 03 - index.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2026 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2026-01-28
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

session_name("sesiones-2-7");
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Nombre y apellidos (Inicio).
    Sesiones (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Nombre y apellidos (Inicio)</h1>

<?php
if (!isset($_SESSION["nombre"]) && !isset($_SESSION["apellidos"])) {
    print "  <p>Usted no ha escrito todavía ni su nombre ni sus apellidos</p>\n";
    print "\n";
} elseif (isset($_SESSION["nombre"]) && !isset($_SESSION["apellidos"])) {
    print "  <p>Usted sólo ha escrito su nombre: <strong>$_SESSION[nombre]</strong></p>\n";
    print "\n";
} elseif (!isset($_SESSION["nombre"]) && isset($_SESSION["apellidos"])) {
    print "  <p>Usted sólo ha escrito sus apellidos: <strong>$_SESSION[apellidos]</strong></p>\n";
    print "\n";
} else {
    print "  <p>Usted ha escrito su nombre: <strong>$_SESSION[nombre]</strong></p>\n";
    print "\n";
    print "  <p>Usted ha escrito sus apellidos: <strong>$_SESSION[apellidos]</strong></p>\n";
    print "\n";
}
?>
  <p>Elija una opción:</p>
  <ul>
    <li><a href="nombre-1.php">Escribir su nombre</a></li>
    <li><a href="apellidos-1.php">Escribir sus apellidos</a></li>
    <li><a href="cerrar.php">Borrar la información</a></li>
  </ul>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2026-01-28">28 de enero de 2026</time>
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
