<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// Base de datos utilizada por la aplicación: MYSQL o SQLITE

$dbMotor = SQLITE;                 // Valores posibles: MYSQL o SQLITE

// Configuración Tabla Personas

define("MAX_REG_TABLE_AGENDA", 20);  // Número máximo de registros en la tabla Agenda
$tamAgendaNombre    = 40;          // Tamaño de la columna Personas > Nombre
$tamAgendaApellidos = 60;          // Tamaño de la columna Personas > Apellidos
$tamAgendaTelefono  = 10;          // Tamaño de la columna Personas > Teléfono
$tamAgendaCorreo    = 50;          // Tamaño de la columna Personas > Correo

// Método de envío de formularios

define("FORM_METHOD", GET);          // Valores posibles: GET o POST

// Hoja de estilo

define("COLOR", 27);                 // Color básico de la aplicación (0 - 360)
