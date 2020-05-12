<?php
/**
 * Biblioteca - db-prestamos/modificar-3.php
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
cabecera("Préstamos - Modificar 3", MENU_PRESTAMOS, 1);

$persona  = recoge("persona");
$obra     = recoge("obra");
$prestado = recoge("prestado");
$devuelto = recoge("devuelto");
$id       = recoge("id");

$personaOk  = false;
$obraOk     = false;
$prestadoOk = false;
$devueltoOk = false;
$idOk       = false;

$consulta = "SELECT COUNT(*) FROM $tablaPersonas
    WHERE id=:persona";
$result = $db->prepare($consulta);
$result->execute([":persona" => $persona]);
if (!$result) {
    print "    <p class=\"aviso\">Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p class=\"aviso\">La persona seleccionada no existe.</p>\n";
} else {
    $personaOk = true;
}

$consulta = "SELECT COUNT(*) FROM $tablaObras
    WHERE id=:obra";
$result = $db->prepare($consulta);
$result->execute([":obra" => $obra]);
if (!$result) {
    print "    <p class=\"aviso\">Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p class=\"aviso\">La obra seleccionada no existe.</p>\n";
} else {
    $obraOk = true;
}

if (!checkdate(substr($prestado, 5, 2), substr($prestado, 8, 2), substr($prestado, 0, 4))){
    print "    <p class=\"aviso\">La fecha <strong>$prestado</strong> indicada no es una fecha válida.</p>\n";
} else {
    $prestadoOk = true;
}

if ($devuelto == "0000-00-00") {
    $devueltoOk = true;
} elseif (!checkdate(substr($devuelto, 5, 2), substr($devuelto, 8, 2), substr($devuelto, 0, 4))) {
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

if ($personaOk && $obraOk && $prestadoOk && $devueltoOk) {
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
            // La consulta cuenta los registros con un id diferente porque MySQL no distingue
            // mayúsculas de minúsculas y si en un registro sólo se cambian mayúsculas por
            // minúsculas MySQL diría que ya hay un registro como el que se quiere guardar.
            $consulta = "SELECT COUNT(*) FROM $tablaPrestamos
                WHERE id_persona=:persona
                AND id_obra=:obra
                AND id<>:id";
            $result = $db->prepare($consulta);
            $result->execute([":persona" => $persona, ":obra" => $obra,
                ":id" => $id]);
            if (!$result) {
                print "    <p>Error en la consulta.</p>\n";
            } elseif ($result->fetchColumn() > 0) {
                print "    <p>Ya existe un registro con esos mismos valores. "
                    . "No se ha guardado la modificación.</p>\n";
            } else {
                $consulta = "UPDATE $tablaPrestamos
                    SET id_persona=:persona, id_obra=:obra,
                        prestado=:prestado, devuelto=:devuelto
                    WHERE id=:id";
                $result = $db->prepare($consulta);
                if ($result->execute([":persona" => $persona, ":obra" => $obra,
                    ":prestado" => $prestado, ":devuelto" => $devuelto, ":id" => $id])) {
                    print "    <p>Registro modificado correctamente.</p>\n";
                } else {
                    print "    <p>Error al modificar el registro.</p>\n";
                }
            }
        }
    }
}

$db = null;
pie();
