<?php
/**
 * Sesiones Minijuegos (1) 5 - minijuegos-1-5-2.php
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
session_name("minijuegos-1-5");
session_start();

// Si los valores de sesión no existen, redirigimos a la primera página
if (!isset($_SESSION["carta1"])) {
    header("location:minijuegos-1-5-1.php");
    exit;
}

// Funciones auxiliares
function recoge($var, $m = "")
{
    $tmp = is_array($m) ? [] : "";
    if (isset($_REQUEST[$var])) {
        if (!is_array($_REQUEST[$var]) && !is_array($m)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$var]));
        } elseif (is_array($_REQUEST[$var]) && is_array($m)) {
            $tmp = $_REQUEST[$var];
            array_walk_recursive($tmp, function (&$valor) {
                $valor = trim(htmlspecialchars($valor));
            });
        }
    }
    return $tmp;
}

// Recogemos accion
$accion = recoge("accion");

// Si recibimos "nuevas", reiniciamos los valores de las cartas
if ($accion == "nuevas") {
    $_SESSION["carta1"] = rand(1, 10);
    $_SESSION["carta2"] = rand(1, 10);
    $_SESSION["carta3"] = rand(1, 10);
}

// Volvemos al formulario
header("location:minijuegos-1-5-1.php");
