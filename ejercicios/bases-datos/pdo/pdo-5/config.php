<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// Variables configurables por el administrador de la aplicación

// Base de datos utilizada por la aplicación

$cfg["dbMotor"] = SQLITE;                               // Valores posibles: MYSQL o SQLITE

// Configuración para SQLite

$cfg["sqliteDatabase"] = "/tmp/pdo-5.sqlite";           // Ubicación de la base de datos

// Configuración para MySQL

$cfg["mysqlHost"]     = "localhost";                    // Nombre de host
$cfg["mysqlUser"]     = "";                             // Nombre de usuario
$cfg["mysqlPassword"] = "";                             // Contraseña de usuario
$cfg["mysqlDatabase"] = "";                             // Nombre de la base de datos

// Tamaño de los campos en la tabla Personas

$cfg["tablaPersonasTamNombre"]    = 40;                 // Tamaño de la columna Personas > Nombre
$cfg["tablaPersonasTamApellidos"] = 60;                 // Tamaño de la columna Personas > Apellidos
