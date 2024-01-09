<?php
/**
 * Inyección SQL 1 - entrar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2011 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-05-18
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

include "biblioteca.php";
$db = conectaDb();
cabecera("Entrar 2", MENU_VOLVER);

// Esta página no desinfecta la entrada del usuario
// por lo que puede sufrir inyecciones SQL
// Utiliza la biblioteca sqlite
// Parece que le afectan los mismos ataques que a PDO

$usuario    = $_REQUEST["usuario"];
$contraseña = $_REQUEST["contraseña"];

if ($usuario == "" || $contraseña == "") {
    print "    <p>Hay que rellenar los dos campos.</p>\n";
    print "\n";
} else {
    $consulta = "SELECT * FROM $dbTabla
        WHERE user='$usuario'
        AND password='$contraseña'";
print $consulta;
    $result = sqlite_query_multi($db, $consulta);
    print "    <pre>RESULT"; print($result);print "</pre>";
    print "\n";
    $valor = sqlite_fetch_array($result);
    print "    <pre>RESULTADO"; print_r($valor);print "</pre>";
    print "\n";
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } elseif ($valor[0]>0) {
        print "    <p>Nombre de usuario y contraseña correctos.</p>\n";
        print "\n";
    } else {
        $consulta = "SELECT * FROM $dbTabla
            WHERE user='$usuario'";
        $result = sqlite_query_multi($db, $consulta);
        $valor = sqlite_fetch_array($result);
    print "    <pre>RESULTADO"; print_r($valor);print "</pre>";
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
            print "\n";
        } elseif ($valor[0]>0) {
            print "    <p>Contraseña incorrecta.</p>\n";
            print "\n";
        } else {
            print "    <p>Nombre de usuario incorrecto.</p>\n";
            print "\n";
        }
    }
}

pie();
?>
<?
/*
 if ($usuario == "" || $contraseña == "") {
    print "  <p>Hay que rellenar los dos campos.</p>\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbTabla
        WHERE user='$usuario'
        AND password='$contraseña'";
print $consulta;
    $result = sqlite_query($db, $consulta);
    $valor = sqlite_fetch_array($result);
    print "  <pre>RESULTADO"; print_r($valor);print "</pre>";
    if (!$result) {
        print "  <p>Error en la consulta.</p>\n";
    } elseif ($valor[0]>0) {
        print "  <p>Nombre de usuario y contraseña correctos.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbTabla
            WHERE user='$usuario'";
        $result = sqlite_query($db, $consulta);
        $valor = sqlite_fetch_array($result);
    print "  <pre>RESULTADO"; print_r($valor);print "</pre>";
        if (!$result) {
            print "  <p>Error en la consulta.</p>\n";
        } elseif ($valor[0]>0) {
            print "  <p>Contraseña incorrecta.</p>\n";
        } else {
            print "  <p>Nombre de usuario incorrecto.</p>\n";
        }
    }
}
*/
?>
