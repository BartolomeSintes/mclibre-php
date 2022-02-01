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

$cfg["sqliteDatabase"] = "/tmp/iaw-agenda.sqlite";          // Ubicación de la base de datos

// Configuración para MySQL

$cfg["mysqlHost"]     = "mysql:host=localhost";             // Nombre de host
$cfg["mysqlUser"]     = "iaw_agenda";                       // Nombre de usuario
$cfg["mysqlPassword"] = "";                                 // Contraseña de usuario
$cfg["mysqlDatabase"] = "iaw_agenda";                       // Nombre de la base de datos

// Configuración de la tabla Personas

$cfg["dbPersonasTamNombre"]    = 40;                        // Tamaño de la columna Personas > Nombre
$cfg["dbPersonasTamApellidos"] = 60;                        // Tamaño de la columna Personas > Apellidos
$cfg["dbPersonasTamTelefono"]  = 10;                        // Tamaño de la columna Personas > Teléfono
$cfg["dbPersonasTamCorreo"]    = 50;                        // Tamaño de la columna Personas > Correo

// Número máximo de registros en las tablas

$cfg["dbPersonasMaxReg"] = 20;                              // Número máximo de registros en la tabla Personas

// Método de envío de formularios

$cfg["formMethod"] = "get";                                 // Valores posibles: get o post
