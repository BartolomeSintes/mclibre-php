<?php
/**
 * Bases de datos 2-3 - config.php
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
define("MYSQL_DATABASE", "mclibre_base_datos_2_3"); // Nombre de la base de datos
define("MYSQL_TABLA",    "tabla");                  // Nombre de la tabla

// Configuración para SQLite

define("SQLITE_DATABASE", "/tmp/mclibre/mclibre-base-datos-2-3.sqlite"); // Ubicación de la base de datos
define("SQLITE_TABLA",   "tabla");                                       // Nombre de la tabla

// Configuración Tabla Agenda

define("MAX_REG_TABLA",  20); // Número máximo de registros en la tabla
$tamNombre    = 40;           // Tamaño de la columna Nombre
$tamApellidos = 60;           // Tamaño de la columna Apellidos
$tamTelefono  = 10;           // Tamaño de la columna Teléfono
$tamCorreo    = 50;           // Tamaño de la columna Correo

// Método de envío de formularios

define("FORM_METHOD",    GET);     // Valores posibles: GET o POST
