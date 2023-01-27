<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["nivel"] < NIVEL_ADMINISTRADOR) {
    header("Location:../index.php");
    exit;
}

$pdo = conectaDb();

cabecera("Administrador - Estadísticas", MENU_ADMINISTRADOR, PROFUNDIDAD_1);

$consulta = "SELECT COUNT(*) FROM $cfg[tablaUsuarios]";

$resultado = $pdo->query($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} else {
    $numero = $resultado->fetchColumn();
    if ($numero == 0) {
        print "    <p>La tabla Usuarios no contiene registros.</p>\n";
    } elseif ($numero == 1) {
        print "    <p>La tabla Usuarios contiene $numero registro.</p>\n";
    } else {
        print "    <p>La tabla Usuarios contiene $numero registros.</p>\n";
    }
}

$consulta = "SELECT COUNT(*) FROM $cfg[tablaPersonas]";

$resultado = $pdo->query($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} else {
    $numero = $resultado->fetchColumn();
    if ($numero == 0) {
        print "    <p>La tabla Personas no contiene registros.</p>\n";
    } elseif ($numero == 1) {
        print "    <p>La tabla Personas contiene $numero registro.</p>\n";
    } else {
        print "    <p>La tabla Personas contiene $numero registros.</p>\n";
    }
}

pie();
