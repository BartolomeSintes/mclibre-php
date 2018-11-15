<?php
/**
 * Sesiones (2) 12 - matrices-1-01-2.php
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

$paginaAnterior = "matrices-1-01-1.php";

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
