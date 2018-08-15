<?php
/**
 * Bases de datos 2-1 - biblioteca-sqlite.php
 *
 * @author    Escriba su nombre
 *
 */

// Constantes y variables globales

// Constantes

// Variables globales
$dbDb    = "/home/barto/mclibre/tmp/mclibre/mclibre-base-datos-2-1.sqlite";  // Nombre de la base de datos
$dbTabla = "tabla";                                       // Nombre de la tabla

// Consultas
$consultaCreaTabla = "CREATE TABLE $dbTabla (
    id INTEGER PRIMARY KEY,
    nombre VARCHAR($tamNombre),
    apellidos VARCHAR($tamApellidos)
    )";

// Funciones comunes de bases de datos (SQLITE)

function conectaDb()
{
    global $dbDb;

    try {
        $tmp = new PDO("sqlite:" . $dbDb);
        return($tmp);
    } catch(PDOException $e) {
        cabecera("Error grave", MENU_PRINCIPAL);
        print "    <p>Error: No puede conectarse con la base de datos.</p>\n";
        print "\n";
        print "    <p>Error: " . $e->getMessage() . "</p>\n";
        print "\n";
        pie();
        exit();
    }
}

function borraTodo($db)
{
    global $dbTabla, $consultaCreaTabla;

    $consulta = "DROP TABLE $dbTabla";
    if ($db->query($consulta)) {
        print "    <p>Tabla borrada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al borrar la tabla.</p>\n";
        print "\n";
    }
    $consulta = $consultaCreaTabla;
    if ($db->query($consulta)) {
        print "    <p>Tabla creada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al crear la tabla.</p>\n";
        print "\n";
    }
}
