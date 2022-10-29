<?php
/**
 * Citas - cit-eti-borrar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-06-06
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

session_start();
if (!isset($_SESSION["citasUsuario"])) {
    header("Location:index.php");
    exit();
} else {
    include "biblioteca.php";
    $db = conectaDb();
    cabecera("Citas - Borrar etiquetas 2", "menu_citas");

    $id = recogeParaConsulta($db, "id");
    if ($id == "''") {
        print "    <p>No se ha seleccionado ningún registro.</p>\n";
        print "\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbCitas
            WHERE id=$id";
        $result = $db->query($consulta);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
            print "\n";
        } elseif ($result->fetchColumn() == 0) {
            print "    <p>Registro no encontrado.</p>\n";
            print "\n";
        } else {
            $consulta = "SELECT * FROM $dbCitas, $dbAutores
                WHERE $dbCitas.id_autor=$dbAutores.id
                AND $dbCitas.id=$id";
            $result = $db->query($consulta);
            if (!$result) {
                print "    <p>Error en la consulta.</p>\n";
                print "\n";
            } else {
                $valor = $result->fetch();
                $nombre = $valor["nombre"] . " " . $valor["apellidos"];
                $cita = $valor["cita"];
                $consulta = "SELECT COUNT(*) FROM $dbEtiCitas, $dbEtiquetas
                    WHERE id_cita=$id
                    AND $dbEtiCitas.id_etiqueta=$dbEtiquetas.id
                    ORDER BY etiqueta ASC";
                $result = $db->query($consulta);
                if (!$result) {
                    print "    <p>Error en la consulta.</p>\n";
                    print "\n";
                } elseif ($result->fetchColumn() == 0) {
                    print "    <p>La cita elegida no tiene etiquetas asignadas.</p>";
                    print "\n";
                } else {
                    print "    <form action=\"cit-eti-borrar-3.php\" method=\"get\">\n";
                    print "      <p>Marque las etiquetas a borrar:</p>\n";
                    print "\n";
                    print "      <table border=\"1\">\n";
                    print "        <tr>\n";
                    print "          <th>Autor:</th>\n";
                    print "          <td colspan=\"2\">$nombre</td>\n";
                    print "        </tr>\n";
                    print "        <tr>\n";
                    print "          <th>Cita:</th>\n";
                    print "          <td colspan=\"2\">$cita</td>\n";
                    print "        </tr>\n";
    // En esta consulta he tenido que añadir id_eticita porque las dos
    // tablas tienen un campo id y quiero el id de la eticita no de la cita
                    $consulta = "SELECT $dbEtiCitas.id as id_eticita, * FROM $dbEtiCitas, $dbEtiquetas
                        WHERE $dbEtiCitas.id_cita=$id
                        AND $dbEtiCitas.id_etiqueta=$dbEtiquetas.id
                        ORDER BY etiqueta ASC";
                    $result = $db->query($consulta);
                    if (!$result) {
                        print "    <p>Error en la consulta.</p>\n";
                        print "\n";
                    } else {
                        foreach ($result as $indice => $valor) {
                            print "        <tr>\n";
                            print "          <th>Etiqueta:</th>\n";
                            print "          <td><input type=\"checkbox\" name=\"id[$valor[id_eticita]]\">\n";
                            print "          <td>$valor[etiqueta]</td>\n";
                            print "        </tr>\n";
                        }
                    }
                    print "      </table>\n";
                    print "\n";
                    print "      <p>\n";
                    print "        <input type=\"hidden\" name=\"cita\" value=\"$id\">\n";
                    print "        <input type=\"submit\" value=\"Asignar\">\n";
                    print "      </p>\n";
                    print "    </form>\n";
                    print "\n";
                }
            }
        }
    }
    $db = NULL;
    pie();
}
?>
