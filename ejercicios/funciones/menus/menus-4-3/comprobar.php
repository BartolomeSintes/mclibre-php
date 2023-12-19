<?php
/**
 * Menús 4 - comprobar.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2023 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2023-12-19
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

require_once "biblioteca.php";

session_name("menus-4-3");
session_start();
if (!isset($_SESSION["conectado"])) {
    $_SESSION["conectado"] = false;
}

cabecera("Comprobar");

if ($_SESSION["conectado"]) {
    print "    <p>Está usted <strong>conectado</strong>.</p>\n";
} else {
    print "    <p>Está usted <strong>desconectado</strong>.</p>\n";
}

pie();
