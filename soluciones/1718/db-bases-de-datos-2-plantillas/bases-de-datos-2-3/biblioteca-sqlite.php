<?php
/**
 * Bases de datos 2-3 - biblioteca-sqlite.php
 *
 * @author    Escriba su nombre
 *
 */

// Variables globales

$dbDb    = SQLITE_DATABASE;   // Nombre de la base de datos
$dbTabla = SQLITE_TABLA;      // Nombre de la tabla

// Consultas

$consultaCreaTabla = "CREATE TABLE $dbTabla (
    id INTEGER PRIMARY KEY,
    nombre VARCHAR($tamNombre),
    apellidos VARCHAR($tamApellidos),
    telefono VARCHAR($tamTelefono),
    correo VARCHAR($tamCorreo)
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
