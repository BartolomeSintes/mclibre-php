<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
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

cabecera("Usuarios - Buscar 1", MENU_USUARIOS, 1);

$consulta = "SELECT COUNT(*) FROM $tablaUsuarios";
$result   = $db->query($consulta);
if (!$result) {
    print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p class=\"aviso\">No se ha creado todavía ningún registro.</p>\n";
} else {
    print "    <form action=\"buscar-2.php\" method=\"" . FORM_METHOD . "\">\n";
    print "      <p>Escriba el criterio de búsqueda (caracteres o números):</p>\n";
    print "\n";
    print "      <table>\n";
    print "        <tr>\n";
    print "          <td>Usuario:</td>\n";
    print "          <td><input type=\"text\" name=\"usuario\" size=\"$tamUsuariosUsuario\" maxlength=\"$tamUsuariosUsuario\" autofocus></td>\n";
    print "        </tr>\n";
    print "        <tr>\n";
    print "          <td>Contraseña:</td>\n";
    print "          <td><input type=\"text\" name=\"password\" size=\"$tamUsuariosPassword\" maxlength=\"$tamUsuariosPassword\"></td>\n";
    print "        </tr>\n";
    print "        <tr>\n";
    print "          <td>Nivel:</td>\n";
    print "          <td>\n";
    print "            <select name=\"nivel\">\n";
    foreach ($usuariosNiveles as $indice => $valor) {
        print "              <option value=\"$valor\">$indice</option>\n";
    }
    print "            </select>\n";
    print "          </td>\n";
    print "        </tr>\n";
    print "      </table>\n";
    print "\n";
    print "      <p>\n";
    print "        <input type=\"submit\" value=\"Buscar\">\n";
    print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
    print "      </p>\n";
    print "    </form>\n";
}

pie();
