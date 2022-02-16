<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

$pdo = conectaDb();

cabecera("Inicio", MENU_PRINCIPAL, PROFUNDIDAD_0);

$consulta = "SELECT
                noticias.id,
                categorias.categoria,
                noticias.titulo,
                noticias.cuerpo,
                noticias.creado
             FROM $cfg[dbNoticiasTabla] as noticias
             JOIN $cfg[dbCategoriasTabla] as categorias
             ON noticias.id_categoria = categorias.id
             ORDER BY creado DESC LIMIT $cfg[portadaNumeroNoticias]";

$resultado = $pdo->query($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} elseif (!count($registros = $resultado->fetchAll())) {
    print "    <p class=\"aviso\">No se ha publicado todavía ninguna noticia.</p>\n";
} else {
    print "  <div class=\"noticias\">\n";
    foreach ($registros as $registro) {
        print "    <article class=\"noticia-portada\">\n";
        print "      <h2>$registro[titulo]</h2>\n";
        if ($registro["creado"] == "0000-00-00") {
            print "      <p class=\"noticia-categoria\">$registro[categoria]</p>\n";
        } else {
            print "      <p class=\"noticia-categoria\">$registro[categoria] ($registro[creado])</p>\n";
        }
        print "      <p class=\"noticia-cuerpo\">$registro[cuerpo]</p>\n";
        print "    </article>\n";
        print "\n";
    }
    print "  </div>\n";
}

$pdo = null;

pie();
