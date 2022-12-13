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

if (mb_strlen($categoria, "UTF-8") > $cfg["tablaNoticiasTamCategoria"]) {
    print "    <p class=\"aviso\">La categoría no puede tener más de $cfg[tablaNoticiasTamCategoria] caracteres.</p>\n";
    print "\n";
} else {
    $categoriaOk = true;
}

if (mb_strlen($titulo, "UTF-8") > $cfg["tablaNoticiasTamTitulo"]) {
    print "    <p class=\"aviso\">El título no puede tener más de $cfg[tablaNoticiasTamTitulo] caracteres.</p>\n";
    print "\n";
} else {
    $tituloOk = true;
}

if (mb_strlen($cuerpo, "UTF-8") > $cfg["tablaNoticiasTamCuerpo"]) {
    print "    <p class=\"aviso\">El cuerpo de la noticia no puede tener más de $cfg[tablaNoticiasTamCuerpo] caracteres.</p>\n";
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
    $consulta = "SELECT COUNT(*) FROM $cfg[tablaNoticias]
                 WHERE categoria = :categoria
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
        $consulta = "SELECT COUNT(*) FROM $cfg[tablaNoticias]";

        $resultado = $pdo->query($consulta);
        if (!$resultado) {
            print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } elseif ($resultado->fetchColumn() >= $cfg["tablaNoticiasMaxReg"] && $cfg["tablaNoticiasMaxReg"] > 0) {
            print "    <p class=\"aviso\">Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
            print "\n";
            print "    <p class=\"aviso\">Por favor, borre algún registro antes de insertar un nuevo registro.</p>\n";
        } else {
            $consulta = "INSERT INTO $cfg[tablaNoticias]
                         (categoria, titulo, cuerpo, creado)
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
