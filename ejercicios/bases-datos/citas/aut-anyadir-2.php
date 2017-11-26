<?php
/**
 * Citas - aut-anyadir-2.php
 *
 * @author    Bartolom� Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolom� Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-06-06
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

session_start();
if (!isset($_SESSION['citasUsuario'])) {
    header('Location:index.php');
    exit();
} else {
    include('funciones.php');
    $db = conectaDb();
    cabecera('Autores - A�adir 2', 'menu_autores');

    $nombre = recogeParaConsulta($db, 'nombre');
    $nombre = quitaComillasExteriores($nombre);
    $nombre = strtolower($nombre);
    $tmpNombre = [];
    $tmpNombre = explode(' ', $nombre);
    foreach ($tmpNombre as $indice => $valor) {
        $tmpNombre[$indice] = ucfirst($tmpNombre[$indice]);
    }
    $nombre = implode(' ', $tmpNombre);

    $apellidos = recogeParaConsulta($db, 'apellidos');
    $apellidos = quitaComillasExteriores($apellidos);
    $apellidos = strtolower($apellidos);
    $tmpApellidos = [];
    $tmpApellidos = explode(" ", $apellidos);
    foreach ($tmpApellidos as $indice => $valor) {
        $tmpApellidos[$indice] = ucfirst($tmpApellidos[$indice]);
    }
    $apellidos = implode(' ', $tmpApellidos);

    if (($nombre=="''") && ($apellidos=='')) {
        print "<p>El nombre y apellidos del autor no puede estar vac�a. "
            ."No se ha guardado el registro.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbAutores";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn()>=$maxRegAutores) {
            print "<p>Se ha alcanzado el n�mero m�ximo de registros que se pueden "
                ."guardar.</p>\n<p>Por favor, borre alg�n registro antes.</p>\n";
        } else {
            $consulta = "SELECT COUNT(*) FROM $dbAutores
                WHERE nombre='$nombre'
                AND apellidos='$apellidos'";
            $result = $db->query($consulta);
            if (!$result) {
                print "<p>Error en la consulta.</p>\n";
            } elseif ($result->fetchColumn()==1) {
                print "<p>El registro ya existe.</p>\n";
            } else {
                $consulta = "INSERT INTO $dbAutores
                    VALUES (NULL, '$nombre', '$apellidos')";
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
}
?>
