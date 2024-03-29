<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// FUNCIONES ESPECÍFICAS DE LA BASE DE DATOS pgsql

// POSTGRESQL: Conexión con la base de datos

function conectaDb()
{
    global $cfg;

    try {
        $tmp = new PDO("pgsql:host=$cfg[pgsqlHost];port=$cfg[pgsqlPort];dbname=$cfg[pgsqlDatabase];user=$cfg[pgsqlUser];password=$cfg[pgsqlPassword]");
        $tmp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        return $tmp;
    } catch (PDOException $e) {
        print "    <p class=\"aviso\">Error: No puede conectarse con la base de datos. {$e->getMessage()}</p>\n";
        exit;
    }
}

// POSTGRESQL: Borrado y creación de tablas

function borraTodo()
{
    global $pdo, $cfg;

    print "    <p>Sistema Gestor de Bases de Datos: PostgreSQL.</p>\n";
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
                 id SERIAL PRIMARY KEY,
                 usuario VARCHAR($cfg[tablaUsuariosTamUsuario]),
                 password VARCHAR($cfg[tablaUsuariosTamPassword]),
                 nivel INTEGER NOT NULL
                 )";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al crear la tabla $cfg[tablaUsuarios]. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla Usuarios creada correctamente.</p>\n";
        print "\n";

        $consulta = "INSERT INTO $cfg[tablaUsuarios]
                     (id, usuario, password, nivel)
                     VALUES (1, '$cfg[rootName]', '$cfg[rootPassword]', " . NIVEL_ADMINISTRADOR . ")";

        if (!$pdo->query($consulta)) {
            print "    <p class=\"aviso\">Error al insertar el registro de usuario. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } else {
            print "    <p>Registro de usuario creado correctamente.</p>\n";
        }
    }
    print "\n";

    $consulta = "CREATE TABLE $cfg[tablaPersonas] (
                 id SERIAL PRIMARY KEY,
                 nombre VARCHAR($cfg[tablaPersonasTamNombre]),
                 apellidos VARCHAR($cfg[tablaPersonasTamApellidos]),
                 telefono VARCHAR($cfg[tablaPersonasTamTelefono]),
                 correo VARCHAR($cfg[tablaPersonasTamCorreo])
                 )";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al crear la tabla $cfg[tablaPersonas]. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla Personas creada correctamente.</p>\n";
    }
}

// POSTGRESQL: Comprobación de existencia de las tablas

function existenTablas()
{
    global $pdo, $cfg;

    $existe = true;

    foreach ($cfg["dbTablas"] as $tabla) {
        $consulta = "SELECT COUNT(*) FROM information_schema.tables WHERE table_name='$tabla'";

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
