<?php
/**
 * Biblioteca - db-prestamos/insertar-2.php
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
cabecera("Préstamos - Añadir 2", MENU_PRESTAMOS, 1);

$persona  = recoge("persona");
$obra     = recoge("obra");
$prestado = recoge("prestado");

$personaOk  = false;
$obraOk     = false;
$prestadoOk = false;

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

if ($personaOk && $obraOk && $prestadoOk) {
    $consulta = "SELECT COUNT(*) FROM $tablaPrestamos";
    $result = $db->query($consulta);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn() >= MAX_REG_TABLE_PRESTAMOS) {
        print "    <p>Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
        print "\n";
        print "    <p>Por favor, borre algún registro antes.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $tablaPrestamos
            WHERE id_persona=:persona
            AND id_obra=:obra
            AND prestado=:prestado";
        $result = $db->prepare($consulta);
        $result->execute([":persona" => $persona, ":obra" => $obra,
            ":prestado" => $prestado]);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn() > 0) {
            print "    <p>El registro ya existe.</p>\n";
        } else {
            $consulta = "INSERT INTO $tablaPrestamos
                (id_persona, id_obra, prestado, devuelto)
                VALUES (:persona, :obra, :prestado, '0000-00-00')";
            $result = $db->prepare($consulta);
            if ($result->execute([":persona" => $persona, ":obra" => $obra,
                ":prestado" => $prestado])) {
                print "    <p>Registro creado correctamente.</p>\n";
            } else {
                print "    <p>Error al crear el registro.</p>\n";
            }
        }
    }
}

$db = null;
pie();
