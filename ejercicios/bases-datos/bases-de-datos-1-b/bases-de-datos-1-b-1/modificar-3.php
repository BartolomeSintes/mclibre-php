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
$telefono  = recoge("telefono");
$id        = recoge("id");

$nombreOk    = false;
$apellidosOk = false;
$telefonoOk  = false;

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

if (mb_strlen($telefono, "UTF-8") > $cfg["tablaPersonasTamTelefono"]) {
    print "    <p class=\"aviso\">El teléfono no puede tener más de $cfg[tablaPersonasTamTelefono] caracteres.</p>\n";
    print "\n";
} else {
    $telefonoOk = true;
}

if ($nombreOk && $apellidosOk && $telefonoOk) {
    $consulta = "UPDATE $cfg[tablaPersonas]
                 SET nombre = :nombre, apellidos = :apellidos,
                     telefono = :telefono
                 WHERE id = :id";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":nombre" => $nombre, ":apellidos" => $apellidos, ":telefono" => $telefono, ":id" => $id])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Registro modificado correctamente.</p>\n";
    }
}

$pdo = null;

pie();
