<?php
/**
 * Descubra dibujos - matrices-1-14-2.php
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
session_name("matrices-1-14");
session_start();

// Si la principal variable de sesión no está definida ...
if (!isset($_SESSION["dibujos"])) {
    // ... volvemos al formulario
    header("Location:matrices-1-14-1.php");
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

// Recogemos el emoji a mostrar/ocultar
$invierte = recoge("invierte");

// Si el emoji recibido existe ...
if (isset($_SESSION["dibujos"][$invierte])) {
    // ... invertimos el valor (de true a false y viceversa)
    $_SESSION["destapados"][$invierte] = !$_SESSION["destapados"][$invierte];
}

// Volvemos al formulario
header("Location:matrices-1-14-1.php");
