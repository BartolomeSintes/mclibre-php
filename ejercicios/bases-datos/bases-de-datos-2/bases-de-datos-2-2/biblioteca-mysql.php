<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// Configuración específica para MYSQL

// Configuración general

define("MYSQL_HOST", "mysql:host=localhost");        // Nombre de host
define("MYSQL_USER", "");                            // Nombre de usuario
define("MYSQL_PASSWORD", "");                        // Contraseña de usuario
define("MYSQL_DATABASE", "mclibre_base_datos_2_2");  // Nombre de la base de datos
define("MYSQL_TABLE_AGENDA", "agenda");              // Nombre de la tabla Agenda

// Nombres de las tablas

$tablaAgenda = MYSQL_DATABASE . "." . MYSQL_TABLE_AGENDA;  // Nombre de la tabla Agenda

// Valores de ordenación de las tablas

$columnasAgendaOrden = [
    "nombre ASC", "nombre DESC",
    "apellidos ASC", "apellidos DESC",
];

// Consultas de borrado y creación de base de datos y tablas, etc.

define("CONSULTA_BORRA_DB", "DROP DATABASE " . MYSQL_DATABASE);

define(
    "CONSULTA_CREA_DB",
    "CREATE DATABASE " . MYSQL_DATABASE . "
        CHARACTER SET utf8mb4
        COLLATE utf8mb4_unicode_ci"
);

$consultaCreaTabla = "CREATE TABLE $tablaAgenda (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR($tamAgendaNombre),
    apellidos VARCHAR($tamAgendaApellidos),
    PRIMARY KEY(id)
    )";

// Funciones específicas de bases de datos (MYSQL)

function conectaDb()
{
    try {
        $tmp = new PDO(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
        $tmp->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $tmp->exec("set names utf8mb4");
        return $tmp;
    } catch (PDOException $e) {
        cabecera("Error grave", MENU_PRINCIPAL);
        print "    <p>Error: No puede conectarse con la base de datos.</p>\n";
        print "\n";
        print "    <p>Error: " . $e->getMessage() . "</p>\n";
        pie();
        exit();
    }
}

function borraTodo($db, $nombreTabla, $consultaCreacionTabla)
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
        $consulta = $consultaCreacionTabla;
        if ($db->query($consulta)) {
            print "    <p>Tabla creada correctamente.</p>\n";
            print "\n";
        } else {
            print "    <p>Error al crear la tabla.</p>\n";
            print "\n";
        }
    } else {
        print "    <p>Error al crear la base de datos.</p>\n";
        print "\n";
    }
}
