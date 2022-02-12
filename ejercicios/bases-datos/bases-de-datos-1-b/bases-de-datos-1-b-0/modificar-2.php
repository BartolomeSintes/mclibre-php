<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

$pdo = conectaDb();

cabecera("Modificar 2", MENU_VOLVER);

$id = recoge("id");

if ($id == "") {
    print "    <p class=\"aviso\">No se ha seleccionado ningún registro.</p>\n";
} else {
    $consulta = "SELECT * FROM $cfg[dbPersonasTabla]
                 WHERE id = :id";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":id" => $id])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        $registro = $resultado->fetch();
        print "    <form action=\"modificar-3.php\" method=\"$cfg[formMethod]\">\n";
        print "      <p>Modifique los campos que desee:</p>\n";
        print "\n";
        print "      <table>\n";
        print "        <tbody>\n";
        print "          <tr>\n";
        print "            <td>Nombre:</td>\n";
        print "            <td><input type=\"text\" name=\"nombre\" size=\"$cfg[formPersonasTamNombre]\" maxlength=\"$cfg[formPersonasTamNombre]\" value=\"$registro[nombre]\" autofocus></td>\n";
        print "          </tr>\n";
        print "          <tr>\n";
        print "            <td>Apellidos:</td>\n";
        print "            <td><input type=\"text\" name=\"apellidos\" size=\"$cfg[formPersonasTamApellidos]\" maxlength=\"$cfg[formPersonasTamApellidos]\" value=\"$registro[apellidos]\"></td>\n";
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

$pdo = null;

pie();
