<?php
/**
 * Bases de datos 3-1 - db-usuarios/listar.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-05-07
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

session_start();

require_once "../comunes/biblioteca.php";

if (!isset($_SESSION["id"]) || $_SESSION["nivel"] != NIVEL_3) {
    header("location:../index.php");
    exit();
}

$db = conectaDb();
cabecera("Tabla Usuarios - Listar", MENU_TABLA_USUARIOS_WEB, 1);

$columna = recogeValores("columna", $columnasUsuariosWeb, "usuario");
$orden   = recogeValores("orden", $orden, "ASC");

$consulta = "SELECT COUNT(*) FROM $dbTablaUsuariosWeb";
$result = $db->query($consulta);
if (!$result) {
    print "    <p class=\"aviso\">Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0 ) {
    print "    <p>No se ha creado todavía ningún registro.</p>\n";
} else {
    $consulta = "SELECT * FROM $dbTablaUsuariosWeb
        ORDER BY $columna $orden";
    $result = $db->query($consulta);
    if (!$result) {
        print "    <p class=\"aviso\">Error en la consulta.</p>\n";
    } else {
        print "    <p>Listado completo de registros:</p>\n";
        print "\n";
        print "    <table class=\"conborde franjas\">\n";
        print "      <thead>\n";
        print "        <tr>\n";
        print "          <th>\n";
        print "            <a href=\"$_SERVER[PHP_SELF]?columna=usuario&amp;orden=ASC\">\n";
        print "              <img src=\"../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\"></a>\n";
        print "            Usuario\n";
        print "            <a href=\"$_SERVER[PHP_SELF]?columna=usuario&amp;orden=DESC\">\n";
        print "              <img src=\"../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\"></a>\n";
        print "          </th>\n";
        print "          <th>\n";
        print "            <a href=\"$_SERVER[PHP_SELF]?columna=password&amp;orden=ASC\">\n";
        print "              <img src=\"../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\"></a>\n";
        print "            Contraseña (hash)\n";
        print "            <a href=\"$_SERVER[PHP_SELF]?columna=password&amp;orden=DESC\">\n";
        print "              <img src=\"../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\"></a>\n";
        print "          </th>\n";
        print "          <th>\n";
        print "            <a href=\"$_SERVER[PHP_SELF]?columna=nivel&amp;orden=ASC\">\n";
        print "              <img src=\"../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\"></a>\n";
        print "            Nivel\n";
        print "            <a href=\"$_SERVER[PHP_SELF]?columna=nivel&amp;orden=DESC\">\n";
        print "              <img src=\"../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\"></a>\n";
        print "          </th>\n";
        print "        </tr>\n";
        print "      </thead>\n";
        print "      <tbody>\n";
        foreach ($result as $valor) {
            print "        <tr>\n";
            print "          <td>$valor[usuario]</td>\n";
            print "          <td>$valor[password]</td>\n";
            print "          <td>" . $usuariosWebNiveles[$valor["nivel"] - 1][0] . "</td>\n";
            print "        </tr>\n";
        }
        print "      </tbody>\n";
        print "    </table>\n";
    }
}

$db = null;
pie();
