<?php
/**
 * Sesiones (1) 02 - sesiones-1-02-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-11-09
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
session_name("sesiones-1-02");
session_start();

// Funciones auxiliares
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

// Recogida de nombre
$nombre   = recoge("nombre");
$nombreOk = false;

// Comprobación de nombre
if ($nombre == "") {
    // Si no se recibe nombre, se vuelve al formulario
    header("location:sesiones-1-02-1.php");
    exit;
} else {
    $nombreOk = true;
}

// Si el nombre es válido ...
if ($nombreOk) {
    // guarda el nombre en la sesión
    $_SESSION["nombre"] = $nombre;
    // y vuelve al formulario
    header("location:sesiones-1-02-1.php");
    exit;
}

/* La solución anterior sigue el patrón recogida+validación+ejecución
 * propuesta en los ejercicios de formularios
 * El programa podría hacerse más corto con el mismo resultado

$nombre   = recoge("nombre");
if ($nombre != "") {
    $_SESSION["nombre"] = $nombre;
}
header("location:sesiones-1-02-1.php");
 */
