<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// FUNCIONES ESPECÍFICAS DE LA BASE DE DATOS SQLITE

// SQLITE: Conexión con la base de datos

function conectaDb()
{
    global $cfg;

    if (!is_dir(dirname($cfg["sqliteDatabase"]))) {
        print "    <p class=\"aviso\">Error: El directorio <strong>" . dirname($cfg["sqliteDatabase"]) . "</strong> no está disponible.</p>\n";
        exit;
    }

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

    $consulta = "DROP TABLE IF EXISTS $cfg[tablaUsuarios]";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al borrar la tabla Usuarios. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla Usuarios borrada correctamente (si existía).</p>\n";
    }
    print "\n";

    $consulta = "DROP TABLE IF EXISTS $cfg[tablaPersonas]";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al borrar la tabla Personas. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla Personas borrada correctamente (si existía).</p>\n";
    }
    print "\n";

    $consulta = "CREATE TABLE $cfg[tablaUsuarios] (
                 id INTEGER PRIMARY KEY,
                 usuario VARCHAR($cfg[tablaUsuariosTamUsuario]),
                 password VARCHAR($cfg[tablaUsuariosTamPassword]),
                 nivel INTEGER,
                 conexiones INTEGER
                 )";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al crear la tabla $cfg[tablaUsuarios]. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla Usuarios creada correctamente.</p>\n";
        print "\n";

        $consulta = "INSERT INTO $cfg[tablaUsuarios]
                     (id, usuario, password, nivel, conexiones)
                     VALUES (1, '$cfg[rootName]', '$cfg[rootPassword]', " . NIVEL_ADMINISTRADOR . ", 0)";

        if (!$pdo->query($consulta)) {
            print "    <p class=\"aviso\">Error al insertar el registro de usuario. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } else {
            print "    <p>Registro de usuario creado correctamente.</p>\n";
        }
    }
    print "\n";

    $consulta = "CREATE TABLE $cfg[tablaPersonas] (
                 id INTEGER PRIMARY KEY,
                 nombre VARCHAR($cfg[tablaPersonasTamNombre]) COLLATE NOCASE,
                 apellidos VARCHAR($cfg[tablaPersonasTamApellidos]) COLLATE NOCASE,
                 telefono VARCHAR($cfg[tablaPersonasTamTelefono]) COLLATE NOCASE,
                 correo VARCHAR($cfg[tablaPersonasTamCorreo]) COLLATE NOCASE
                 )";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al crear la tabla $cfg[tablaPersonas]. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
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
