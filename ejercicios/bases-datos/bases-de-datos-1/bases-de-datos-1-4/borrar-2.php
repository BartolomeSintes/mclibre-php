<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

$db = conectaDb();
cabecera("Borrar 2", MENU_VOLVER);

$id = recoge("id", []);

foreach ($id as $indice => $valor) {
    $consulta = "DELETE FROM $tablaAgenda
        WHERE id=:indice";
    $result = $db->prepare($consulta);
    if ($result->execute([":indice" => $indice])) {
        print "    <p>Registro borrado correctamente.</p>\n";
    } else {
        print "    <p class=\"aviso\">Error al borrar el registro.</p>\n";
    }
}

$db = null;
pie();
