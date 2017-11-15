<?php
/**
 * Sesiones (2) 12 - sesiones-2-12-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-11-16
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

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

session_name("sesiones_2_12");
session_start();

$accion   = recoge("accion");
$nombre   = recoge("nombre");
$nombreOk = false;

$paginaAnterior = "sesiones-2-12-1.php";

if ($accion == "Cerrar") {
    session_destroy();
    header("Location:$paginaAnterior");
    exit();
}

if ($nombre != "") {
    $nombreOk = true;
}

if ($nombreOk) {
    $_SESSION["nombres"][] = $nombre;
}

header("Location:$paginaAnterior");
exit();
?>
