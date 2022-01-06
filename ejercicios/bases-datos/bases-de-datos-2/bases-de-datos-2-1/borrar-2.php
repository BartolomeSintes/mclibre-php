<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

$pdo = conectaDb();

cabecera("Borrar 2", MENU_VOLVER);

$id = recoge("id", []);

if (count($id) == 0) {
    print "    <p class=\"aviso\">No se ha seleccionado ningún registro.</p>\n";
} else {
    foreach ($id as $indice => $valor) {
        $consulta = "SELECT COUNT(*) FROM $cfg[dbPersonasTabla]
                     WHERE id=:indice";
        $resultado = $pdo->prepare($consulta);
        $resultado->execute([":indice" => $indice]);

        if (!$resultado) {
            print "    <p class=\"aviso\">Error en la consulta.</p>\n";
        } elseif ($resultado->fetchColumn() == 0) {
            print "    <p class=\"aviso\">Registro no encontrado.</p>\n";
        } else {
            $consulta = "DELETE FROM $cfg[dbPersonasTabla]
                         WHERE id=:indice";
            $resultado = $pdo->prepare($consulta);

            if (!$resultado->execute([":indice" => $indice])) {
                print "    <p class=\"aviso\">Error al borrar el registro / {$pdo->errorInfo()[2]}</p>\n";
            } else {
                print "    <p>Registro borrado correctamente.</p>\n";
            }
        }
    }
}

$pdo = null;

pie();
