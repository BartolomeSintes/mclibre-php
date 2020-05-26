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

if ($devuelto == "") {
    $devuelto   = "0000-00-00";
    $devueltoOk = true;
} elseif (mb_strlen($devuelto, "UTF-8") < $tamFecha) {
    print "    <p class=\"aviso\">La fecha <strong>$devuelto</strong> de devolución no es una fecha válida.</p>\n";
} elseif (!ctype_digit(substr($devuelto, 5, 2)) || !ctype_digit(substr($devuelto, 8, 2)) || !ctype_digit(substr($devuelto, 0, 4))) {
    print "    <p class=\"aviso\">La fecha <strong>$devuelto</strong> de devolución no es una fecha válida.</p>\n";
} elseif (!checkdate(substr($devuelto, 5, 2), substr($devuelto, 8, 2), substr($devuelto, 0, 4))) {
    print "    <p class=\"aviso\">La fecha <strong>$devuelto</strong> de devolución no es una fecha válida.</p>\n";
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
            print "    <p class=\"aviso\">La fecha de devolución <strong>$devuelto</strong> es anterior a la de préstamo <strong>$prestado</strong>.</p>\n";
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
        print "    <p class=\"aviso\">Error al modificar el registro.</p>\n";
    }
}

$db = null;
pie();
