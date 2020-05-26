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
cabecera("Personas - Modificar 2", MENU_PERSONAS, 1);

$id = recoge("id");

if ($id == "") {
    print "    <p class=\"aviso\">No se ha seleccionado ningún registro.</p>\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $tablaPersonas
       WHERE id=:id";
    $result = $db->prepare($consulta);
    $result->execute([":id" => $id]);
    if (!$result) {
        print "    <p class=\"aviso\">Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn() == 0) {
        print "    <p class=\"aviso\">Registro no encontrado.</p>\n";
    } else {
        $consulta = "SELECT * FROM $tablaPersonas
            WHERE id=:id";
        $result = $db->prepare($consulta);
        $result->execute([":id" => $id]);
        if (!$result) {
            print "    <p class=\"aviso\">Error en la consulta.</p>\n";
        } else {
            $valor = $result->fetch();
            print "    <form action=\"modificar-3.php\" method=\"" . FORM_METHOD . "\">\n";
            print "      <p>Modifique los campos que desee:</p>\n";
            print "\n";
            print "      <table>\n";
            print "        <tbody>\n";
            print "          <tr>\n";
            print "            <td>Nombre:</td>\n";
            print "            <td><input type=\"text\" name=\"nombre\" size=\"$tamPersonasNombre\" maxlength=\"$tamPersonasNombre\" value=\"$valor[nombre]\" autofocus></td>\n";
            print "          </tr>\n";
            print "          <tr>\n";
            print "            <td>Apellidos:</td>\n";
            print "            <td><input type=\"text\" name=\"apellidos\" size=\"$tamPersonasApellidos\" maxlength=\"$tamPersonasApellidos\" value=\"$valor[apellidos]\"></td>\n";
            print "          </tr>\n";
            print "          <tr>\n";
            print "            <td>DNI:</td>\n";
            print "            <td><input type=\"text\" name=\"dni\" size=\"$tamPersonasDni\" maxlength=\"$tamPersonasDni\" value=\"$valor[dni]\"></td>\n";
            print "          </tr>\n";
            print "        </tbody>\n";
            print "      </table>\n";
            print "\n";
            print "      <p>\n";
            print "        <input type=\"hidden\" name=\"id\" value=\"$id\">\n";
            print "        <input type=\"submit\" value=\"Actualizar\">\n";
            print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
            print "      </p>\n";
            print "    </form>\n";
        }
    }
}

$db = null;
pie();
