<?php
/**
 * Memorión (1) - memorion-1-2.php
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
session_name("memorion-1");
session_start();

// Si no están definidas las variables de sesión, las definimos
if (!isset($_SESSION["numeroDibujos"]) || !isset($_SESSION["dibujos"])) {
    // Número de dibujos en la sesión
    $_SESSION["numeroDibujos"] = rand(4, 20);

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

// Recogemos el dato (botón)
$accion = recoge("accion");

// Si se ha pulsado "Nueva partida" ...
if ($accion == "nueva") {
    // ... borramos la partida actual
    unset($_SESSION["numeroDibujos"], $_SESSION["dibujos"]);
    // ... y redirigimos a la primera página
    header("Location:memorion-1-1.php");
    exit;
}

// Redirigimos a la primera página
header("Location:memorion-1-1.php");
