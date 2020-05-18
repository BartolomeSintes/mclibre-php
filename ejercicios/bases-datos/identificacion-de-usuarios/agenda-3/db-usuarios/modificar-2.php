<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
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
cabecera("Usuarios - Modificar 2", MENU_USUARIOS, 1);

$id = recoge("id");

if ($id == "") {
    print "    <p>No se ha seleccionado ningún registro.</p>\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $tablaUsuarios
       WHERE id=:id";
    $result = $db->prepare($consulta);
    $result->execute([":id" => $id]);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn() == 0) {
        print "    <p>Registro no encontrado.</p>\n";
    } else {
        $consulta = "SELECT * FROM $tablaUsuarios
            WHERE id=:id";
        $result = $db->prepare($consulta);
        $result->execute([":id" => $id]);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
        } else {
            $valor = $result->fetch();
            if ($valor["usuario"] == ROOT_NAME) {
                print "    <p>Este usuario no se puede modificar.</p>\n";
            } else {
                print "    <form action=\"modificar-3.php\" method=\"" . FORM_METHOD . "\">\n";
                print "      <p>Modifique los campos que desee (deje la contraseña en blanco para mantenerla):</p>\n";
                print "\n";
                print "      <table>\n";
                print "        <tbody>\n";
                print "          <tr>\n";
                print "            <td>Usuario:</td>\n";
                print "            <td><input type=\"text\" name=\"usuario\" size=\"$tamUsuariosUsuario\" maxlength=\"$tamUsuariosUsuario\" value=\"$valor[usuario]\" autofocus></td>\n";
                print "          </tr>\n";
                print "          <tr>\n";
                print "            <td>Contraseña:</td>\n";
                print "            <td><input type=\"text\" name=\"password\" size=\"$tamUsuariosPassword\" maxlength=\"$tamUsuariosPassword\"></td>\n";
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
}

$db = null;
pie();
