<?php
/**
 * Identificación de usuarios - Agenda (1) - comunes/config.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-12-11
 * @link      https://www.mclibre.org
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

// Método de envío de formularios

define("FORM_METHOD", GET);          // Valores posibles: GET o POST

// Hoja de estilo

define("COLOR", 27);                 // Color básico de la aplicación (0 - 360)

// Nombre de sesión

define("SESSION_NAME", "agenda-1");  // Nombre de sesión
