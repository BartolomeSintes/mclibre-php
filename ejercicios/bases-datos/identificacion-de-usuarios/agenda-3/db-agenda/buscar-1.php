<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../comunes/biblioteca.php";

session_name(SESSION_NAME);
session_start();
if (!isset($_SESSION["conectado"])) {
    header("Location:../index.php");
    exit;
}

$db = conectaDb();

cabecera("Agenda - Buscar 1", MENU_AGENDA, 1);

$consulta = "SELECT COUNT(*) FROM $tablaAgenda";
$result   = $db->query($consulta);
if (!$result) {
    print "    <p class=\"aviso\">Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p>No se ha creado todavía ningún registro.</p>\n";
} else {
    print "    <form action=\"buscar-2.php\" method=\"" . FORM_METHOD . "\">\n";
    print "      <p>Escriba el criterio de búsqueda (caracteres o números):</p>\n";
    print "\n";
    print "      <table>\n";
    print "        <tbody>\n";
    print "          <tr>\n";
    print "            <td>Nombre:</td>\n";
    print "            <td><input type=\"text\" name=\"nombre\" size=\"$tamAgendaNombre\" maxlength=\"$tamAgendaNombre\" autofocus></td>\n";
    print "          </tr>\n";
    print "          <tr>\n";
    print "            <td>Apellidos:</td>\n";
    print "            <td><input type=\"text\" name=\"apellidos\" size=\"$tamAgendaApellidos\" maxlength=\"$tamAgendaApellidos\"></td>\n";
    print "          </tr>\n";
    print "          <tr>\n";
    print "            <td>Teléfono:</td>\n";
    print "            <td><input type=\"text\" name=\"telefono\" size=\"$tamAgendaTelefono\" maxlength=\"$tamAgendaTelefono\"></td>\n";
    print "          </tr>\n";
    print "          <tr>\n";
    print "            <td>Correo:</td>\n";
    print "            <td><input type=\"text\" name=\"correo\" size=\"$tamAgendaCorreo\" maxlength=\"$tamAgendaCorreo\"></td>\n";
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

pie();
