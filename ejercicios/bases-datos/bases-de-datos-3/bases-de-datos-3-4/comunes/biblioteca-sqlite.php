<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// OPCIONES DISPONIBLES PARA EL PROGRAMADOR DE LA APLICACIÓN

// Base de datos

$cfg["dbPersonasTabla"] = "personas";                       // Nombre de la tabla Personas
$cfg["dbUsuariosTabla"] = "usuarios";                       // Nombre de la tabla Usuarios

// Funciones específicas de bases de datos (SQLite)

// SQLITE: CONEXIÓN CON LA BASE DE DATOS

function conectaDb()
{
    global $cfg;

    try {
        $tmp = new PDO("sqlite:$cfg[sqliteDatabase]");
        $tmp->query("PRAGMA foreign_keys = ON");
        $tmp->query("PRAGMA encoding = 'UTF-8'");
        return $tmp;
    } catch (PDOException $e) {
        print "    <p class=\"aviso\">Error: No puede conectarse con la base de datos / {$e->getMessage()}</p>\n";
        exit;
    }
}

// SQLITE: CONSULTAS DE BORRADO Y CREACiÓN DE TABLA

function borraTodo()
{
    global $pdo, $cfg;

    $consulta = "DROP TABLE IF EXISTS $cfg[dbUsuariosTabla]";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al borrar la tabla Usuarios / {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla Usuarios borrada correctamente (si existía).</p>\n";
    }
    print "\n";

    $consulta = "DROP TABLE IF EXISTS $cfg[dbPersonasTabla]";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al borrar la tabla Personas / {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla Personas borrada correctamente (si existía).</p>\n";
    }
    print "\n";

    $consulta = "CREATE TABLE $cfg[dbUsuariosTabla]  (
                 id INTEGER PRIMARY KEY,
                 usuario VARCHAR($cfg[dbUsuariosTamUsuario]),
                 password VARCHAR($cfg[dbUsuariosTamPassword]),
                 nivel INTEGER
                 )";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al crear la tabla Usuarios / {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla Usuarios creada correctamente.</p>\n";

        $consulta = "INSERT INTO $cfg[dbUsuariosTabla]
                     (usuario, password, nivel)
                     VALUES ('$cfg[rootName]', '$cfg[rootPassword]', " . $cfg["usuariosNiveles"]["Administrador"] . ")";

        if (!$pdo->query($consulta)) {
            print "    <p class=\"aviso\">Error al insertar el registro de usuario / {$pdo->errorInfo()[2]}</p>\n";
        } else {
            print "    <p>Registro de usuario creado correctamente.</p>\n";
        }
    }

    $consulta = "CREATE TABLE $cfg[dbPersonasTabla]  (
                 id INTEGER PRIMARY KEY,
                 nombre VARCHAR($cfg[dbPersonasTamNombre]),
                 apellidos VARCHAR($cfg[dbPersonasTamApellidos]),
                 telefono VARCHAR($cfg[dbPersonasTamTelefono]),
                 correo VARCHAR($cfg[dbPersonasTamCorreo])
                 )";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al crear la tabla Personas / {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla Personas creada correctamente.</p>\n";
    }
}

function existenTablas()
{
    global $pdo, $cfg;

    $existe = true;

    foreach ($cfg["dbTablas"] as $tabla) {
        $consulta  = "SELECT count(*) FROM sqlite_master WHERE type='table' AND name='$tabla'";
        $resultado = $pdo->query($consulta);

        if (!$resultado) {
            $existe = false;
            print "    <p class=\"aviso\">Error en la consulta.</p>\n";
            print "\n";
        } else {
            if ($resultado->fetchColumn() == 0) {
                $existe = false;
            }
        }
    }
    return $existe;
}