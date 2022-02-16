<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["nivel"] < NIVEL_USUARIO_BASICO) {
    header("Location:../../index.php");
    exit;
}

$pdo = conectaDb();

cabecera("Noticias - Modificar 3", MENU_NOTICIAS, PROFUNDIDAD_2);

$categoria = recoge("categoria");
$titulo    = recoge("titulo");
$cuerpo    = recoge("cuerpo");
$creado    = recoge("creado");
$id        = recoge("id");

$categoriaOk = false;
$tituloOk    = false;
$cuerpoOk    = false;
$creadoOk    = false;
$idOk        = false;

if (mb_strlen($categoria, "UTF-8") > $cfg["dbNoticiasTamCategoria"]) {
    print "    <p class=\"aviso\">La categoría no puede tener más de $cfg[dbNoticiasTamCategoria] caracteres.</p>\n";
    print "\n";
} else {
    $categoriaOk = true;
}

if (mb_strlen($titulo, "UTF-8") > $cfg["dbNoticiasTamTitulo"]) {
    print "    <p class=\"aviso\">El título no puede tener más de $cfg[dbNoticiasTamTitulo] caracteres.</p>\n";
    print "\n";
} else {
    $tituloOk = true;
}

if (mb_strlen($cuerpo, "UTF-8") > $cfg["dbNoticiasTamCuerpo"]) {
    print "    <p class=\"aviso\">El cuerpo de la noticia no puede tener más de $cfg[dbNoticiasTamCuerpo] caracteres.</p>\n";
    print "\n";
} else {
    $cuerpoOk = true;
}

if ($categoria == "" && $titulo == "" && $cuerpo == "" && $creado == "") {
    print "    <p class=\"aviso\">Hay que rellenar al menos uno de los campos. No se ha guardado el registro.</p>\n";
    print "\n";
    $categoriaOk = $tituloOk = $cuerpoOk = false;
}

if ($creado == "") {
    $creado   = "0000-00-00";
    $creadoOk = true;
} elseif (!compruebaFecha($creado)) {
    print "    <p class=\"aviso\">La fecha no es correcta.</p>\n";
    print "\n";
} else {
    $creadoOk = true;
}

if ($id == "") {
    print "    <p class=\"aviso\">No se ha seleccionado ningún registro.</p>\n";
} else {
    $idOk = true;
}

if ($categoriaOk && $tituloOk && $cuerpoOk && $idOk && $creadoOk) {
    $consulta = "SELECT COUNT(*) FROM $cfg[dbNoticiasTabla]
                 WHERE id = :id";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":id" => $id])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif ($resultado->fetchColumn() == 0) {
        print "    <p class=\"aviso\">Registro no encontrado.</p>\n";
    } else {
        // La consulta cuenta los registros con un id diferente porque MySQL no distingue
        // mayúsculas de minúsculas y si en un registro sólo se cambian mayúsculas por
        // minúsculas MySQL diría que ya hay un registro como el que se quiere guardar.
        $consulta = "SELECT COUNT(*) FROM $cfg[dbNoticiasTabla]
                     WHERE categoria = :categoria
                     AND titulo = :titulo
                     AND cuerpo = :cuerpo
                     AND creado = :creado
                     AND id <> :id";

        $resultado = $pdo->prepare($consulta);
        if (!$resultado) {
            print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } elseif (!$resultado->execute([":categoria" => $categoria, ":titulo" => $titulo,  ":cuerpo" => $cuerpo, ":creado" => $creado, ":id" => $id])) {
            print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } elseif ($resultado->fetchColumn() > 0) {
            print "    <p class=\"aviso\">Ya existe un registro con esos mismos valores. "
                . "No se ha guardado la modificación.</p>\n";
        } else {
            $consulta = "UPDATE $cfg[dbNoticiasTabla]
                         SET categoria = :categoria, titulo = :titulo,
                         cuerpo = :cuerpo, creado = :creado
                         WHERE id = :id";

            $resultado = $pdo->prepare($consulta);
            if (!$resultado) {
                print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } elseif (!$resultado->execute([":categoria" => $categoria, ":titulo" => $titulo,  ":cuerpo" => $cuerpo, ":creado" => $creado, ":id" => $id])) {
                print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } else {
                print "    <p>Registro modificado correctamente.</p>\n";
            }
        }
    }
}

$pdo = null;

pie();
