<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
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

cabecera("Préstamos - Borrar 2", MENU_PRESTAMOS, 1);

$id = recoge("id", []);

if ($id == []) {
    print "    <p class=\"aviso\">No se ha seleccionado ningún registro.</p>\n";
} else {
    foreach ($id as $indice => $valor) {
        $consulta = "SELECT COUNT(*) FROM $tablaPrestamos
            WHERE id = :indice";
        $result = $db->prepare($consulta);
        $result->execute([":indice" => $indice]);
        if (!$result) {
            print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } elseif ($result->fetchColumn() == 0) {
            print "    <p class=\"aviso\">Registro no encontrado.</p>\n";
        } else {
            $consulta = "DELETE FROM $tablaPrestamos
                WHERE id = :indice";
            $result = $db->prepare($consulta);
            if ($result->execute([":indice" => $indice])) {
                print "    <p>Registro borrado correctamente.</p>\n";
            } else {
                print "    <p class=\"aviso\">Error al borrar el registro.</p>\n";
            }
        }
    }
}

pie();
