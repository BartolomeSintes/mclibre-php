<?php
/**
 * Biblioteca - db-personas/buscar-2.php
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
cabecera("Personas - Buscar 2", MENU_PERSONAS, 1);

$nombre    = recoge("nombre");
$apellidos = recoge("apellidos");
$dni       = recoge("dni");
$ordena    = recogeValores("ordena", $columnasPersonasOrden, "apellidos ASC");

$consulta = "SELECT COUNT(*) FROM $tablaPersonas
    WHERE nombre LIKE :nombre
    AND apellidos LIKE :apellidos
    AND dni LIKE :dni";
$result = $db->prepare($consulta);
$result->execute([":nombre" => "%$nombre%", ":apellidos" => "%$apellidos%",
    ":dni"                  => "%$dni%", ]);
if (!$result) {
    print "    <p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p>No se han encontrado registros.</p>\n";
} else {
    $consulta = "SELECT * FROM $tablaPersonas
        WHERE nombre LIKE :nombre
        AND apellidos LIKE :apellidos
        AND dni LIKE :dni
        ORDER BY $ordena";
    $result = $db->prepare($consulta);
    $result->execute([":nombre" => "%$nombre%", ":apellidos" => "%$apellidos%",
        ":dni"                  => "%$dni%", ]);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
    } else {
        print "    <form action=\"$_SERVER[PHP_SELF]\" method=\"" . FORM_METHOD . "\">\n";
        print "      <p>\n";
        print "        <input type=\"hidden\" name=\"nombre\" value=\"$nombre\">\n";
        print "        <input type=\"hidden\" name=\"apellidos\" value=\"$apellidos\">\n";
        print "        <input type=\"hidden\" name=\"dni\" value=\"$dni\">\n";
        print "      </p>\n";
        print "\n";
        print "      <p>Registros encontrados:</p>\n";
        print "\n";
        print "      <table class=\"conborde franjas\">\n";
        print "        <thead>\n";
        print "          <tr>\n";
        print "            <th>\n";
        print "              <button name=\"ordena\" value=\"nombre ASC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "              Nombre\n";
        print "              <button name=\"ordena\" value=\"nombre DESC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "            </th>\n";
        print "            <th>\n";
        print "              <button name=\"ordena\" value=\"apellidos ASC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "              Apellidos\n";
        print "              <button name=\"ordena\" value=\"apellidos DESC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "            </th>\n";
        print "            <th>\n";
        print "              <button name=\"ordena\" value=\"dni ASC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "              DNI\n";
        print "              <button name=\"ordena\" value=\"dni DESC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "            </th>\n";
        print "          </tr>\n";
        print "        </thead>\n";
        print "        <tbody>\n";
        foreach ($result as $valor) {
            print "          <tr>\n";
            print "            <td>$valor[nombre]</td>\n";
            print "            <td>$valor[apellidos]</td>\n";
            print "            <td>$valor[dni]</td>\n";
            print "          </tr>\n";
        }
        print "        </tbody>\n";
        print "      </table>\n";
        print "    </form>\n";
    }
}

$db = null;
pie();
