<?php
/**
 * Sesiones Matrices (2) 02-2 - matrices-1-02-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-12-04
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

// Accedemos a la sesión
session_name("matrices-1-02");
session_start();

// Si la variable de sesión no está definida ...
if (!isset($_SESSION["nombres"])) {
    // ... volvemos al formulario
    header("Location:matrices-1-02-1.php");
    exit;
}

// Función de recogida de datos
function recoge($key, $type = "")
{
    if (!is_string($key) && !is_int($key) || $key == "") {
        trigger_error("Function recoge(): Argument #1 (\$key) must be a non-empty string or an integer", E_USER_ERROR);
    } elseif ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): Argument #2 (\$type) is optional, but if provided, it must be an empty array or an empty string", E_USER_ERROR);
    }
    $tmp = $type;
    if (isset($_REQUEST[$key])) {
        if (!is_array($_REQUEST[$key]) && !is_array($type)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$key]));
        } elseif (is_array($_REQUEST[$key]) && is_array($type)) {
            $tmp = $_REQUEST[$key];
            array_walk_recursive($tmp, function (&$value) {
                $value = trim(htmlspecialchars($value));
            });
        }
    }
    return $tmp;
}

// Recogemos el nombre y el botón
$accion   = recoge("accion");
$nombre   = recoge("nombre");
$nombreOk = false;

// Si se nos pide cerrar la sesión
if ($accion == "Cerrar sesión") {
    // la cerramos y volvemos al formulario
    session_destroy();
    header("Location:matrices-1-02-1.php");
    exit;
}

// Si el nombre no es vacío, es correcto
if ($nombre != "") {
    $nombreOk = true;
}

// Si el nombre es correcto ...
if ($nombreOk) {
    // ... y además no está ya incluido en la matriz ...
    if (!in_array($nombre, $_SESSION["nombres"])) {
        // ... lo guardamos en la sesión
        $_SESSION["nombres"][] = $nombre;
    }
}

// Volvemos al formulario
header("Location:matrices-1-02-1.php");
