<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// FUNCIONES ESPECÍFICAS DE LA BASE DE DATOS MYSQL

// MYSQL: Conexión con la base de datos

function conectaDb()
{
    global $cfg;

    try {
        $tmp = new PDO("mysql:host=$cfg[mysqlHost];dbname=$cfg[mysqlDatabase];charset=utf8mb4", $cfg["mysqlUser"], $cfg["mysqlPassword"]);
    } catch (PDOException $e) {
        $tmp = new PDO("mysql:host=$cfg[mysqlHost];charset=utf8mb4", $cfg["mysqlUser"], $cfg["mysqlPassword"]);
    } catch (PDOException $e) {
        print "    <p class=\"aviso\">Error: No puede conectarse con la base de datos. {$e->getMessage()}</p>\n";
        exit;
    } finally {
        $tmp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $tmp->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        return $tmp;
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

        $consulta = "USE $cfg[mysqlDatabase]";

        if (!$pdo->query($consulta)) {
            print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } else {
            print "    <p>Base de datos seleccionada correctamente.</p>\n";
            print "\n";

            $consulta = "CREATE TABLE $cfg[tablaUsuarios] (
                         id INTEGER UNSIGNED AUTO_INCREMENT,
                         usuario VARCHAR($cfg[tablaUsuariosTamUsuario]),
                         password VARCHAR($cfg[tablaUsuariosTamPassword]),
                         correo VARCHAR($cfg[tablaUsuariosTamCorreo]),
                         nivel INTEGER NOT NULL,
                         PRIMARY KEY(id)
                         )";

            if (!$pdo->query($consulta)) {
                print "    <p class=\"aviso\">Error al crear la tabla $cfg[tablaUsuarios]. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } else {
                print "    <p>Tabla Usuarios creada correctamente.</p>\n";
                print "\n";

                $consulta = "INSERT INTO $cfg[tablaUsuarios]
                             (id, usuario, password, correo, nivel)
                             VALUES (1, '$cfg[rootName]', '$cfg[rootPassword]', '$cfg[rootCorreo]', " . NIVEL_ADMINISTRADOR . ")";

                if (!$pdo->query($consulta)) {
                    print "    <p class=\"aviso\">Error al insertar el registro de usuario. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
                } else {
                    print "    <p>Registro de usuario creado correctamente.</p>\n";
                }
            }
            print "\n";

            $consulta = "CREATE TABLE $cfg[tablaPersonas] (
                         id INTEGER UNSIGNED AUTO_INCREMENT,
                         nombre VARCHAR($cfg[tablaPersonasTamNombre]),
                         apellidos VARCHAR($cfg[tablaPersonasTamApellidos]),
                         telefono VARCHAR($cfg[tablaPersonasTamTelefono]),
                         correo VARCHAR($cfg[tablaPersonasTamCorreo]),
                         PRIMARY KEY(id)
                         )";

            if (!$pdo->query($consulta)) {
                print "    <p class=\"aviso\">Error al crear la tabla $cfg[tablaPersonas]. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } else {
                print "    <p>Tabla Personas creada correctamente.</p>\n";
            }
            print "\n";
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
