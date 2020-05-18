<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// Configuración específica para MYSQL

// Configuración general

define("MYSQL_HOST", "mysql:host=localhost");         // Nombre de host
define("MYSQL_USER", "");                             // Nombre de usuario
define("MYSQL_PASSWORD", "");                         // Contraseña de usuario
define("MYSQL_DATABASE", "biblioteca");               // Nombre de la base de datos
define("MYSQL_TABLE_USUARIOS", "usuarios");           // Nombre de la tabla Usuarios
define("MYSQL_TABLE_PERSONAS", "personas");           // Nombre de la tabla Personas
define("MYSQL_TABLE_OBRAS", "obras");                 // Nombre de la tabla Obras
define("MYSQL_TABLE_PRESTAMOS", "prestamos");         // Nombre de la tabla Préstamos

// Nombres de las tablas

$tablaUsuarios  = MYSQL_DATABASE . "." . MYSQL_TABLE_USUARIOS;   // Nombre de la tabla Usuarios
$tablaPersonas  = MYSQL_DATABASE . "." . MYSQL_TABLE_PERSONAS;   // Nombre de la tabla Personas
$tablaObras     = MYSQL_DATABASE . "." . MYSQL_TABLE_OBRAS;      // Nombre de la tabla Obras
$tablaPrestamos = MYSQL_DATABASE . "." . MYSQL_TABLE_PRESTAMOS;  // Nombre de la tabla Préstamos

$tablas = [
    $tablaUsuarios,
    $tablaPersonas,
    $tablaObras,
    $tablaPrestamos,
];

// Valores de ordenación de las tablas

$columnasUsuariosOrden = [
    "usuario ASC", "usuario DESC",
    "password ASC", "password DESC",
];

$columnasPersonasOrden = [
    "nombre ASC", "nombre DESC",
    "apellidos ASC", "apellidos DESC",
    "dni ASC", "dni DESC",
];

$columnasObrasOrden = [
    "autor ASC", "autor DESC",
    "titulo ASC", "titulo DESC",
    "editorial ASC", "editorial DESC",
];

$columnasPrestamosOrden = [
    "apellidos ASC", "apellidos DESC",
    "autor ASC", "autor DESC",
    "prestado ASC", "prestado DESC",
    "devuelto ASC", "devuelto DESC",
];

// Consultas de borrado y creación de base de datos y tablas, etc.

define("CONSULTA_BORRA_DB", "DROP DATABASE " . MYSQL_DATABASE);

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
        id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
        usuario VARCHAR($tamUsuariosUsuario),
        password VARCHAR($tamUsuariosPasswordCifrado),
        nivel INTEGER
    )",
    // Tabla Personas
    "CREATE TABLE $tablaPersonas (
        id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR($tamPersonasNombre),
        apellidos VARCHAR($tamPersonasApellidos),
        dni VARCHAR($tamPersonasDni)
    )",
    // Tabla Obras
    "CREATE TABLE $tablaObras (
        id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
        autor VARCHAR($tamObrasAutor),
        titulo VARCHAR($tamObrasTitulo),
        editorial VARCHAR($tamObrasEditorial)
    )",
    // Tabla Préstamos
    "CREATE TABLE $tablaPrestamos (
        id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
        id_persona INTEGER NOT NULL,
        id_obra INTEGER NOT NULL,
        prestado DATE,
        devuelto DATE,
        FOREIGN KEY(id_persona) REFERENCES $tablaPersonas(id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY(id_obra) REFERENCES $tablaObras(id) ON DELETE CASCADE ON UPDATE CASCADE
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
        print "    <p>Error: No puede conectarse con la base de datos.</p>\n";
        print "\n";
        print "    <p>Error: " . $e->getMessage() . "</p>\n";
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
        print "    <p>Error al borrar la base de datos.</p>\n";
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
                print "    <p>Error al crear la tabla</p>\n";
                print "\n";
            }
        }
    } else {
        print "    <p>Error al crear la base de datos.</p>\n";
        print "\n";
    }

    $consulta = CONSULTA_INSERTA_USUARIO_ROOT;
    if ($db->query($consulta)) {
        print "    <p>Registro de Usuario " . ROOT_NAME . " creado correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al crear el registro de Usuario " . ROOT_NAME . ".<p>\n";
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
        print "    <p>Error en la consulta.</p>\n";
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
                    print "    <p>Error en la consulta.</p>\n";
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
