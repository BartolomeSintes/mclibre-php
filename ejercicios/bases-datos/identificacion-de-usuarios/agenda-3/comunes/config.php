<?php
/**
 * Identificación de usuarios - Agenda (3) - comunes/config.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-12-11
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

// Base de datos utilizada por la aplicación: MYSQL o SQLITE

$dbMotor = SQLITE;                   // Valores posibles: MYSQL o SQLITE

// Configuración Tabla Agenda

define("MAX_REG_TABLE_AGENDA", 20);  // Número máximo de registros en la tabla Agenda
$tamAgendaNombre    = 40;            // Tamaño de la columna Agenda > Nombre
$tamAgendaApellidos = 60;            // Tamaño de la columna Agenda > Apellidos
$tamAgendaTelefono  = 10;            // Tamaño de la columna Agenda > Teléfono
$tamAgendaCorreo    = 50;            // Tamaño de la columna Agenda > Correo

// Configuración Tabla Usuarios

define("MAX_REG_TABLE_USUARIOS", 20);  // Número máximo de registros en la tabla Usuarios
$tamUsuariosUsuario         = 20;      // Tamaño de la columna Usuarios > Nombre de Usuario
$tamUsuariosPasswordCifrado = 64;      // Tamaño de la columna Usuarios > Contraseña de Usuario cifrada
$tamUsuariosPassword        = 20;      // Tamaño de la Contraseña de Usuario en el formulario

// Usuario inicial

define("ROOT_NAME", "root");                                                                  // Usuario inicial: Nombre
define("ROOT_PASSWORD", "4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2");  // Usuario inicial: Contraseña

// Método de envío de formularios

define("FORM_METHOD", GET);          // Valores posibles: GET o POST

// Hoja de estilo

define("COLOR", 27);                 // Color básico de la aplicación (0 - 360)

// Nombre de sesión

define("SESSION_NAME", "agenda-3");  // Nombre de sesión

// Algoritmo hash para encriptar la contraseña de usuario

define("ALGORITMO_HASH", "sha256");  // Algoritmo hash
