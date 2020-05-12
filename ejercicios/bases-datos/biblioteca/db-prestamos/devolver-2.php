<?php
/**
 * Biblioteca - db-prestamos/devolver-2.php
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
cabecera("Préstamos - Devolver 2", MENU_PRESTAMOS, 1);

$id       = recoge("id");
$devuelto = recoge("devuelto");

$idOk       = false;
$devueltoOk = false;

$consulta = "SELECT COUNT(*) FROM $tablaPrestamos
    WHERE id=:id";
$result = $db->prepare($consulta);
$result->execute([":id" => $id]);
if (!$result) {
    print "    <p class=\"aviso\">Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p class=\"aviso\">El préstamo seleccionado no existe.</p>\n";
} else {
    $idOk = true;
}

if (!checkdate(substr($devuelto, 5, 2), substr($devuelto, 8, 2), substr($devuelto, 0, 4))) {
    print "    <p class=\"aviso\">La fecha <strong>$devuelto</strong> indicada no es una fecha válida.</p>\n";
} else {
    $consulta = "SELECT prestado FROM $tablaPrestamos
        WHERE id=:id";
    $result = $db->prepare($consulta);
    $result->execute([":id" => $id]);
    if (!$result) {
        print "    <p class=\"aviso\">Error en la consulta.</p>\n";
    } else {
        $prestado = $result->fetchColumn();
        if ($prestado > $devuelto) {
            print "    <p class=\"aviso\">Error: fecha de devolución <strong>$devuelto</strong> anterior a la de préstamo <strong>$prestado</strong>.</p>\n";
        } else {
            $devueltoOk = true;
        }
    }
}

if ($idOk && $devueltoOk) {
    $consulta = "UPDATE $tablaPrestamos
        SET devuelto='$devuelto'
        WHERE id=:id";
    $result = $db->prepare($consulta);
    if ($result->execute([":id" => $id])) {
        print "    <p>Registro modificado correctamente.</p>\n";
    } else {
        print "    <p>Error al modificar el registro.</p>\n";
    }
}

$db = null;
pie();
