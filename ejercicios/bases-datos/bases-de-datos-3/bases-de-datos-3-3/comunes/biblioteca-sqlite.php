<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// FUNCIONES ESPECÍFICAS DE LA BASE DE DATOS SQLITE

// SQLITE: Nombres de las tablas

$cfg["dbPersonasTabla"] = "personas";                       // Nombre de la tabla Personas
$cfg["dbUsuariosTabla"] = "usuarios";                       // Nombre de la tabla Usuarios

// SQLITE: Conexión con la base de datos

function conectaDb()
{
    global $cfg;

    try {
        $tmp = new PDO("sqlite:$cfg[sqliteDatabase]");
        $tmp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $tmp->query("PRAGMA foreign_keys = ON");
        $tmp->query("PRAGMA encoding = 'UTF-8'");
        return $tmp;
    } catch (PDOException $e) {
        print "    <p class=\"aviso\">Error: No puede conectarse con la base de datos. {$e->getMessage()}</p>\n";
        exit;
    }
}

// SQLITE: Borrado y creación de tablas

function borraTodo()
{
    global $pdo, $cfg;

    print "    <p>Sistema Gestor de Bases de Datos: SQLite.</p>\n";
    print "\n";

    $consulta = "DROP TABLE IF EXISTS $cfg[dbUsuariosTabla]";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al borrar la tabla Usuarios. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla Usuarios borrada correctamente (si existía).</p>\n";
    }
    print "\n";

    $consulta = "DROP TABLE IF EXISTS $cfg[dbPersonasTabla]";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al borrar la tabla Personas. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla Personas borrada correctamente (si existía).</p>\n";
    }
    print "\n";

    $consulta = "CREATE TABLE $cfg[dbUsuariosTabla]  (
                 id INTEGER PRIMARY KEY,
                 usuario VARCHAR($cfg[dbUsuariosTamUsuario]),
                 password VARCHAR($cfg[dbUsuariosTamPassword])
                 )";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al crear la tabla Usuarios. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla Usuarios creada correctamente.</p>\n";
        print "\n";

        $consulta = "INSERT INTO $cfg[dbUsuariosTabla]
                     (id, usuario, password)
                     VALUES (1, '$cfg[rootName]', '$cfg[rootPassword]')";

        if (!$pdo->query($consulta)) {
            print "    <p class=\"aviso\">Error al insertar el registro de usuario. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } else {
            print "    <p>Registro de usuario creado correctamente.</p>\n";
        }
    }
    print "\n";

    $consulta = "CREATE TABLE $cfg[dbPersonasTabla]  (
                 id INTEGER PRIMARY KEY,
                 nombre VARCHAR($cfg[dbPersonasTamNombre]) COLLATE NOCASE,
                 apellidos VARCHAR($cfg[dbPersonasTamApellidos]) COLLATE NOCASE,
                 telefono VARCHAR($cfg[dbPersonasTamTelefono]) COLLATE NOCASE,
                 correo VARCHAR($cfg[dbPersonasTamCorreo]) COLLATE NOCASE
                 )";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al crear la tabla Personas. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla Personas creada correctamente.</p>\n";
    }
}

// SQLITE: Comprobación de existencia de las tablas

function existenTablas()
{
    global $pdo, $cfg;

    $existe = true;

    foreach ($cfg["dbTablas"] as $tabla) {
        $consulta = "SELECT COUNT(*) FROM sqlite_master WHERE type = 'table' AND name = '$tabla'";

        $resultado = $pdo->query($consulta);
        if (!$resultado) {
            $existe = false;
            print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            print "\n";
        } else {
            if ($resultado->fetchColumn() == 0) {
                $existe = false;
            }
        }
    }
    return $existe;
}
