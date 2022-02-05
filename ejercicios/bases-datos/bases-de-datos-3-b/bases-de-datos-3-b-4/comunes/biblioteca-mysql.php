<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// FUNCIONES ESPECÍFICAS DE LA BASE DE DATOS MYSQL

// MYSQL: Nombres de las tablas

$cfg["dbPersonasTabla"] = "$cfg[mysqlDatabase].personas";   // Nombre de la tabla Personas
$cfg["dbUsuariosTabla"] = "$cfg[mysqlDatabase].usuarios";   // Nombre de la tabla Usuarios

// MYSQL: Conexión con la base de datos

function conectaDb()
{
    global $cfg;

    try {
        $tmp = new PDO($cfg["mysqlHost"], $cfg["mysqlUser"], $cfg["mysqlPassword"]);
        $tmp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $tmp->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $tmp->exec("set names utf8mb4");
        return $tmp;
    } catch (PDOException $e) {
        print "    <p class=\"aviso\">Error: No puede conectarse con la base de datos. {$e->getMessage()}</p>\n";
        exit;
    }
}

// MYSQL: Borrado y creación de base de datos y tablas

function borraTodo()
{
    global $pdo, $cfg;

    print "    <p>Sistema Gestor de Bases de Datos: MySQL.</p>\n";
    print "\n";

    $consulta = "DROP DATABASE IF EXISTS $cfg[mysqlDatabase]";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al borrar la base de datos. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Base de datos borrada correctamente (si existía).</p>\n";
    }
    print "\n";

    $consulta = "CREATE DATABASE $cfg[mysqlDatabase]
                 CHARACTER SET utf8mb4
                 COLLATE utf8mb4_unicode_ci";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al crear la base de datos. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Base de datos creada correctamente.</p>\n";
        print "\n";

        $consulta = "CREATE TABLE $cfg[dbUsuariosTabla]  (
                     id INTEGER UNSIGNED AUTO_INCREMENT,
                     usuario VARCHAR($cfg[dbUsuariosTamUsuario]),
                     password VARCHAR($cfg[dbUsuariosTamPassword]),
                     nivel INTEGER NOT NULL,
                     PRIMARY KEY(id)
                     )";

        if (!$pdo->query($consulta)) {
            print "    <p class=\"aviso\">Error al crear la tabla Usuarios. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } else {
            print "    <p>Tabla Usuarios creada correctamente.</p>\n";
            print "\n";

            $consulta = "INSERT INTO $cfg[dbUsuariosTabla]
                         (id, usuario, password, nivel)
                         VALUES (1, '$cfg[rootName]', '$cfg[rootPassword]', " . NIVEL_ADMINISTRADOR . ")";

            if (!$pdo->query($consulta)) {
                print "    <p class=\"aviso\">Error al insertar el registro de usuario. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } else {
                print "    <p>Registro de usuario creado correctamente.</p>\n";
            }
        }
        print "\n";

        $consulta = "CREATE TABLE $cfg[dbPersonasTabla]  (
                     id INTEGER UNSIGNED AUTO_INCREMENT,
                     nombre VARCHAR($cfg[dbPersonasTamNombre]),
                     apellidos VARCHAR($cfg[dbPersonasTamApellidos]),
                     telefono VARCHAR($cfg[dbPersonasTamTelefono]),
                     correo VARCHAR($cfg[dbPersonasTamCorreo]),
                     id_usuario INTEGER UNSIGNED,
                     FOREIGN KEY(id_usuario) REFERENCES $cfg[dbUsuariosTabla](id) ON DELETE CASCADE ON UPDATE CASCADE,
                     PRIMARY KEY(id)
                     )";

        if (!$pdo->query($consulta)) {
            print "    <p class=\"aviso\">Error al crear la tabla Personas. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } else {
            print "    <p>Tabla Personas creada correctamente.</p>\n";
        }
    }
}

// MYSQL: Comprobación de existencia de las tablas

function existenTablas()
{
    global $pdo, $cfg;

    $existe = true;

    $consulta = "SELECT COUNT(*) FROM information_schema.schemata WHERE schema_name = '$cfg[mysqlDatabase]'";

    $resultado = $pdo->query($consulta);
    if (!$resultado) {
        $existe = false;
        print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        print "\n";
    } else {
        if ($resultado->fetchColumn() == 0) {
            $existe = false;
        } else {
            foreach ($cfg["dbTablas"] as $tabla) {
                // En information_schema.tables los nombres de las tablas no llevan el nombre
                // de la base de datos, así que lo elimino
                $tabla = str_replace("$cfg[mysqlDatabase].", "", $tabla);

                $consulta = "SELECT COUNT(*) FROM information_schema.tables
                             WHERE table_schema = '$cfg[mysqlDatabase]'
                             AND table_name = '$tabla'";

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
        }
    }
    return $existe;
}
