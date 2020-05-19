<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// Configuración específica para SQLite

// Configuración general

define("SQLITE_DATABASE", "/home/barto/mclibre/tmp/mclibre/identificacion-agenda-4.sqlite");  // Ubicación de la base de datos
define("SQLITE_TABLE_AGENDA", "agenda");                                                      // Nombre de la tabla Agenda
define("SQLITE_TABLE_USUARIOS", "usuarios");                                                  // Nombre de la tabla Usuarios

// Nombres de las tablas

$tablaAgenda   = SQLITE_TABLE_AGENDA;    // Nombre de la tabla Agenda
$tablaUsuarios = SQLITE_TABLE_USUARIOS;  // Nombre de la tabla Usuarios

$tablas = [
    $tablaUsuarios,
    $tablaAgenda,
];

// Valores de ordenación de las tablas

$columnasAgendaOrden = [
    "nombre ASC", "nombre DESC",
    "apellidos ASC", "apellidos DESC",
    "telefono ASC", "telefono DESC",
    "correo ASC", "correo DESC",
];

$columnasUsuariosOrden = [
    "usuario ASC", "usuario DESC",
    "password ASC", "password DESC",
    "nivel ASC", "nivel DESC",
];

// Consultas de borrado y creación de base de datos y tablas, etc.

define(
    "CONSULTA_INSERTA_USUARIO_ROOT",
    "INSERT INTO $tablaUsuarios
        VALUES (NULL, '" . ROOT_NAME . "', '" . ROOT_PASSWORD . "', $usuariosNiveles[Administrador])"
);

$consultasCreaTabla = [
    // Tabla Usuarios
    "CREATE TABLE $tablaUsuarios (
        id INTEGER PRIMARY KEY,
        usuario VARCHAR($tamUsuariosUsuario),
        password VARCHAR($tamUsuariosPasswordCifrado),
        nivel INTEGER
    )",
    // Tabla Agenda
    "CREATE TABLE $tablaAgenda (
        id INTEGER PRIMARY KEY,
        nombre VARCHAR($tamAgendaNombre),
        apellidos VARCHAR($tamAgendaApellidos),
        telefono VARCHAR($tamAgendaTelefono),
        correo VARCHAR($tamAgendaCorreo)
    )",
];

// Funciones específicas de bases de datos (SQLITE)

function conectaDb()
{
    try {
        $tmp = new PDO("sqlite:" . SQLITE_DATABASE);
        return $tmp;
    } catch (PDOException $e) {
        cabecera("Error grave", MENU_VOLVER, 1);
        print "    <p class=\"aviso\">Error: No puede conectarse con la base de datos.</p>\n";
        print "\n";
        print "    <p class=\"aviso\">Error: " . $e->getMessage() . "</p>\n";
        pie();
        exit();
    }
}

function borraTodo($db, $nombresTablas, $consultasCreacionTablas)
{
    foreach ($nombresTablas as $tabla) {
        $consulta = "DROP TABLE $tabla";
        if ($db->query($consulta)) {
            print "    <p>Tabla <strong>$tabla</strong> borrada correctamente.</p>\n";
            print "\n";
        } else {
            print "    <p class=\"aviso\">Error al borrar la tabla <strong>$tabla</strong>.</p>\n";
            print "\n";
        }
    }

    foreach ($consultasCreacionTablas as $consulta) {
        if ($db->query($consulta)) {
            print "    <p>Tabla creada correctamente.</p>\n";
            print "\n";
        } else {
            print "    <p class=\"aviso\">Error al crear la tabla.</p>\n";
            print "\n";
        }
    }

    $consulta = CONSULTA_INSERTA_USUARIO_ROOT;
    if ($db->query($consulta)) {
        print "    <p>Registro de Usuario " . ROOT_NAME . " creado correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p class=\"aviso\">Error al crear el registro de Usuario " . ROOT_NAME . ".<p>\n";
        print "\n";
    }
}

function existenTablas($db, $nombresTablas)
{
    $existe = true;
    foreach ($nombresTablas as $tabla) {
        $consulta = "SELECT count(*) FROM sqlite_master WHERE type='table' AND name='$tabla'";
        $result   = $db->query($consulta);
        if (!$result) {
            $existe = false;
            print "    <p class=\"aviso\">Error en la consulta.</p>\n";
            print "\n";
        } else {
            if ($result->fetchColumn() == 0) {
                $existe = false;
            }
        }
    }
    return $existe;
}
