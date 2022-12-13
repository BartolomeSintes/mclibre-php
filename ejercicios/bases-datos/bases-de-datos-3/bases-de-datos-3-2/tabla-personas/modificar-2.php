<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

if (!isset($_SESSION["conectado"])) {
    header("Location:../index.php");
    exit;
}

$pdo = conectaDb();

cabecera("Modificar 2", MENU_PERSONAS, PROFUNDIDAD_1);

$id = recoge("id");

if ($id == "") {
    print "    <p class=\"aviso\">No se ha seleccionado ningún registro.</p>\n";
} else {
    $consulta = "SELECT * FROM $cfg[tablaPersonas]
                 WHERE id = :id";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":id" => $id])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!($registro = $resultado->fetch())) {
        print "    <p class=\"aviso\">Registro no encontrado.</p>\n";
    } else {
        print "    <form action=\"modificar-3.php\" method=\"$cfg[formMethod]\">\n";
        print "      <p>Modifique los campos que desee:</p>\n";
        print "\n";
        print "      <table>\n";
        print "        <tr>\n";
        print "          <td>Nombre:</td>\n";
        print "          <td><input type=\"text\" name=\"nombre\" size=\"$cfg[formPersonasTamNombre]\" maxlength=\"$cfg[formPersonasTamNombre]\" value=\"$registro[nombre]\" autofocus></td>\n";
        print "        </tr>\n";
        print "        <tr>\n";
        print "          <td>Apellidos:</td>\n";
        print "          <td><input type=\"text\" name=\"apellidos\" size=\"$cfg[formPersonasTamApellidos]\" maxlength=\"$cfg[formPersonasTamApellidos]\" value=\"$registro[apellidos]\"></td>\n";
        print "        </tr>\n";
        print "        <tr>\n";
        print "          <td>Teléfono:</td>\n";
        print "          <td><input type=\"text\" name=\"telefono\" size=\"$cfg[formPersonasTamTelefono]\" maxlength=\"$cfg[formPersonasTamTelefono]\" value=\"$registro[telefono]\"></td>\n";
        print "        </tr>\n";
        print "        <tr>\n";
        print "          <td>Correo:</td>\n";
        print "          <td><input type=\"text\" name=\"correo\" size=\"$cfg[formPersonasTamCorreo]\" maxlength=\"$cfg[formPersonasTamCorreo]\" value=\"$registro[correo]\"></td>\n";
        print "        </tr>\n";
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

$pdo = null;

pie();
