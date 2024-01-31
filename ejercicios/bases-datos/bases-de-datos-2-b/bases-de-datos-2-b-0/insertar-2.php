<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

$pdo = conectaDb();

cabecera("Añadir 2", MENU_VOLVER);

$nombre    = recoge("nombre");
$apellidos = recoge("apellidos");

$nombreOk    = false;
$apellidosOk = false;

if (mb_strlen($nombre, "UTF-8") > $cfg["formPersonasMaxNombre"]) {
    print "    <p class=\"aviso\">El nombre no puede tener más de $cfg[formPersonasMaxNombre] caracteres.</p>\n";
    print "\n";
} else {
    $nombreOk = true;
}

if (mb_strlen($apellidos, "UTF-8") > $cfg["formPersonasMaxApellidos"]) {
    print "    <p class=\"aviso\">Los apellidos no pueden tener más de $cfg[formPersonasMaxApellidos] caracteres.</p>\n";
    print "\n";
} else {
    $apellidosOk = true;
}

$registroNoVacioOk = false;

if ($nombre == "" && $apellidos == "") {
    print "    <p class=\"aviso\">Hay que rellenar al menos uno de los campos. No se ha guardado el registro.</p>\n";
    print "\n";
} else {
    $registroNoVacioOk = true;
}

$registroDistintoOk = false;

if ($nombreOk && $apellidosOk && $registroNoVacioOk) {
    $consulta = "SELECT COUNT(*) FROM $cfg[tablaPersonas]
                 WHERE nombre = :nombre
                 AND apellidos = :apellidos";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":nombre" => $nombre, ":apellidos" => $apellidos])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif ($resultado->fetchColumn() > 0) {
        print "    <p class=\"aviso\">El registro ya existe.</p>\n";
    } else {
        $registroDistintoOk = true;
    }
}

$limiteRegistrosOk = false;

if ($nombreOk && $apellidosOk && $registroNoVacioOk && $registroDistintoOk) {
    $consulta = "SELECT COUNT(*) FROM $cfg[tablaPersonas]";

    $resultado = $pdo->query($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif ($resultado->fetchColumn() >= $cfg["tablaPersonasMaxReg"]) {
        print "    <p class=\"aviso\">Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
        print "\n";
        print "    <p class=\"aviso\">Por favor, borre algún registro antes de insertar un nuevo registro.</p>\n";
    } else {
        $limiteRegistrosOk = true;
    }
}

if ($nombreOk && $apellidosOk && $registroNoVacioOk && $registroDistintoOk && $limiteRegistrosOk) {
    $consulta = "INSERT INTO $cfg[tablaPersonas]
                 (nombre, apellidos)
                 VALUES (:nombre, :apellidos)";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":nombre" => $nombre, ":apellidos" => $apellidos])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Registro creado correctamente.</p>\n";
    }
}

pie();
