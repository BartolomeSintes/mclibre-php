<?php
/**
 * Biblioteca - pre-anyadir-2.php
 *
 * @author    Bartolom� Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2009 Bartolom� Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2009-05-21
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

include('funciones.php');
$db = conectaDb();
cabecera('Pr�stamos - Nuevo pr�stamo 2', CABECERA_SIN_CURSOR, 'menuPrestamos');

$idUsuario = recogeParaConsulta($db, 'id_usuario');
$idObra    = recogeParaConsulta($db, 'id_obra');
$fecha     = recogeParaConsulta($db, 'fecha');

$fechaOk = TRUE;

if (!ctype_digit(substr($fecha, 1, 2)) ||!ctype_digit(substr($fecha, 4, 2))
    ||!ctype_digit(substr($fecha, 7, 4))) {
    $fechaOk = FALSE;
} elseif (!checkdate(substr($fecha, 4, 2), substr($fecha, 1, 2),
    substr($fecha, 7, 4))) {
    $fechaOk = FALSE;
}

if (!$fechaOk) {
    print "<p>La fecha no es correcta.</p>\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbPrestamos";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn()>=MAX_REG_PRESTAMOS) {
        print "<p>Se ha alcanzado el n�mero m�ximo de registros que se pueden "
            ."guardar.</p>\n<p>Por favor, borre alg�n registro antes.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbUsuarios
            WHERE id=$idUsuario";
        $resultUsuario = $db->query($consulta);
        $consulta = "SELECT COUNT(*) FROM $dbObras
            WHERE id=$idObra";
        $resultObra = $db->query($consulta);
        $consulta = "SELECT COUNT(*) FROM $dbPrestamos
            WHERE id_usuario=$idUsuario
            AND id_obra=$idObra
            AND prestado='".fechaAmd($fecha)."'";
        $resultPrestamo = $db->query($consulta);
        if (!$resultObra||!$resultUsuario||!$resultPrestamo) {
            print "<p>Error en la consulta.</p>\n";
        } elseif ($resultUsuario->fetchColumn()==0) {
            print "<p>El identificador de Usuario no es correcto.</p>\n";
        } elseif ($resultObra->fetchColumn()==0) {
            print "<p>El identificador de Obra no es correcto.</p>\n";
        } elseif ($resultPrestamo->fetchColumn()!=0) {
            print "<p>El registro de pr�stamo ya existe.</p>\n";
        } else {
        // Inserto el valor 0000-00-00 expl�citamente porque si lo dejo vac�o
        // MySQL guarda 0000-00-00, pero SQLite lo deja en blanco
            $consulta = "INSERT INTO $dbPrestamos
                VALUES (NULL, $idUsuario, $idObra,'"
                .fechaAmd($fecha)."','0000-00-00')";
            if ($db->query($consulta)) {
                print "<p>Registro creado correctamente.</p>\n";
            } else {
                print "<p>Error al crear el registro.<p>\n";
            }
        }
    }
}

$db = NULL;
pie();
?>
