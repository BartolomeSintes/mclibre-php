<?php
/**
 * Registro de usuarios 3 - comunes/config.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-05-07
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

define("MYSQL_HOST",               "mysql:host=localhost");        // Nombre de host
define("MYSQL_USER",               "root");                        // Nombre de usuario
define("MYSQL_PASSWORD",           "root");                        // Contraseña de usuario
define("MYSQL_DATABASE",           "mclibre_registro_usuarios_3"); // Nombre de la base de datos
define("MYSQL_TABLA_USUARIOS_WEB", "usuariosweb");                 // Nombre de la tabla

// Configuración para SQLite

define("SQLITE_DATABASE", "/home/barto/mclibre/sqlite/mclibre-registro-usuarios-3.sqlite"); // Ubicación de la base de datos
define("SQLITE_TABLA_USUARIOS_WEB", "usuariosweb");               // Nombre de la tabla

// Configuración Tabla Usuarios de la web

define("MAX_REG_TABLA_USUARIOS_WEB",  20); // Número máximo de registros en la tabla de Usuarios de la web

$tamUsuariosWebUsuario  = 20;  // Tamaño del campo Usuarios de la web > Usuario
$tamUsuariosWebPassword = 20;  // Tamaño del campo Usuarios de la web > Contraseña
$tamUsuariosWebCifrado  = 32;  // Tamaño del campo Usuarios de la web > Contraseña encriptada

$administradorNombre   = "root";  // Nombre del usuario Administrador
$administradorPassword = "root";  // Password del usuario Administrador
// Si $administradorPassword != "", al crearse las tablas, se crea el usuario
// Si $administradorPassword == "", no se crea el usuario
// Lo he hecho para que en el ejemplo colgado en la web la gente pueda entrar
// como Administrador

// Método de envío de formularios

define("FORM_METHOD",    GET);     // Valores posibles: GET o POST
