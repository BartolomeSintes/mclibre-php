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

cabecera("Noticias - Añadir 2", MENU_NOTICIAS, PROFUNDIDAD_2);

$categoria = recoge("categoria");
$titulo    = recoge("titulo");
$cuerpo    = recoge("cuerpo");
$creado    = recoge("creado");

$categoriaOk = false;
$tituloOk    = false;
$cuerpoOk    = false;
$creadoOk    = false;

if ($categoria == "") {
    print "    <p class=\"aviso\">Debe seleccioanr una categoría.</p>\n";
} else {
    $consulta = "SELECT * FROM $cfg[dbCategoriasTabla]
             WHERE id = :id";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":id" => $categoria])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!($registro = $resultado->fetch())) {
        print "    <p class=\"aviso\">La categoría seleccionada no existe.</p>\n";
    } else {
        $categoriaOk = true;
    }
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
    $categoriaOk = $tituloOk = $cuerpoOk = $creadoOk = false;
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

if ($categoriaOk && $tituloOk && $cuerpoOk && $creadoOk) {
    $consulta = "SELECT COUNT(*) FROM $cfg[dbNoticiasTabla]
                 WHERE id_categoria = :categoria
                 AND titulo = :titulo
                 AND cuerpo = :cuerpo
                 AND creado = :creado";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":categoria" => $categoria, ":titulo" => $titulo, ":cuerpo" => $cuerpo, ":creado" => $creado])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif ($resultado->fetchColumn() > 0) {
        print "    <p class=\"aviso\">El registro ya existe.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $cfg[dbNoticiasTabla]";

        $resultado = $pdo->query($consulta);
        if (!$resultado) {
            print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } elseif ($resultado->fetchColumn() >= $cfg["dbNoticiasMaxReg"] && $cfg["dbNoticiasMaxReg"] > 0) {
            print "    <p class=\"aviso\">Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
            print "\n";
            print "    <p class=\"aviso\">Por favor, borre algún registro antes de insertar un nuevo registro.</p>\n";
        } else {
            $consulta = "INSERT INTO $cfg[dbNoticiasTabla]
                         (id_categoria, titulo, cuerpo, creado)
                         VALUES (:categoria, :titulo, :cuerpo, :creado)";

            $resultado = $pdo->prepare($consulta);
            if (!$resultado) {
                print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } elseif (!$resultado->execute([":categoria" => $categoria, ":titulo" => $titulo, ":cuerpo" => $cuerpo, ":creado" => $creado])) {
                print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } else {
                print "    <p>Registro creado correctamente.</p>\n";
            }
        }
    }
}

$pdo = null;

pie();
