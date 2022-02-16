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

cabecera("Noticias - Buscar 1", MENU_NOTICIAS, PROFUNDIDAD_2);

$consulta = "SELECT COUNT(*) FROM $cfg[dbNoticiasTabla]";

$resultado = $pdo->query($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} elseif ($resultado->fetchColumn() == 0) {
    print "    <p class=\"aviso\">No se ha creado todavía ningún registro.</p>\n";
} else {
    print "    <form action=\"buscar-2.php\" method=\"$cfg[formMethod]\">\n";
    print "      <p>Escriba el criterio de búsqueda (caracteres o números):</p>\n";
    print "\n";
    print "      <table>\n";
    print "        <tbody>\n";
    print "          <tr>\n";
    print "            <td>Categoría:</td>\n";
    print "            <td><input type=\"text\" name=\"categoria\" size=\"$cfg[formNoticiasTamCategoria]\" maxlength=\"$cfg[formNoticiasTamCategoria]\" autofocus></td>\n";
    print "          </tr>\n";
    print "          <tr>\n";
    print "            <td>Título:</td>\n";
    print "            <td><input type=\"text\" name=\"titulo\" size=\"$cfg[formNoticiasTamTitulo]\" maxlength=\"$cfg[formNoticiasTamTitulo]\"></td>\n";
    print "          </tr>\n";
    print "          <tr>\n";
    print "            <td>Cuerpo:</td>\n";
    print "            <td><textarea name=\"cuerpo\" rows=\"$cfg[formNoticiasTamCuerpoY]\" cols=\"$cfg[formNoticiasTamCuerpoX]\"></textarea></td>\n";
    print "          </tr>\n";
    print "          <tr>\n";
    print "            <td>Creado:</td>\n";
    print "            <td>\n";
    print "              Año: <input type=\"number\" name=\"ano\" size=\"7\" maxlength=\"4\">\n";
    print "              Mes: <input type=\"number\" name=\"mes\" size=\"5\" maxlength=\"2\" min=\"1\" max=\"12\">\n";
    print "              Día: <input type=\"number\" name=\"dia\" size=\"5\" maxlength=\"2\">\n";
    print "            </td>\n";
    print "          </tr>\n";
    print "        </tbody>\n";
    print "      </table>\n";
    print "\n";
    print "      <p>\n";
    print "        <input type=\"submit\" value=\"Buscar\">\n";
    print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
    print "      </p>\n";
    print "    </form>\n";
}

$pdo = null;

pie();
