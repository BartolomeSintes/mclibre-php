<?php
/**
 * Agenda multiusuario -  borrar-todo-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2009 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2009-05-21
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

include "biblioteca.php";
session_start();

if (!isset($_SESSION["multiagendaUsuario"]) || ($_SESSION["multiagendaUsuario"] != $administradorNombre)) {
    header("Location:index.php");
    exit;
} elseif (!isset($_REQUEST["si"])) {
    header("Location:index.php");
    exit;
} else {
    $db = conectaDb();
    cabecera("Borrar todo 2", $_SESSION["multiagendaUsuario"]);
    if ($dbMotor == MYSQL) {
        borraTodoMySQL($db);
    } elseif ($dbMotor == SQLITE) {
        borraTodoSqlite($db);
    }
    $_SESSION = [];
    $db = NULL;
    pie();
}
?>
