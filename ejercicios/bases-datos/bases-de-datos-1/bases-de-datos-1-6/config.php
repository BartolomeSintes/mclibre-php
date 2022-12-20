<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// OPCIONES DISPONIBLES PARA EL ADMINISTRADOR DE LA APLICACIÓN

// Base de datos utilizada por la aplicación

$cfg["dbMotor"] = SQLITE;                                   // Valores posibles: MYSQL o SQLITE

// Configuración para SQLite

$cfg["sqliteDatabase"] = "/tmp/mclibre-base-datos-1-6.sqlite";  // Ubicación de la base de datos

// Configuración para MySQL

$cfg["mysqlHost"]     = "localhost";                        // Nombre de host
$cfg["mysqlUser"]     = "mclibre_base_datos_1_6";           // Nombre de usuario
$cfg["mysqlPassword"] = "";                                 // Contraseña de usuario
$cfg["mysqlDatabase"] = "mclibre_base_datos_1_6";           // Nombre de la base de datos

// Tamaño de los campos en la tabla Personas

$cfg["tablaPersonasTamNombre"]    = 40;                     // Tamaño de la columna Personas > Nombre
$cfg["tablaPersonasTamApellidos"] = 60;                     // Tamaño de la columna Personas > Apellidos

// Tamaño de los controles en los formularios

$cfg["formPersonasTamNombre"]    = $cfg["tablaPersonasTamNombre"];     // Tamaño de la caja de texto Personas > Nombre
$cfg["formPersonasTamApellidos"] = $cfg["tablaPersonasTamApellidos"];  // Tamaño de la caja de texto Personas > Apellidos

// Método de envío de formularios

$cfg["formMethod"] = "get";                                 // Valores posibles: get o post
