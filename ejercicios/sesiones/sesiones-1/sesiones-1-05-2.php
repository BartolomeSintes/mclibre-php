<?php
/**
 * Sesiones (1) 05 - sesiones-1-05-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-10-31
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
// Se accede a la sesión
session_name("sesiones-1-05");
session_start();

// Si alguna posición no está guardada en la sesión, las pone a cero
if (!isset($_SESSION["x"]) || !isset($_SESSION["y"])) {
    $_SESSION["x"] = $_SESSION["y"] = 0;
}

// Funciones auxiliares
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

// Recogida de accion
$accion   = recoge("accion");
$accionOk = true;

// Comprobación de accion
if ($accion != "centro" && $accion != "izquierda" && $accion != "derecha"
    && $accion != "arriba" && $accion != "abajo") {
    // Si no es una de las tres posibles acciones, se vuelve al formulario
    header("Location:sesiones-1-05-1.php");
    exit;
} else {
    $accionOk = true;
}

// Si la accion recibibida es válida ...
if ($accionOk) {
    //se mueve el punto
    if ($accion == "centro") {
        $_SESSION["x"] = $_SESSION["y"] = 0;
    } elseif ($accion == "izquierda") {
        $_SESSION["x"] -= 20;
    } elseif ($accion == "derecha") {
        $_SESSION["x"] += 20;
    } elseif ($accion == "arriba") {
        $_SESSION["y"] -= 20;
    } elseif ($accion == "abajo") {
        $_SESSION["y"] += 20;
    }

    // si sale por un lado, entra por el otro
    if ($_SESSION["x"] > 200) {
        $_SESSION["x"] = -200;
    } elseif ($_SESSION["x"] < -200) {
        $_SESSION["x"] = 200;
    }

    // si sale por un lado, entra por el otro
    if ($_SESSION["y"] > 200) {
        $_SESSION["y"] = -200;
    } elseif ($_SESSION["y"] < -200) {
        $_SESSION["y"] = 200;
    }

    // y vuelve al formulario
    header("Location:sesiones-1-05-1.php");
    exit;
}

/* La solución anterior sigue el patrón recogida+validación+ejecución
 * propuesta en los ejercicios de formularios
 * El programa podría hacerse más corto con el mismo resultado

$accion = recoge("accion");

 if ($accion == "centro") {
    $_SESSION["x"] = $_SESSION["y"] = 0;
} elseif ($accion == "izquierda") {
    $_SESSION["x"] -= 20;
} elseif ($accion == "derecha") {
    $_SESSION["x"] += 20;
} elseif ($accion == "arriba") {
    $_SESSION["y"] -= 20;
} elseif ($accion == "abajo") {
    $_SESSION["y"] += 20;
}

if ($_SESSION["x"] > 200) {
    $_SESSION["x"] = -200;
} elseif ($_SESSION["x"] < -200) {
    $_SESSION["x"] = 200;
}

if ($_SESSION["y"] > 200) {
    $_SESSION["y"] = -200;
} elseif ($_SESSION["y"] < -200) {
    $_SESSION["y"] = 200;
}

header("Location:sesiones-1-05-1.php");
*/
