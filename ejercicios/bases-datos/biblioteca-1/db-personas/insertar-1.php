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
cabecera("Personas - Añadir 1", MENU_PERSONAS, 1);

$consulta = "SELECT COUNT(*) FROM $tablaPersonas";
$result   = $db->query($consulta);
if (!$result) {
    print "    <p class=\"aviso\">Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() >= MAX_REG_TABLE_PERSONAS) {
    print "    <p class=\"aviso\">Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
    print "\n";
    print "    <p class=\"aviso\">Por favor, borre algún registro antes.</p>\n";
} else {
    print "    <form action=\"insertar-2.php\" method=\"" . FORM_METHOD . "\">\n";
    print "      <p>Escriba los datos del nuevo registro:</p>\n";
    print "\n";
    print "      <table>\n";
    print "        <tbody>\n";
    print "          <tr>\n";
    print "            <td>Nombre:</td>\n";
    print "            <td><input type=\"text\" name=\"nombre\" size=\"$tamPersonasNombre\" maxlength=\"$tamPersonasNombre\" autofocus></td>\n";
    print "          </tr>\n";
    print "          <tr>\n";
    print "            <td>Apellidos:</td>\n";
    print "            <td><input type=\"text\" name=\"apellidos\" size=\"$tamPersonasApellidos\" maxlength=\"$tamPersonasApellidos\"></td>\n";
    print "          </tr>\n";
    print "          <tr>\n";
    print "            <td>DNI:</td>\n";
    print "            <td><input type=\"text\" name=\"dni\" size=\"$tamPersonasDni\" maxlength=\"$tamPersonasDni\"></td>\n";
    print "          </tr>\n";
    print "        </tbody>\n";
    print "      </table>\n";
    print "\n";
    print "      <p>\n";
    print "        <input type=\"submit\" value=\"Añadir\">\n";
    print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
    print "      </p>\n";
    print "    </form>\n";
}

$db = null;
pie();
