<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

$pdo = conectaDb();

cabecera("Buscar 2", MENU_VOLVER);

$nombre    = recoge("nombre");
$apellidos = recoge("apellidos");

$registrosEncontradosOk = false;

$consulta = "SELECT COUNT(*) FROM $cfg[tablaPersonas]
             WHERE nombre LIKE :nombre
             AND apellidos LIKE :apellidos";

$resultado = $pdo->prepare($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} elseif (!$resultado->execute([":nombre" => "%$nombre%", ":apellidos" => "%$apellidos%"])) {
    print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} elseif ($resultado->fetchColumn() == 0) {
    print "    <p class=\"aviso\">No se han encontrado registros.</p>\n";
} else {
    $registrosEncontradosOk = true;
}

if ($registrosEncontradosOk) {
    $consulta = "SELECT * FROM $cfg[tablaPersonas]
                 WHERE nombre LIKE :nombre
                 AND apellidos LIKE :apellidos";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":nombre" => "%$nombre%", ":apellidos" => "%$apellidos%"])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Registros encontrados:</p>\n";
        print "\n";
        print "    <table class=\"conborde franjas\">\n";
        print "      <thead>\n";
        print "        <tr>\n";
        print "          <th>Nombre</th>\n";
        print "          <th>Apellidos</th>\n";
        print "        </tr>\n";
        print "      </thead>\n";
        foreach ($resultado as $registro) {
            print "      <tr>\n";
            print "        <td>$registro[nombre]</td>\n";
            print "        <td>$registro[apellidos]</td>\n";
            print "      </tr>\n";
        }
        print "    </table>\n";
    }
}

pie();
