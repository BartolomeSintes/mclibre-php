<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

$pdo = conectaDb();
cabecera("Modificar 3", MENU_VOLVER);

$nombre      = recoge("nombre");
$apellidos   = recoge("apellidos");
$id          = recoge("id");
$nombreOk    = false;
$apellidosOk = false;

if (mb_strlen($nombre, "UTF-8") > $cfg["dbAgendaTamNombre"]) {
    print "    <p class=\"aviso\">El nombre no puede tener más de $cfg[dbAgendaTamNombre] caracteres.</p>\n";
    print "\n";
} else {
    $nombreOk = true;
}

if (mb_strlen($apellidos, "UTF-8") > $cfg["dbAgendaTamApellidos"]) {
    print "    <p class=\"aviso\">Los apellidos no pueden tener más de $cfg[dbAgendaTamApellidos] caracteres.</p>\n";
    print "\n";
} else {
    $apellidosOk = true;
}

if ($nombreOk && $apellidosOk) {
    $consulta = "UPDATE $cfg[dbAgendaTabla]
                 SET nombre=:nombre, apellidos=:apellidos
                 WHERE id=:id";
    $resultado = $pdo->prepare($consulta);
    if (!$resultado->execute([":nombre" => $nombre, ":apellidos" => $apellidos, ":id" => $id])) {
        print "    <p class=\"aviso\">Error al modificar el registro / {$pdo->errorInfo()[2]}</p>\n";
        print "\n";
    } else {
        print "    <p>Registro modificado correctamente.</p>\n";
        print "\n";
    }
}

$pdo = null;
pie();
