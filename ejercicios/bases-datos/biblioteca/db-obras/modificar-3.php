<?php
/**
 * Biblioteca - db-obras/modificar-3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2020 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2020-05-11
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

require_once "../comunes/biblioteca.php";

session_name(SESSION_NAME);
session_start();
if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != NIVEL_2) {
    header("Location:../index.php");
    exit;
}

$db = conectaDb();
cabecera("Obras - Modificar 3", MENU_OBRAS, 1);

$autor     = recoge("autor");
$titulo    = recoge("titulo");
$editorial = recoge("editorial");
$id        = recoge("id");

$autorOk     = false;
$tituloOk    = false;
$editorialOk = false;

if (mb_strlen($autor, "UTF-8") > $tamObrasAutor) {
    print "    <p class=\"aviso\">El autor no puede tener más de $tamObrasAutor caracteres.</p>\n";
    print "\n";
} else {
    $autorOk = true;
}

if (mb_strlen($titulo, "UTF-8") > $tamObrasTitulo) {
    print "    <p class=\"aviso\">Los titulos no pueden tener más de $tamObrasTitulo caracteres.</p>\n";
    print "\n";
} else {
    $tituloOk = true;
}

if (mb_strlen($editorial, "UTF-8") > $tamObrasEditorial) {
    print "    <p class=\"aviso\">La editorial no puede tener más de $tamObrasEditorial caracteres.</p>\n";
    print "\n";
} else {
    $editorialOk = true;
}

if ($autorOk && $tituloOk && $editorialOk) {
    if ($id == "") {
        print "    <p>No se ha seleccionado ningún registro.</p>\n";
    } elseif ($autor == "" && $titulo == "" && $editorial == "") {
        print "    <p>Hay que rellenar al menos uno de los campos. No se ha guardado la modificación.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $tablaObras
            WHERE id=:id";
        $result = $db->prepare($consulta);
        $result->execute([":id" => $id]);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn() == 0) {
            print "    <p>Registro no encontrado.</p>\n";
        } else {
            // La consulta cuenta los registros con un id diferente porque MySQL no distingue
            // mayúsculas de minúsculas y si en un registro sólo se cambian mayúsculas por
            // minúsculas MySQL diría que ya hay un registro como el que se quiere guardar.
            $consulta = "SELECT COUNT(*) FROM $tablaObras
                WHERE autor=:autor
                AND titulo=:titulo
                AND editorial=:editorial
                AND id<>:id";
            $result = $db->prepare($consulta);
            $result->execute([":autor" => $autor, ":titulo" => $titulo,
                ":editorial" => $editorial, ":id" => $id]);
            if (!$result) {
                print "    <p>Error en la consulta.</p>\n";
            } elseif ($result->fetchColumn() > 0) {
                print "    <p>Ya existe un registro con esos mismos valores. "
                    . "No se ha guardado la modificación.</p>\n";
            } else {
                $consulta = "UPDATE $tablaObras
                    SET autor=:autor, titulo=:titulo,
                        editorial=:editorial
                    WHERE id=:id";
                $result = $db->prepare($consulta);
                if ($result->execute([":autor" => $autor, ":titulo" => $titulo,
                    ":editorial" => $editorial, ":id" => $id])) {
                    print "    <p>Registro modificado correctamente.</p>\n";
                } else {
                    print "    <p>Error al modificar el registro.</p>\n";
                }
            }
        }
    }
}

$db = null;
pie();
