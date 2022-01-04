<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// Configuración específica para MYSQL

// Configuración general

define("MYSQL_HOST", "mysql:host=localhost");         // Nombre de host
define("MYSQL_USER", "");                             // Nombre de usuario
define("MYSQL_PASSWORD", "");                         // Contraseña de usuario
define("MYSQL_DATABASE", "identificacion_agenda_4");  // Nombre de la base de datos
define("MYSQL_TABLE_AGENDA", "agenda");               // Nombre de la tabla Personas
define("MYSQL_TABLE_USUARIOS", "usuarios");           // Nombre de la tabla Usuarios

// Nombres de las tablas

$tablaAgenda   = MYSQL_DATABASE . "." . MYSQL_TABLE_AGENDA;    // Nombre de la tabla Personas
$tablaUsuarios = MYSQL_DATABASE . "." . MYSQL_TABLE_USUARIOS;  // Nombre de la tabla Usuarios

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
];

// Consultas de borrado y creación de base de datos y tablas, etc.

define("CONSULTA_BORRA_DB", "DROP DATABASE IF EXISTS " . MYSQL_DATABASE);

define(
    "CONSULTA_CREA_DB",
    "CREATE DATABASE " . MYSQL_DATABASE . "
        CHARACTER SET utf8mb4
        COLLATE utf8mb4_unicode_ci"
);

define(
    "CONSULTA_INSERTA_USUARIO_ROOT",
    "INSERT INTO $tablaUsuarios
        VALUES (NULL, '" . ROOT_NAME . "', '" . ROOT_PASSWORD . "', $usuariosNiveles[Administrador])"
);

$consultasCreaTabla = [
    // Tabla Usuarios
    "CREATE TABLE $tablaUsuarios (
        id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
        usuario VARCHAR($tamUsuariosUsuario),
        password VARCHAR($tamUsuariosPasswordCifrado),
        nivel INTEGER NOT NULL,
        PRIMARY KEY(id)
    )",
    // Tabla Agenda
    "CREATE TABLE $tablaAgenda (
        id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
        nombre VARCHAR($tamAgendaNombre),
        apellidos VARCHAR($tamAgendaApellidos),
        telefono VARCHAR($tamAgendaTelefono),
        correo VARCHAR($tamAgendaCorreo),
        PRIMARY KEY(id)
    )",
];

// Funciones específicas de bases de datos (MYSQL)

function conectaDb()
{
    try {
        $tmp = new PDO(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
        $tmp->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $tmp->exec("set names utf8mb4");
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
    $consulta = CONSULTA_BORRA_DB;
    if ($db->query($consulta)) {
        print "    <p>Base de datos borrada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p class=\"aviso\">Error al borrar la base de datos.</p>\n";
        print "\n";
    }

    $consulta = CONSULTA_CREA_DB;
    if ($db->query($consulta)) {
        print "    <p>Base de datos creada correctamente.</p>\n";
        print "\n";
        foreach ($consultasCreacionTablas as $consulta) {
            if ($db->query($consulta)) {
                print "    <p>Tabla creada correctamente.</p>\n";
                print "\n";
            } else {
                print "    <p class=\"aviso\">Error al crear la tabla</p>\n";
                print "\n";
            }
        }
    } else {
        print "    <p class=\"aviso\">Error al crear la base de datos.</p>\n";
        print "\n";
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
    $existe   = true;
    $consulta = "SELECT count(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . MYSQL_DATABASE . "'";
    $result   = $db->query($consulta);
    if (!$result) {
        $existe = false;
        print "    <p class=\"aviso\">Error en la consulta.</p>\n";
        print "\n";
    } else {
        if ($result->fetchColumn() == 0) {
            $existe = false;
        } else {
            foreach ($nombresTablas as $tabla) {
                // En information_schema.tables los nombres de las tablas no llevan el nombre
                // de la base de datos, así que lo elimino
                $tabla    = str_replace(MYSQL_DATABASE . ".", "", $tabla);
                $consulta = "SELECT count(*) FROM information_schema.tables
                WHERE table_schema = '" . MYSQL_DATABASE . "'
                    AND table_name = '$tabla'";
                $result = $db->query($consulta);
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
        }
    }
    return $existe;
}
