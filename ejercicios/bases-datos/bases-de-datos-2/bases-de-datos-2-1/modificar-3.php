<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

$pdo = conectaDb();

cabecera("Modificar 3", MENU_VOLVER);

$nombre    = recoge("nombre");
$apellidos = recoge("apellidos");
$id        = recoge("id");

$nombreOk    = false;
$apellidosOk = false;
$idOk        = false;

if (mb_strlen($nombre, "UTF-8") > $cfg["tablaPersonasTamNombre"]) {
    print "    <p class=\"aviso\">El nombre no puede tener más de $cfg[tablaPersonasTamNombre] caracteres.</p>\n";
    print "\n";
} else {
    $nombreOk = true;
}

if (mb_strlen($apellidos, "UTF-8") > $cfg["tablaPersonasTamApellidos"]) {
    print "    <p class=\"aviso\">Los apellidos no pueden tener más de $cfg[tablaPersonasTamApellidos] caracteres.</p>\n";
    print "\n";
} else {
    $apellidosOk = true;
}

if ($nombre == "" && $apellidos == "") {
    print "    <p class=\"aviso\">Hay que rellenar al menos uno de los campos. No se ha guardado el registro.</p>\n";
    print "\n";
    $nombreOk = $apellidosOk = false;
}

if ($id == "") {
    print "    <p class=\"aviso\">No se ha seleccionado ningún registro.</p>\n";
} else {
    $idOk = true;
}

if ($nombreOk && $apellidosOk && $idOk) {
    $consulta = "SELECT COUNT(*) FROM $cfg[tablaPersonas]
                 WHERE id = :id";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":id" => $id])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif ($resultado->fetchColumn() == 0) {
        print "    <p class=\"aviso\">Registro no encontrado.</p>\n";
    } else {
        // La consulta cuenta los registros con un id diferente porque MySQL no distingue
        // mayúsculas de minúsculas y si en un registro sólo se cambian mayúsculas por
        // minúsculas MySQL diría que ya hay un registro como el que se quiere guardar.
        $consulta = "SELECT COUNT(*) FROM $cfg[tablaPersonas]
                     WHERE nombre = :nombre
                     AND apellidos = :apellidos
                     AND id <> :id";

        $resultado = $pdo->prepare($consulta);
        if (!$resultado) {
            print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } elseif (!$resultado->execute([":nombre" => $nombre, ":apellidos" => $apellidos, ":id" => $id])) {
            print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } elseif ($resultado->fetchColumn() > 0) {
            print "    <p class=\"aviso\">Ya existe un registro con esos mismos valores. "
                . "No se ha guardado la modificación.</p>\n";
        } else {
            $consulta = "UPDATE $cfg[tablaPersonas]
                         SET nombre = :nombre, apellidos = :apellidos
                         WHERE id = :id";

            $resultado = $pdo->prepare($consulta);
            if (!$resultado) {
                print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } elseif (!$resultado->execute([":nombre" => $nombre, ":apellidos" => $apellidos, ":id" => $id])) {
                print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } else {
                print "    <p>Registro modificado correctamente.</p>\n";
            }
        }
    }
}

$pdo = null;

pie();
