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
cabecera("Préstamos - Modificar 3", MENU_PRESTAMOS, 1);

$id_persona = recoge("id_persona");
$id_obra    = recoge("id_obra");
$prestado   = recoge("prestado");
$devuelto   = recoge("devuelto");
$id         = recoge("id");

$id_personaOk = false;
$id_obraOk    = false;
$prestadoOk   = false;
$devueltoOk   = false;
$idOk         = false;

$consulta = "SELECT COUNT(*) FROM $tablaPersonas
    WHERE id=:id_persona";
$result = $db->prepare($consulta);
$result->execute([":id_persona" => $id_persona]);
if (!$result) {
    print "    <p class=\"aviso\">Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p class=\"aviso\">La persona seleccionada no existe.</p>\n";
} else {
    $id_personaOk = true;
}

$consulta = "SELECT COUNT(*) FROM $tablaObras
    WHERE id=:id_obra";
$result = $db->prepare($consulta);
$result->execute([":id_obra" => $id_obra]);
if (!$result) {
    print "    <p class=\"aviso\">Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p class=\"aviso\">La obra seleccionada no existe.</p>\n";
} else {
    $id_obraOk = true;
}

if ($prestado == "" || mb_strlen($prestado, "UTF-8") < $tamFecha) {
    print "    <p class=\"aviso\">La fecha <strong>$prestado</strong> de préstamo no es una fecha válida.</p>\n";
} elseif (!ctype_digit(substr($prestado, 5, 2)) || !ctype_digit(substr($prestado, 8, 2)) || !ctype_digit(substr($prestado, 0, 4))) {
    print "    <p class=\"aviso\">La fecha <strong>$prestado</strong> de préstamo no es una fecha válida.</p>\n";
} elseif (!checkdate(substr($prestado, 5, 2), substr($prestado, 8, 2), substr($prestado, 0, 4))) {
    print "    <p class=\"aviso\">La fecha <strong>$prestado</strong> de préstamo no es una fecha válida.</p>\n";
} else {
    $prestadoOk = true;
}

if ($devuelto == "") {
    $devuelto   = "0000-00-00";
    $devueltoOk = true;
} elseif (mb_strlen($devuelto, "UTF-8") < $tamFecha) {
    print "    <p class=\"aviso\">La fecha <strong>$devuelto</strong> de devolución no es una fecha válida.</p>\n";
} elseif (!ctype_digit(substr($devuelto, 5, 2)) || !ctype_digit(substr($devuelto, 8, 2)) || !ctype_digit(substr($devuelto, 0, 4))) {
    print "    <p class=\"aviso\">La fecha <strong>$devuelto</strong> de devolución no es una fecha válida.</p>\n";
} elseif (!checkdate(substr($devuelto, 5, 2), substr($devuelto, 8, 2), substr($devuelto, 0, 4))) {
    print "    <p class=\"aviso\">La fecha <strong>$devuelto</strong> de devolución no es una fecha válida.</p>\n";
} elseif ($prestado > $devuelto) {
    print "    <p class=\"aviso\">La fecha de devolución <strong>$devuelto</strong> es anterior a la de préstamo <strong>$prestado</strong>.</p>\n";
} else {
    $devueltoOk = true;
}

if ($id_personaOk && $id_obraOk && $prestadoOk && $devueltoOk) {
    if ($id == "") {
        print "    <p class=\"aviso\">No se ha seleccionado ningún registro.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $tablaPrestamos
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
            $consulta = "SELECT COUNT(*) FROM $tablaPrestamos
                WHERE id_persona=:id_persona
                AND id_obra=:id_obra
                AND id<>:id";
            $result = $db->prepare($consulta);
            $result->execute([":id_persona" => $id_persona, ":id_obra" => $id_obra,
                ":id"                       => $id, ]);
            if (!$result) {
                print "    <p class=\"aviso\">Error en la consulta.</p>\n";
            } elseif ($result->fetchColumn() > 0) {
                print "    <p class=\"aviso\">Ya existe un registro con esos mismos valores. "
                    . "No se ha guardado la modificación.</p>\n";
            } else {
                $consulta = "UPDATE $tablaPrestamos
                    SET id_persona=:id_persona, id_obra=:id_obra,
                        prestado=:prestado, devuelto=:devuelto
                    WHERE id=:id";
                $result = $db->prepare($consulta);
                if ($result->execute([":id_persona" => $id_persona, ":id_obra" => $id_obra,
                    ":prestado" => $prestado, ":devuelto" => $devuelto, ":id" => $id, ])) {
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
