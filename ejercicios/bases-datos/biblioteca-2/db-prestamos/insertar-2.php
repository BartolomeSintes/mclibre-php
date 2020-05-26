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
cabecera("Préstamos - Añadir 2", MENU_PRESTAMOS, 1);

$id_persona = recoge("id_persona");
$id_obra    = recoge("id_obra");
$prestado   = recoge("prestado");

$id_personaOk = false;
$id_obraOk    = false;
$prestadoOk   = false;

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

if ($id_personaOk && $id_obraOk && $prestadoOk) {
    $consulta = "SELECT COUNT(*) FROM $tablaPrestamos";
    $result   = $db->query($consulta);
    if (!$result) {
        print "    <p class=\"aviso\">Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn() >= MAX_REG_TABLE_PRESTAMOS) {
        print "    <p class=\"aviso\">Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
        print "\n";
        print "    <p class=\"aviso\">Por favor, borre algún registro antes.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $tablaPrestamos
            WHERE id_persona=:id_persona
            AND id_obra=:id_obra
            AND prestado=:prestado";
        $result = $db->prepare($consulta);
        $result->execute([":id_persona" => $id_persona, ":id_obra" => $id_obra,
            ":prestado"                 => $prestado, ]);
        if (!$result) {
            print "    <p class=\"aviso\">Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn() > 0) {
            print "    <p class=\"aviso\">El registro ya existe.</p>\n";
        } else {
            $consulta = "INSERT INTO $tablaPrestamos
                (id_persona, id_obra, prestado, devuelto)
                VALUES (:id_persona, :id_obra, :prestado, '0000-00-00')";
            $result = $db->prepare($consulta);
            if ($result->execute([":id_persona" => $id_persona, ":id_obra" => $id_obra,
                ":prestado" => $prestado, ])) {
                print "    <p>Registro creado correctamente.</p>\n";
            } else {
                print "    <p class=\"aviso\">Error al crear el registro.</p>\n";
            }
        }
    }
}

$db = null;
pie();
