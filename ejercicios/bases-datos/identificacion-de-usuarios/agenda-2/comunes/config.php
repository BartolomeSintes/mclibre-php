<?php
/**
 * Identificación de usuarios (2) - Agenda (2) - comunes/config.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-12-08
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

// Base de datos utilizada por el programa: MYSQL o SQLITE

$dbMotor = SQLITE;     // Valores posibles: MYSQL o SQLITE

// Configuración para MYSQL

define("MYSQL_HOST", "mysql:host=localhost");    // Nombre de host
define("MYSQL_USER", "");                        // Nombre de usuario
define("MYSQL_PASSWORD", "");                    // Contraseña de usuario
define("MYSQL_DATABASE", "identificacion_2_agenda_2"); // Nombre de la base de datos
define("MYSQL_TABLE", "agenda");                 // Nombre de la tabla

// Configuración para SQLite

define("SQLITE_DATABASE", "/home/barto/mclibre/tmp/mclibre/identificacion-2-agenda-2.sqlite"); // Ubicación de la base de datos
define("SQLITE_TABLE", "agenda");                                                              // Nombre de la tabla

// Configuración Tabla Agenda

define("MAX_REG_TABLE", 20);  // Número máximo de registros en la tabla
$tamNombre    = 40;           // Tamaño de la columna Nombre
$tamApellidos = 60;           // Tamaño de la columna Apellidos
$tamTelefono  = 10;           // Tamaño de la columna Teléfono
$tamCorreo    = 50;           // Tamaño de la columna Correo

// Configuración Usuarios

define("ROOT_NAME", "root");                                                                 // Usuario principal: Nombre
define("ROOT_PASSWORD", "4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2"); // Usuario principal: Contraseña
$tamUsuarioNombre   = 20;           // Tamaño del Nombre de Usuario
$tamUsuarioPassword = 20;           // Tamaño de la Contraseña de Usuario

// Método de envío de formularios

define("FORM_METHOD", GET);         // Valores posibles: GET o POST

// Hoja de estilo

define("COLOR", 27);                // Color básico de la aplicación (0 - 360)

// Nombre de sesión

define("SESSION_NAME", "agenda-2"); // Nombre de sesión
