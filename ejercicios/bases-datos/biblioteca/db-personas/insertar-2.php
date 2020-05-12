<?php
/**
 * Biblioteca - db-personas/insertar-2.php
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
cabecera("Personas - Añadir 2", MENU_PERSONAS, 1);

$nombre    = recoge("nombre");
$apellidos = recoge("apellidos");
$dni       = recoge("dni");

$nombreOk    = false;
$apellidosOk = false;
$dniOk       = false;

if (mb_strlen($nombre, "UTF-8") > $tamPersonasNombre) {
    print "    <p class=\"aviso\">El nombre no puede tener más de $tamPersonasNombre caracteres.</p>\n";
    print "\n";
} else {
    $nombreOk = true;
}

if (mb_strlen($apellidos, "UTF-8") > $tamPersonasApellidos) {
    print "    <p class=\"aviso\">Los apellidos no pueden tener más de $tamPersonasApellidos caracteres.</p>\n";
    print "\n";
} else {
    $apellidosOk = true;
}

if (mb_strlen($dni, "UTF-8") > $tamPersonasDni) {
    print "    <p class=\"aviso\">El teléfono no puede tener más de $tamPersonasDni caracteres.</p>\n";
    print "\n";
} else {
    $dniOk = true;
}

if ($nombreOk && $apellidosOk && $dniOk) {
    if ($nombre == "" && $apellidos == ""  && $dni == "") {
        print "    <p>Hay que rellenar al menos uno de los campos. No se ha guardado el registro.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $tablaPersonas";
        $result = $db->query($consulta);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn() >= MAX_REG_TABLE_PERSONAS) {
            print "    <p>Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
            print "\n";
            print "    <p>Por favor, borre algún registro antes.</p>\n";
        } else {
            $consulta = "SELECT COUNT(*) FROM $tablaPersonas
                WHERE nombre=:nombre
                AND apellidos=:apellidos
                AND dni=:dni";
            $result = $db->prepare($consulta);
            $result->execute([":nombre" => $nombre, ":apellidos" => $apellidos,
                ":dni" => $dni]);
            if (!$result) {
                print "    <p>Error en la consulta.</p>\n";
            } elseif ($result->fetchColumn() > 0) {
                print "    <p>El registro ya existe.</p>\n";
            } else {
                $consulta = "INSERT INTO $tablaPersonas
                    (nombre, apellidos, dni)
                    VALUES (:nombre, :apellidos, :dni)";
                $result = $db->prepare($consulta);
                if ($result->execute([":nombre" => $nombre, ":apellidos" => $apellidos,
                    ":dni" => $dni])) {
                    print "    <p>Registro <strong>$nombre $apellidos $dni</strong> creado correctamente.</p>\n";
                } else {
                    print "    <p>Error al crear el registro <strong>$nombre $apellidos $dni</strong>.</p>\n";
                }
            }
        }
    }
}

$db = null;
pie();
