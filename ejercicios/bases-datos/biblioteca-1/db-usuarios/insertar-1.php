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

cabecera("Usuarios - Añadir 1", MENU_USUARIOS, 1);

$consulta = "SELECT COUNT(*) FROM $tablaUsuarios";
$result   = $db->query($consulta);
if (!$result) {
    print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} elseif ($result->fetchColumn() >= MAX_REG_TABLE_USUARIOS) {
    print "    <p class=\"aviso\">Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
    print "\n";
    print "    <p class=\"aviso\">Por favor, borre algún registro antes de insertar un nuevo registro.</p>\n";
} else {
    print "    <form action=\"insertar-2.php\" method=\"" . FORM_METHOD . "\">\n";
    print "      <p>Escriba los datos del nuevo registro:</p>\n";
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
    print "        <input type=\"submit\" value=\"Añadir\">\n";
    print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
    print "      </p>\n";
    print "    </form>\n";
}

pie();
