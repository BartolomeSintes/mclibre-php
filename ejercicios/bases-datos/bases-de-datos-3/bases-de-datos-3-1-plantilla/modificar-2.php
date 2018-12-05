<?php
/**
 * Bases de datos 3-1 - modificar-2.php
 *
 * @author    Escriba su nombre
 *
 */

require_once "biblioteca.php";

$db = conectaDb();
cabecera("Modificar 2", MENU_VOLVER);

$id = recoge("id");

if ($id == "") {
    print "    <p>No se ha seleccionado ningún registro.</p>\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbTabla
       WHERE id=:id";
    $result = $db->prepare($consulta);
    $result->execute([":id" => $id]);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn() == 0) {
        print "    <p>Registro no encontrado.</p>\n";
    } else {
        $consulta = "SELECT * FROM $dbTabla
            WHERE id=:id";
        $result = $db->prepare($consulta);
        $result->execute([":id" => $id]);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
        } else {
            $valor = $result->fetch();
            print "    <form action=\"modificar-3.php\" method=\"" . FORM_METHOD . "\">\n";
            print "      <p>Modifique los campos que desee:</p>\n";
            print "\n";
            print "      <table>\n";
            print "        <tbody>\n";
            print "          <tr>\n";
            print "            <td>Nombre:</td>\n";
            print "            <td><input type=\"text\" name=\"nombre\" size=\"$tamNombre\" maxlength=\"$tamNombre\" value=\"$valor[nombre]\" autofocus=\"autofocus\" /></td>\n";
            print "          </tr>\n";
            print "          <tr>\n";
            print "            <td>Apellidos:</td>\n";
            print "            <td><input type=\"text\" name=\"apellidos\" size=\"$tamApellidos\" maxlength=\"$tamApellidos\" value=\"$valor[apellidos]\" /></td>\n";
            print "          </tr>\n";
            print "        </tbody>\n";
            print "      </table>\n";
            print "\n";
            print "      <p>\n";
            print "        <input type=\"hidden\" name=\"id\" value=\"$id\" />\n";
            print "        <input type=\"submit\" value=\"Actualizar\" />\n";
            print "        <input type=\"reset\" value=\"Reiniciar formulario\" />\n";
            print "      </p>\n";
            print "    </form>\n";
        }
    }
}

$db = null;
pie();
