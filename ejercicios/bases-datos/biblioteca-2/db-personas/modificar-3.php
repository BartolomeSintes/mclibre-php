<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../comunes/biblioteca.php";

session_name(SESSION_NAME);
session_start();
if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != NIVEL_2) {
    header("Location:../index.php");
    exit;
}

$db = conectaDb();
cabecera("Personas - Modificar 3", MENU_PERSONAS, 1);

$nombre    = recoge("nombre");
$apellidos = recoge("apellidos");
$dni       = recoge("dni");
$id        = recoge("id");

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
    if ($id == "") {
        print "    <p class=\"aviso\">No se ha seleccionado ningún registro.</p>\n";
    } elseif ($nombre == "" && $apellidos == "" && $dni == "") {
        print "    <p class=\"aviso\">Hay que rellenar al menos uno de los campos. No se ha guardado la modificación.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $tablaPersonas
            WHERE id=:id";
        $result = $db->prepare($consulta);
        $result->execute([":id" => $id]);
        if (!$result) {
            print "    <p class=\"aviso\">Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn() == 0) {
            print "    <p class=\"aviso\">Registro no encontrado.</p>\n";
        } else {
            // La consulta cuenta los registros con un id diferente porque MySQL no distingue
            // mayúsculas de minúsculas y si en un registro sólo se cambian mayúsculas por
            // minúsculas MySQL diría que ya hay un registro como el que se quiere guardar.
            $consulta = "SELECT COUNT(*) FROM $tablaPersonas
                WHERE nombre=:nombre
                AND apellidos=:apellidos
                AND dni=:dni
                AND id<>:id";
            $result = $db->prepare($consulta);
            $result->execute([":nombre" => $nombre, ":apellidos" => $apellidos,
                ":dni"                  => $dni, ":id" => $id, ]);
            if (!$result) {
                print "    <p class=\"aviso\">Error en la consulta.</p>\n";
            } elseif ($result->fetchColumn() > 0) {
                print "    <p class=\"aviso\">Ya existe un registro con esos mismos valores. "
                    . "No se ha guardado la modificación.</p>\n";
            } else {
                $consulta = "UPDATE $tablaPersonas
                    SET nombre=:nombre, apellidos=:apellidos,
                        dni=:dni
                    WHERE id=:id";
                $result = $db->prepare($consulta);
                if ($result->execute([":nombre" => $nombre, ":apellidos" => $apellidos,
                    ":dni" => $dni, ":id" => $id, ])) {
                    print "    <p>Registro modificado correctamente.</p>\n";
                } else {
                    print "    <p class=\"aviso\">Error al modificar el registro.</p>\n";
                }
            }
        }
    }
}

$db = null;
pie();
