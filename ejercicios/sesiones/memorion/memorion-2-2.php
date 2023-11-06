<?php
/**
 * Memorión (2) - memorion-2-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2022 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-12-02
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

// Nos unimos a la sesión
session_name("memorion-2");
session_start();

// Si no está definido en la sesión el número de dibujos ....
if (!isset($_SESSION["numeroDibujos"])) {
    // ... guardamos el número de dibujos en la sesión
    $_SESSION["numeroDibujos"] = 5;
}

// Si no están definidos en la sesión los dibujos de la partida ....
if (!isset($_SESSION["dibujos"])) {
    // Matriz con todos los valores posibles (61 valores)
    $valores = range(128000, 128060);
    // Los barajamos
    shuffle($valores);
    // Guardamos los N primeros (N es el número de dibujos)
    for ($i = 0; $i < $_SESSION["numeroDibujos"]; $i++) {
        $_SESSION["dibujos"][$i] = $valores[$i];
    }
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

// Recogemos el dato (botón)
$accion = recoge("accion");

// Si se ha pulsado "Nueva partida" ...
if ($accion == "nueva") {
    // ... borramos la partida actual
    unset($_SESSION["dibujos"]);
    // ... y redirigimos a la primera página
    header("Location:memorion-2-1.php");
    exit;
}

// Si se ha pulsado "Cambiar número de dibujos" ...
if ($accion == "numero") {
    // ... redirigimos al formulario correspondiente
    header("Location:memorion-2-3.php");
    exit;
}

// Redirigimos a la primera página
header("Location:memorion-2-1.php");
