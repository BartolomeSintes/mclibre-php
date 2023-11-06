<?php
/**
 * Sesiones Minijuegos (1) 2 - minijuegos-1-2-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2022 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-11-21
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
session_name("minijuegos-1-2");
session_start();

// Si los valores de sesión no existen, redirigimos a la primera página
if (!isset($_SESSION["carta"])) {
    header("location:minijuegos-1-2-1.php");
    exit;
}

// Funciones auxiliares
// Función de recogida de datos
function recoge($key, $type = "")
{
    if ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): argument #2 (\$type) must be an empty array or an empty string.", E_USER_ERROR);
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

$accion = recoge("accion");

// Si recibimos "reiniciar", reiniciamos los valores de sesión
if ($accion == "reiniciar") {
    $_SESSION["maximo"] = $_SESSION["carta"] = 1;
// Si recibimos "nueva", modificamos el número de carta ...
} elseif ($accion == "nueva") {
    $_SESSION["carta"] = rand(1, 10);
    //  ... y comprobamos si se ha superado el máximo anterior
    //  para cambiar el máximo por la nueva carta
    if ($_SESSION["carta"] > $_SESSION["maximo"]) {
        $_SESSION["maximo"] = $_SESSION["carta"];
    }
}

// Volvemos al formulario
header("location:minijuegos-1-2-1.php");
