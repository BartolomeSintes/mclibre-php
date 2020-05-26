<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// Configuración específica para SQLite

// Configuración general

define("SQLITE_DATABASE", "/home/barto/mclibre/tmp/mclibre/biblioteca.sqlite");  // Ubicación de la base de datos
define("SQLITE_TABLE_USUARIOS", "usuarios");                                     // Nombre de la tabla Usuarios
define("SQLITE_TABLE_PERSONAS", "personas");                                     // Nombre de la tabla Personas
define("SQLITE_TABLE_OBRAS", "obras");                                           // Nombre de la tabla Obras
define("SQLITE_TABLE_PRESTAMOS", "prestamos");                                   // Nombre de la tabla Préstamos

// Nombres de las tablas

$tablaUsuarios  = SQLITE_TABLE_USUARIOS;   // Nombre de la tabla Usuarios
$tablaPersonas  = SQLITE_TABLE_PERSONAS;   // Nombre de la tabla Personas
$tablaObras     = SQLITE_TABLE_OBRAS;      // Nombre de la tabla Obras
$tablaPrestamos = SQLITE_TABLE_PRESTAMOS;  // Nombre de la tabla Préstamos

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
    "nivel ASC", "nivel DESC",
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
    // Tabla Personas
    "CREATE TABLE $tablaPersonas (
        id INTEGER PRIMARY KEY,
        nombre VARCHAR($tamPersonasNombre),
        apellidos VARCHAR($tamPersonasApellidos),
        dni VARCHAR($tamPersonasDni)
    )",
    // Tabla Obras
    "CREATE TABLE $tablaObras (
        id INTEGER PRIMARY KEY,
        autor VARCHAR($tamObrasAutor),
        titulo VARCHAR($tamObrasTitulo),
        editorial VARCHAR($tamObrasEditorial)
    )",
    // Tabla Préstamos
    "CREATE TABLE $tablaPrestamos (
        id INTEGER PRIMARY KEY,
        id_persona INTEGER UNSIGNED,
        id_obra INTEGER UNSIGNED,
        prestado DATE,
        devuelto DATE,
        FOREIGN KEY(id_persona) REFERENCES $tablaPersonas(id) ON DELETE CASCADE ON UPDATE CASCADE
        FOREIGN KEY(id_obra) REFERENCES $tablaObras(id) ON DELETE CASCADE ON UPDATE CASCADE
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
