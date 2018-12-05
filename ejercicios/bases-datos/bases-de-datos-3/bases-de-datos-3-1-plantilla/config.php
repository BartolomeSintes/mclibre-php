<?php
/**
 * Bases de datos 3-1 - config.php
 *
 * @author    Escriba su nombre
 *
 */

// Base de datos utilizada por el programa: MYSQL o SQLITE

$dbMotor = SQLITE;     // Valores posibles: MYSQL o SQLITE

// Configuración para MYSQL

define("MYSQL_HOST",     "mysql:host=localhost");   // Nombre de host
define("MYSQL_USER",     "root");                   // Nombre de usuario
define("MYSQL_PASSWORD", "");                       // Contraseña de usuario
define("MYSQL_DATABASE", "mclibre_base_datos_3_1"); // Nombre de la base de datos
define("MYSQL_TABLA",    "tabla");                  // Nombre de la tabla

// Configuración para SQLite

define("SQLITE_DATABASE", "/home/barto/mclibre/tmp/mclibre/mclibre-base-datos-3-1.sqlite"); // Ubicación de la base de datos
define("SQLITE_TABLA",   "tabla");                                       // Nombre de la tabla

// Configuración Tabla Agenda

define("MAX_REG_TABLA",  20); // Número máximo de registros en la tabla
$tamNombre    = 40;           // Tamaño de la columna Nombre
$tamApellidos = 60;           // Tamaño de la columna Apellidos

// Método de envío de formularios

define("FORM_METHOD",    GET);     // Valores posibles: GET o POST
