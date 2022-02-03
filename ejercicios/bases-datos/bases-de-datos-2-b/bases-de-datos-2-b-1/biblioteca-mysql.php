<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// FUNCIONES ESPECÍFICAS DE LA BASE DE DATOS MYSQL

// MYSQL: Nombres de las tablas

$cfg["dbPersonasTabla"] = "$cfg[mysqlDatabase].personas";   // Nombre de la tabla Personas

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

        $consulta = "CREATE TABLE $cfg[dbPersonasTabla]  (
                     id INTEGER UNSIGNED AUTO_INCREMENT,
                     nombre VARCHAR($cfg[dbPersonasTamNombre]),
                     apellidos VARCHAR($cfg[dbPersonasTamApellidos]),
                     telefono VARCHAR($cfg[dbPersonasTamTelefono]),
                     PRIMARY KEY(id)
                     )";

        if (!$pdo->query($consulta)) {
            print "    <p class=\"aviso\">Error al crear la tabla. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } else {
            print "    <p>Tabla creada correctamente.</p>\n";
        }
    }
}
