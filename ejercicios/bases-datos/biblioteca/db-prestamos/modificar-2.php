<?php
/**
 * Biblioteca - db-prestamos/modificar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2020 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2020-05-11
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

require_once "../comunes/biblioteca.php";

session_name(SESSION_NAME);
session_start();
if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != NIVEL_2) {
    header("Location:../index.php");
    exit;
}

$db = conectaDb();
cabecera("Préstamos - Modificar 2", MENU_PRESTAMOS, 1);

$id = recoge("id");

if ($id == "") {
    print "    <p>No se ha seleccionado ningún registro.</p>\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $tablaPrestamos
       WHERE id=:id";
    $result = $db->prepare($consulta);
    $result->execute([":id" => $id]);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn() == 0) {
        print "    <p>Registro no encontrado.</p>\n";
    } else {
        $consulta = "SELECT $tablaPrestamos.id as id,
            $tablaPersonas.id as id_persona,
            $tablaPersonas.nombre as nombre,
            $tablaPersonas.apellidos as apellidos,
            $tablaObras.id as id_obra,
            $tablaObras.titulo as titulo,
            $tablaObras.autor as autor,
            $tablaPrestamos.prestado as prestado,
            $tablaPrestamos.devuelto as devuelto
        FROM $tablaPersonas, $tablaObras, $tablaPrestamos
        WHERE $tablaPrestamos.id_persona=$tablaPersonas.id
        AND $tablaPrestamos.id_obra=$tablaObras.id
        AND $tablaPrestamos.id=:id";
        $result = $db->prepare($consulta);
        $result->execute([":id" => $id]);
        $consulta2  = "SELECT * FROM $tablaPersonas ORDER BY apellidos";
        $result2    = $db->query($consulta2);
        $consulta3 = "SELECT * FROM $tablaObras ORDER BY autor";
        $result3   = $db->query($consulta3);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
        } elseif (!$result2) {
            print "    <p class=\"aviso\">Error en la consulta.</p>\n";
        } elseif (!$result3) {
            print "    <p class=\"aviso\">Error en la consulta.</p>\n";
        } else {
            $valor = $result->fetch();
            print "    <form action=\"modificar-3.php\" method=\"" . FORM_METHOD . "\">\n";
            print "      <p>Modifique los campos que desee:</p>\n";
            print "\n";
            print "      <table>\n";
            print "        <tbody>\n";
            print "          <tr>\n";
            print "            <td>Persona:</td>\n";
            print "            <td>\n";
            print "            <select name=\"persona\">\n";
            print "                <option value=\"\"></option>\n";
            foreach ($result2 as $valor2) {
                print "                <option value=\"$valor2[id]\"";
                if ($valor2["id"] == $valor["id_persona"]) {
                    print " selected";
                }
                print ">$valor2[nombre] $valor2[apellidos]</option>\n";
            }
            print "              </select>\n";
            print "            </td>\n";
            print "          </tr>\n";
            print "          <tr>\n";
            print "            <td>Obra:</td>\n";
            print "            <td>\n";
            print "            <select name=\"obra\">\n";
            print "                <option value=\"\"></option>\n";
            foreach ($result3 as $valor3) {
                print "                <option value=\"$valor3[id]\"";
                if ($valor3["id"] == $valor["id_obra"]) {
                    print " selected";
                }
                print ">$valor3[autor] - $valor3[titulo]</option>\n";
            }
            print "              </select>\n";
            print "            </td>\n";
            print "          </tr>\n";
            print "          <tr>\n";
            print "            <td>Fecha de préstamo:</td>\n";
            print "            <td><input type=\"date\" name=\"prestado\" value=\"$valor[prestado]\"></td>\n";
            print "          </tr>\n";
            print "          <tr>\n";
            print "            <td>Fecha de devolución:</td>\n";
            print "            <td><input type=\"date\" name=\"devuelto\" value=\"$valor[devuelto]\"></td>\n";
            print "          </tr>\n";
            print "        </tbody>\n";
            print "      </table>\n";
            print "\n";
            print "      <p>\n";
            print "        <input type=\"hidden\" name=\"id\" value=\"$id\">\n";
            print "        <input type=\"submit\" value=\"Actualizar\">\n";
            print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
            print "      </p>\n";
            print "    </form>\n";
        }
    }
}

$db = null;
pie();
