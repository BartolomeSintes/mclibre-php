<?php
/**
 * Seleccione dibujos - matrices-1-12-2.php
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
session_name("matrices-1-12");
session_start();

// Si la principal variable de sesión no está definida ...
if (!isset($_SESSION["disponibles"])) {
    // ... volvemos al formulario
    header("Location:matrices-1-12-1.php");
    exit;
}

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
// Recogemos el emoji a seleccionar
$selecciona = recoge("selecciona");

// Si el emoji recibido es uno de los disponibles ...
if (isset($_SESSION["disponibles"][$selecciona])) {
    // .. lo añadimos a la matriz de emojis seleccionados
    $_SESSION["seleccionados"][] = $_SESSION["disponibles"][$selecciona];
    // ... y lo eliminamos de la matriz de emojis disponibles
    unset($_SESSION["disponibles"][$selecciona]);

    // Si ya no quedan empojis disponibles ...
    if (!count($_SESSION["disponibles"])) {
        // ... destruimos la sesión (se volverá a crear al volver al formulario)
        session_destroy();
    }
}

// Volvemos al formulario
header("Location:matrices-1-12-1.php");
