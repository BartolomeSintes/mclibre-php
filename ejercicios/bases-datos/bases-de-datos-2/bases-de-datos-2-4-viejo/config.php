<?php
/**
 * Bases de datos 2-4 - config.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-12-12
 * @link      http://www.mclibre.org
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

define("SESION_NOMBRE", "agenda");     // Nombre de la sesión

// Base de datos utilizada por el programa: MYSQL o SQLITE

$dbMotor = SQLITE;     // Valores posibles: MYSQL o SQLITE

// Configuración para MYSQL

define("MYSQL_HOST", "mysql:host=localhost");        // Nombre de host
define("MYSQL_USER", "root");                        // Nombre de usuario
define("MYSQL_PASSWORD", "");                        // Contraseña de usuario
define("MYSQL_DATABASE", "mclibre_base_datos_2_4");  // Nombre de la base de datos
define("MYSQL_TABLE_AGENDA", "tabla");               // Nombre de la tabla

// Configuración para SQLite

define("SQLITE_DATABASE", "/home/barto/mclibre/tmp/mclibre/mclibre-base-datos-2-4.sqlite"); // Ubicación de la base de datos
define("SQLITE_TABLA", "tabla");                                       // Nombre de la tabla

// Configuración Tabla Agenda

define("MAX_REG_TABLA", 20);  // Número máximo de registros en la tabla
$tamAgendaNombre    = 40;           // Tamaño de la columna Nombre
$tamAgendaApellidos = 60;           // Tamaño de la columna Apellidos
$tamAgendaTelefono  = 10;           // Tamaño de la columna Teléfono
$tamAgendaCorreo    = 50;           // Tamaño de la columna Correo

// Método de envío de formularios

define("FORM_METHOD", GET);   // Valores posibles: GET o POST

// Hoja de estilo

define("COLOR", 27);          // Color básico de la aplicación (0 - 360)
