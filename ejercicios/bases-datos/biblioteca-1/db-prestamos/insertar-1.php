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
cabecera("Préstamos - Añadir 1", MENU_PRESTAMOS, 1);

$consulta = "SELECT COUNT(*) FROM $tablaPrestamos";
$result   = $db->query($consulta);
if (!$result) {
    print "    <p class=\"aviso\">Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() >= MAX_REG_TABLE_PRESTAMOS) {
    print "    <p class=\"aviso\">Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
    print "\n";
    print "    <p class=\"aviso\">Por favor, borre algún registro antes.</p>\n";
} else {
    $consulta2 = "SELECT * FROM $tablaPersonas ORDER BY apellidos";
    $result2   = $db->query($consulta2);
    $consulta3 = "SELECT * FROM $tablaObras ORDER BY autor";
    $result3   = $db->query($consulta3);
    if (!$result2) {
        print "    <p class=\"aviso\">Error en la consulta.</p>\n";
    } elseif (!$result3) {
        print "    <p class=\"aviso\">Error en la consulta.</p>\n";
    } else {
        print "    <form action=\"insertar-2.php\" method=\"" . FORM_METHOD . "\">\n";
        print "      <p>Escriba los datos del nuevo préstamo:</p>\n";
        print "\n";
        print "      <table>\n";
        print "        <tbody>\n";
        print "          <tr>\n";
        print "            <td>Persona:</td>\n";
        print "            <td>\n";
        print "            <select name=\"id_persona\">\n";
        print "                <option value=\"\"></option>\n";
        foreach ($result2 as $valor) {
            print "                <option value=\"$valor[id]\">$valor[nombre] $valor[apellidos]</option>\n";
        }
        print "              </select>\n";
        print "            </td>\n";
        print "          </tr>\n";
        print "          <tr>\n";
        print "            <td>Obra:</td>\n";
        print "            <td>\n";
        print "            <select name=\"id_obra\">\n";
        print "                <option value=\"\"></option>\n";
        foreach ($result3 as $valor) {
            print "                <option value=\"$valor[id]\">$valor[autor] - $valor[titulo]</option>\n";
        }
        print "              </select>\n";
        print "            </td>\n";
        print "          </tr>\n";
        print "          <tr>\n";
        print "            <td>Fecha de préstamo:</td>\n";
        print "            <td><input type=\"date\" name=\"prestado\" value=\"" . date("Y-m-j") . "\"></td>\n";
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
}

$db = null;
pie();
