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
cabecera("Usuarios - Borrar 2", MENU_USUARIOS, 1);

$id = recoge("id", []);

if (count($id) == 0) {
    print "    <p class=\"aviso\">No se ha seleccionado ningún registro.</p>\n";
} else {
    foreach ($id as $indice => $valor) {
        $consulta = "SELECT * FROM $tablaUsuarios
            WHERE id=:id";
        $result = $db->prepare($consulta);
        $result->execute([":id" => $indice]);
        if (!$result) {
            print "    <p class=\"aviso\">Error en la consulta.</p>\n";
        } else {
            $valor = $result->fetch();
            if ($valor["usuario"] == ROOT_NAME) {
                print "    <p>Este usuario no se puede borrar.</p>\n";
            } else {
                $consulta = "SELECT COUNT(*) FROM $tablaUsuarios
                    WHERE id=:indice";
                $result = $db->prepare($consulta);
                $result->execute([":indice" => $indice]);
                if (!$result) {
                    print "    <p class=\"aviso\">Error en la consulta.</p>\n";
                } elseif ($result->fetchColumn() == 0) {
                    print "    <p class=\"aviso\">Registro no encontrado.</p>\n";
                } else {
                    $consulta = "DELETE FROM $tablaUsuarios
                        WHERE id=:indice";
                    $result = $db->prepare($consulta);
                    if ($result->execute([":indice" => $indice])) {
                        print "    <p>Registro borrado correctamente.</p>\n";
                    } else {
                        print "    <p class=\"aviso\">Error al borrar el registro.</p>\n";
                    }
                }
            }
        }
    }
}

$db = null;
pie();
