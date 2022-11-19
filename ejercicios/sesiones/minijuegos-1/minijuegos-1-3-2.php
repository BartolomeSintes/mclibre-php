<?php
/**
 * Sesiones Minijuegos (1) 3 - minijuegos-1-3-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2022 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-11-17
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
session_name("minijuegos-1-3");
session_start();

// Si los valores de sesión no existen, redirigimos a la primera página
if (!isset($_SESSION["carta"])) {
    header("location:minijuegos-1-3-1.php");
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

// Si recibimos "reiniciar", reiniciamos los valores de sesión
if ($accion == "reiniciar") {
    $_SESSION["maximo"]   = $_SESSION["carta"] = 1;
    $_SESSION["intentos"] = 0;
// Si recibimos "nueva", modificamos el número de carta,
// aumentamos el contador y
// comprobamos si se ha superado el máximo anterior
} elseif ($accion == "nueva") {
    $_SESSION["carta"] = rand(1, 10);
    if ($_SESSION["maximo"] < 10) {
        $_SESSION["intentos"]++;
    }
    if ($_SESSION["carta"] > $_SESSION["maximo"]) {
        $_SESSION["maximo"] = $_SESSION["carta"];
    }
}

// Volvemos al formulario
header("location:minijuegos-1-3-1.php");
