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

cabecera("Noticias - Buscar 2", MENU_NOTICIAS, PROFUNDIDAD_2);

$categoria = recoge("categoria");
$titulo    = recoge("titulo");
$cuerpo    = recoge("cuerpo");
$ano       = recoge("ano");
$mes       = recoge("mes");
$dia       = recoge("dia");
$ordena    = recogeValores("ordena", $cfg["dbNoticiasColumnasOrden"], "categoria ASC");

$consulta = "SELECT
                noticias.id,
                categorias.categoria,
                noticias.titulo,
                noticias.cuerpo,
                noticias.creado
             FROM $cfg[dbNoticiasTabla] as noticias
             JOIN $cfg[dbCategoriasTabla] as categorias
             ON noticias.id_categoria = categorias.id
             WHERE id_categoria LIKE :categoria
             AND titulo LIKE :titulo
             AND cuerpo LIKE :cuerpo
             AND creado LIKE :creado
             ORDER BY $ordena";

$resultado = $pdo->prepare($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} elseif (!$resultado->execute([":categoria" => "%$categoria%", ":titulo" => "%$titulo%", ":cuerpo" => "%$cuerpo%", ":creado" => "%$ano%-%$mes%-%$dia%"])) {
    print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} elseif (!count($registros = $resultado->fetchAll())) {
    print "    <p class=\"aviso\">No se han encontrado registros.</p>\n";
} else {
    print "    <form action=\"$_SERVER[PHP_SELF]\" method=\"$cfg[formMethod]\">\n";
    print "      <p>\n";
    print "        <input type=\"hidden\" name=\"categoria\" value=\"$categoria\">\n";
    print "        <input type=\"hidden\" name=\"titulo\" value=\"$titulo\">\n";
    print "        <input type=\"hidden\" name=\"cuerpo\" value=\"$cuerpo\">\n";
    print "        <input type=\"hidden\" name=\"ano\" value=\"$ano\">\n";
    print "        <input type=\"hidden\" name=\"mes\" value=\"$mes\">\n";
    print "        <input type=\"hidden\" name=\"dia\" value=\"$dia\">\n";
    print "      </p>\n";
    print "\n";
    print "      <p>Registros encontrados:</p>\n";
    print "\n";
    print "      <table class=\"conborde franjas\">\n";
    print "        <thead>\n";
    print "          <tr>\n";
    print "            <th>\n";
    print "              <button name=\"ordena\" value=\"categoria ASC\" class=\"boton-invisible\">\n";
    print "                <img src=\"../../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
    print "              </button>\n";
    print "              Categoría\n";
    print "              <button name=\"ordena\" value=\"categoria DESC\" class=\"boton-invisible\">\n";
    print "                <img src=\"../../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
    print "              </button>\n";
    print "            </th>\n";
    print "            <th>\n";
    print "              <button name=\"ordena\" value=\"titulo ASC\" class=\"boton-invisible\">\n";
    print "                <img src=\"../../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
    print "              </button>\n";
    print "              Título\n";
    print "              <button name=\"ordena\" value=\"titulo DESC\" class=\"boton-invisible\">\n";
    print "                <img src=\"../../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
    print "              </button>\n";
    print "            </th>\n";
    print "            <th>\n";
    print "              <button name=\"ordena\" value=\"cuerpo ASC\" class=\"boton-invisible\">\n";
    print "                <img src=\"../../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
    print "              </button>\n";
    print "              Cuerpo\n";
    print "              <button name=\"ordena\" value=\"cuerpo DESC\" class=\"boton-invisible\">\n";
    print "                <img src=\"../../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
    print "              </button>\n";
    print "            </th>\n";
    print "            <th>\n";
    print "              <button name=\"ordena\" value=\"creado ASC\" class=\"boton-invisible\">\n";
    print "                <img src=\"../../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
    print "              </button>\n";
    print "              Creado\n";
    print "              <button name=\"ordena\" value=\"creado DESC\" class=\"boton-invisible\">\n";
    print "                <img src=\"../../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
    print "              </button>\n";
    print "            </th>\n";
    print "          </tr>\n";
    print "        </thead>\n";
    print "        <tbody>\n";
    foreach ($registros as $registro) {
        print "          <tr>\n";
        print "            <td>$registro[categoria]</td>\n";
        print "            <td>$registro[titulo]</td>\n";
        print "            <td>$registro[cuerpo]</td>\n";
        if ($registro["creado"] == "0000-00-00") {
            print "            <td></td>\n";
        } else {
            print "            <td>$registro[creado]</td>\n";
        }
        print "          </tr>\n";
    }
    print "        </tbody>\n";
    print "      </table>\n";
    print "    </form>\n";
}

$pdo = null;

pie();
