<?php
/**
 * Sesiones (1) 04 - sesiones-1-04-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-11-11
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
session_name("sesiones-1-04");
session_start();

// Funciones auxiliares
function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
        });
    }
    return $tmp;
}

// Recogemos las dos palabras
$mayusculas = recoge("mayusculas");
$minusculas = recoge("minusculas");

// Guardamos las palabras en la sesión
$_SESSION["mayusculas"] = $mayusculas;
$_SESSION["minusculas"] = $minusculas;

// Comprobamos la palabra en mayúsculas
if ($mayusculas == "") {
    // Si no se recibe palabra, guardamos en la sesión el mensaje de error
    $_SESSION["mayusculasError"] = "No ha escrito ninguna palabra";
} elseif (!ctype_upper($mayusculas)) {
    // Si la palabra está en minúsculas, guardamos en la sesión el mensaje de error
    $_SESSION["mayusculasError"] = "No ha escrito la palabra en mayúsculas";
} else {
    // Si la palabra es correcta, borramos los posibles errores anteriores
    unset($_SESSION["mayusculasError"]);
}

// Comprobamos la palabra en minúsculas
if ($minusculas == "") {
    // Si no se recibe palabra, guardamos en la sesión el mensaje de error
    $_SESSION["minusculasError"] = "No ha escrito ninguna palabra";
} elseif (!ctype_lower($minusculas)) {
    // Si la palabra está en mayúsculas, guardamos en la sesión el mensaje de error
    $_SESSION["minusculasError"] = "No ha escrito la palabra en minúsculas";
} else {
    // Si la palabra es correcta, borramos los posibles errores anteriores
    unset($_SESSION["minusculasError"]);
}

// Volvemos al formulario
header("Location:sesiones-1-04-1.php");
?>
