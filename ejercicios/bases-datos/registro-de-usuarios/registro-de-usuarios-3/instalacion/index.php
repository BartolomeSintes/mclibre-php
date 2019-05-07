<?php
/**
 * Registro de usuarios 3 - instalacion/instalar.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-05-07
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

require_once "../comunes/biblioteca.php";

if (!isset($_REQUEST["si"]) && !isset($_REQUEST["resi"]) && !isset($_REQUEST["fin"]) ) {
    cabecera("Instalación", MENU_INSTALAR, 1);
    print "<form action=\"$_SERVER[PHP_SELF]\" method=\"" . FORM_METHOD . "\">
  <p>Instalación de la aplicación</p>
  <p>Escriba en el archivo <strong>/comunes/config.php</strong>
    el nombre de usuario en MySQL/SQLITE y su contraseña y pulse el botón <strong>Instalar</strong>.</p>
  <p>Se creará el usuario administrador de nombre <strong>root</strong>
    con contraseña <strong>root</strong>.</p>
  <p>Una vez instalada la aplicación, borre la carpeta /instacion.</p>
  <p><button type=\"submit\" value=\"Sí\" name=\"si\">Instalar aplicación</button></p>
</form>\n";
} elseif (isset($_REQUEST["si"])) {
    cabecera("Instalación", MENU_INSTALAR, 1);
    print "<form action=\"$_SERVER[PHP_SELF]\" method=\"" . FORM_METHOD . "\">
  <p>Instalación de la aplicación</p>
  <p>¿Está usted seguro? ¡Se borrará la base de datos anterior!</p>
  <p><button type=\"submit\" value=\"Sí\" name=\"resi\">Sí, Instalar aplicación</button></p>
</form>\n";
} elseif (isset($_REQUEST["resi"])) {
    cabecera("Instalación", MENU_INSTALAR, 1);
    $db = conectaDb();
    borraTodo($db);
    $db = null;
    print "<form action=\"$_SERVER[PHP_SELF]\" method=\"" . FORM_METHOD . "\">\n";
    print "  <p>Pulse el botón para iniciar la aplicación.</p>\n";
    print "  <p><button type=\"submit\" value=\"Sí\" name=\"fin\">Iniciar la aplicación</button></p>\n";
    print "</form>\n";
    pie();
} else {
    header("location:../index.php");
    exit();
}
?>
