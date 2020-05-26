<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
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
        print "    <p class=\"aviso\">No se ha seleccionado ningún registro.</p>\n";
    } elseif ($autor == "" && $titulo == "" && $editorial == "") {
        print "    <p class=\"aviso\">Hay que rellenar al menos uno de los campos. No se ha guardado la modificación.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $tablaObras
            WHERE id=:id";
        $result = $db->prepare($consulta);
        $result->execute([":id" => $id]);
        if (!$result) {
            print "    <p class=\"aviso\">Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn() == 0) {
            print "    <p class=\"aviso\">Registro no encontrado.</p>\n";
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
                ":editorial"           => $editorial, ":id" => $id, ]);
            if (!$result) {
                print "    <p class=\"aviso\">Error en la consulta.</p>\n";
            } elseif ($result->fetchColumn() > 0) {
                print "    <p class=\"aviso\">Ya existe un registro con esos mismos valores. "
                    . "No se ha guardado la modificación.</p>\n";
            } else {
                $consulta = "UPDATE $tablaObras
                    SET autor=:autor, titulo=:titulo,
                        editorial=:editorial
                    WHERE id=:id";
                $result = $db->prepare($consulta);
                if ($result->execute([":autor" => $autor, ":titulo" => $titulo,
                    ":editorial" => $editorial, ":id" => $id, ])) {
                    print "    <p>Registro modificado correctamente.</p>\n";
                } else {
                    print "    <p class=\"aviso\">Error al modificar el registro.</p>\n";
                }
            }
        }
    }
}

$db = null;
pie();
