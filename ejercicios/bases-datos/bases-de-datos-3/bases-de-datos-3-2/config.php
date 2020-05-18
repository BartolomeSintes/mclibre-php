<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// Base de datos utilizada por la aplicación: MYSQL o SQLITE

$dbMotor = SQLITE;                   // Valores posibles: MYSQL o SQLITE

// Configuración Tabla Agenda

define("MAX_REG_TABLE_AGENDA", 20);  // Número máximo de registros en la tabla Agenda
$tamAgendaNombre    = 40;            // Tamaño de la columna Agenda > Nombre
$tamAgendaApellidos = 60;            // Tamaño de la columna Agenda > Apellidos
$tamAgendaTelefono  = 10;            // Tamaño de la columna Agenda > Teléfono

// Método de envío de formularios

define("FORM_METHOD", GET);          // Valores posibles: GET o POST

// Hoja de estilo

define("COLOR", 27);                 // Color básico de la aplicación (0 - 360)
