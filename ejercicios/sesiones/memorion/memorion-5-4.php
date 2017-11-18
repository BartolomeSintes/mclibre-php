<?php
/**
 * Memorión (5) - memorion-5-4.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-11-18
 * @link      http://www.mclibre.org
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
session_name("memorion-5");
session_start();

// Si no están guardado en la sesión los dibujos de la partida ....
if (!isset($_SESSION["numeroDibujos"])) {
    // ... redirigimos a la primera página
    header("Location:memorion-5-1.php");
    exit;
}

// Funciones auxiliares
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

// Recogemos el número de dibujos
$numeroDibujos = recoge("numeroDibujos");
// Número mínimo y máximo de dibujos
$numeroDibujosMinimo = 2;
$numeroDibujosMaximo = 61;

// Variable auxiliar dato correcto
$numeroDibujosOk = false;

// Validamos el dato recibido, redirigiendo a la primera página si el dato no es válido
if ($numeroDibujos == "") {
    header("Location:memorion-5-1.php");
    exit;
} elseif (!is_numeric($numeroDibujos)) {
    header("Location:memorion-5-1.php");
    exit;
} elseif (!ctype_digit($numeroDibujos)) {
    header("Location:memorion-5-1.php");
    exit;
} elseif ($numeroDibujos < $numeroDibujosMinimo || $numeroDibujos > $numeroDibujosMaximo) {
    header("Location:memorion-5-1.php");
    exit;
} else {
    $numeroDibujosOk = true;
}

// Si el dato es válido ...
if ($numeroDibujosOk) {
    // ... cambiamos el número de dibujos
    $_SESSION["numeroDibujos"] = $numeroDibujos;
    // Borramos la partida
    unset($_SESSION["dibujos"]);
    // Redirigimos a la primera página
    header("Location:memorion-5-1.php");
    exit;
}
