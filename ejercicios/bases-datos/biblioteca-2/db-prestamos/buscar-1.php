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
cabecera("Préstamos - Buscar 1", MENU_PRESTAMOS, 1);

$consulta = "SELECT COUNT(*) FROM $tablaPrestamos";
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
    print "            <td>Persona - Nombre:</td>\n";
    print "            <td><input type=\"text\" name=\"nombre\" size=\"$tamPersonasNombre\" maxlength=\"$tamPersonasNombre\" autofocus></td>\n";
    print "          </tr>\n";
    print "          <tr>\n";
    print "            <td>Persona - Apellidos:</td>\n";
    print "            <td><input type=\"text\" name=\"apellidos\" size=\"$tamPersonasApellidos\" maxlength=\"$tamPersonasApellidos\"></td>\n";
    print "          </tr>\n";
    print "          <tr>\n";
    print "            <td>Obra - Autor:</td>\n";
    print "            <td><input type=\"text\" name=\"autor\" size=\"$tamObrasAutor\" maxlength=\"$tamObrasAutor\" autofocus></td>\n";
    print "          </tr>\n";
    print "          <tr>\n";
    print "            <td>Obra - Título:</td>\n";
    print "            <td><input type=\"text\" name=\"titulo\" size=\"$tamObrasTitulo\" maxlength=\"$tamObrasTitulo\"></td>\n";
    print "          </tr>\n";
    print "          <tr>\n";
    print "            <td>Fecha de préstamo:</td>\n";
    print "            <td>Entre <input type=\"date\" name=\"prestado_1\"> y <input type=\"date\" name=\"prestado_2\"></td>\n";
    print "          </tr>\n";
    print "          <tr>\n";
    print "            <td>Fecha de devolución:</td>\n";
    print "            <td>Entre <input type=\"date\" name=\"devuelto_1\"> y <input type=\"date\" name=\"devuelto_2\"></td>\n";
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
