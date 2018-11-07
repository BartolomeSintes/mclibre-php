<?php
/**
 * Sesiones (1) 02 - sesiones-1-02-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-07
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
// Accedemos a la sesión
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

// Recogemos el nombre
$nombre   = recoge("nombre");
$nombreOk = false;

// Comprobamos el nombre
if ($nombre == "") {
    // Si el nombre es vacío, no es correcto, pero no hacemos nada especial
} else {
    $nombreOk = true;
}

// Si el nombre no es válido ...
if (!$nombreOk) {
    // ... volvemos al formulario
    header("Location:sesiones-1-02-1.php");
    exit;
} else {
    // ... guardamos el nombre en la sesión
    $_SESSION["nombre"] = $nombre;
    // y volvemos al formulario
    header("Location:sesiones-1-02-1.php");
    exit;
}

/* La solución anterior sigue el patrón recogida+validación+ejecución
 * propuesta en los ejercicios de formularios
 * El programa podría hacerse más corto con el mismo resultado

$nombre   = recoge("nombre");
if ($nombre != "") {
    $_SESSION["nombre"] = $nombre;
}
header("Location:sesiones-1-02-1.php");
 */
