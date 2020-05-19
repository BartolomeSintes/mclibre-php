<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

$db = conectaDb();
cabecera("Modificar 3", MENU_VOLVER);

$nombre      = recoge("nombre");
$apellidos   = recoge("apellidos");
$id          = recoge("id");
$nombreOk    = false;
$apellidosOk = false;

if (mb_strlen($nombre, "UTF-8") > $tamAgendaNombre) {
    print "    <p class=\"aviso\">El nombre no puede tener más de $tamAgendaNombre caracteres.</p>\n";
    print "\n";
} else {
    $nombreOk = true;
}

if (mb_strlen($apellidos, "UTF-8") > $tamAgendaApellidos) {
    print "    <p class=\"aviso\">Los apellidos no pueden tener más de $tamAgendaApellidos caracteres.</p>\n";
    print "\n";
} else {
    $apellidosOk = true;
}

if ($nombreOk && $apellidosOk) {
    $consulta = "UPDATE $tablaAgenda
        SET nombre=:nombre, apellidos=:apellidos
        WHERE id=:id";
    $result = $db->prepare($consulta);
    if ($result->execute([":nombre" => $nombre, ":apellidos" => $apellidos,
        ":id" => $id, ])) {
        print "    <p>Registro modificado correctamente.</p>\n";
    } else {
        print "    <p class=\"aviso\">Error al modificar el registro.</p>\n";
    }
}

$db = null;
pie();
