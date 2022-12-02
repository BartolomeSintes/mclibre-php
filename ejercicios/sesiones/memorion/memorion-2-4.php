<?php
/**
 * Memorión (2) - memorion-2-4.php
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

// Si no están definidas las variables de sesión, redirigimos a la segunda página
if (!isset($_SESSION["numeroDibujos"]) || !isset($_SESSION["dibujos"])) {
    header("Location:memorion-2-2.php");
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

// Recogemos el número de dibujos
$numeroDibujos = recoge("numeroDibujos");

// Variable auxiliar dato correcto
$numeroDibujosOk = false;

// Validamos el dato recibido, sin hacer nada si el dato no es válido
if ($numeroDibujos == "") {
} elseif (!is_numeric($numeroDibujos)) {
} elseif (!ctype_digit($numeroDibujos)) {
} elseif ($numeroDibujos < 2 || $numeroDibujos > 61) {
} else {
    $numeroDibujosOk = true;
}

// Si el dato es válido ...
if ($numeroDibujosOk) {
    // ... cambiamos el número de dibujos
    $_SESSION["numeroDibujos"] = $numeroDibujos;
    // Borramos la partida
    unset($_SESSION["dibujos"]);
    // Redirigimos a la segunda página
    header("Location:memorion-2-2.php");
    exit;
}

// Redirigimos a la tercera página
header("Location:memorion-2-3.php");
