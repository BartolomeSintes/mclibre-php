<?php
/**
 * Validación de formulario - validacion-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2010 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2010-03-25
 * @link      http://www.mclibre.org
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

function cabecera($texto)
{
    print "<!DOCTYPE html>\n";
    print "<html lang=\"es\">\n";
    print "<head>\n";
    print "  <meta charset=\"utf-8\" />\n";
    print "  <title>$texto. Validación.\n";
    print "    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco. www.mclibre.org</title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />\n";
    print "  <link rel=\"stylesheet\" type=\"text/css\" href=\"mclibre-php-ejercicios.css\" title=\"Color\" />\n";
    print "</head>\n";
    print "\n";
    print "<body>\n";
    print "  <h1>$texto</h1>\n";
    print "\n";
}

define("FORM_METHOD",  "get");
define("TAM_NOMBRE",   40);
define("TAM_TELEFONO", 9);
define("TAM_CORREO",   40);

$nombre   = recoge("nombre");
$telefono = recoge("telefono");
$correo   = recoge("correo");
$nombrePatron    = "/^[[:alpha:]]+$/";
$telefonoPatron  = "/^[0-9]{9}$/";
$correoPatron    = "/^[0-9abcdefghijklmnopqrstuvwxyz\._-]+@"
    . "[0-9abcdefghijklmnopqrstuvwxyz]+(\.[abcdefghijklmnopqrstuvwxyz]+){1,2}$/";
$nombreOk   = preg_match($nombrePatron,   $nombre);
$telefonoOk = preg_match($telefonoPatron, $telefono);
$correoOk   = preg_match($correoPatron,   $correo);

if (isset($_REQUEST["enviar"]) && $nombreOk && $telefonoOk && $correoOk) {
    cabecera("Validación de formulario (Resultado válido)");
    print "  <p>Los datos introducidos son correctos.</p>\n";
    print "\n";
    print "  <p>Nombre:<strong>$nombre</strong></p>\n";
    print "\n";
    print "  <p>Teléfono:<strong>$telefono</strong></p>\n";
    print "\n";
    print "  <p>Correo:<strong>$correo</strong></p>\n";
    print "\n";
    print "  <p><a href=\"$_SERVER[PHP_SELF]\">Volver al formulario</a></p>\n";
} else {
    if (isset($_REQUEST["enviar"])) {
        cabecera("Validación de formulario (Resultado inválido)");
        print"  <p>Por favor, corrija los datos incorrectos:</p>\n";
        print "\n";
    } else {
        cabecera("Validación de formulario (Formulario)");
        print"  <p>Escriba los datos siguientes:</p>\n";
        print "\n";
    }
    print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"" . FORM_METHOD . "\">\n";
    print "    <table>\n";
    print "      <tbody>\n";
    print "        <tr>\n";
    print "          <td>Nombre:</td>\n";
    print "          <td><input type=\"text\" name=\"nombre\" size=\""
        . TAM_NOMBRE . "\" maxlength=\"" . TAM_NOMBRE . "\" value=\"$nombre\" />";
    if (isset($_REQUEST["nombre"]) && !$nombreOk) {
        print " <span class=\"aviso\">El nombre no es correcto</span>";
    }
    print "</td>\n";
    print "        </tr>\n";
    print "        <tr>\n";
    print "          <td>Teléfono:</td>\n";
    print "          <td><input type=\"text\" name=\"telefono\" size=\""
        . TAM_TELEFONO . "\" maxlength=\"" . TAM_TELEFONO . "\" value=\"$telefono\" />";
    if (isset($_REQUEST["telefono"]) && !$telefonoOk) {
        print " <span class=\"aviso\">El teléfono no es correcto</span>";
    }
    print "</td>\n";
    print "        </tr>\n";
    print "        <tr>\n";
    print "          <td>Correo:</td>\n";
    print "          <td><input type=\"text\" name=\"correo\" size=\""
        . TAM_CORREO . "\" maxlength=\"" . TAM_CORREO . "\" value=\"$correo\" />";
    if (isset($_REQUEST["correo"]) && !$correoOk) {
        print " <span class=\"aviso\">El correo no es correcto</span>";
    }
    print "</td>\n";
    print "        </tr>\n";
    print "      </tbody>\n";
    print "    </table>\n";
    print "\n";
    if (isset($_REQUEST["enviar"])) {
        print "    <p><a href=\"$_SERVER[PHP_SELF]\">Volver al principio</a></p>\n";
        print "\n";
    }
    print "    <p class=\"der\"><input type=\"submit\" name=\"enviar\" value=\"Enviar\" /></p>\n";
    print "  </form>\n";
}
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2010-03-25">25 de marzo de 2010</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br />
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
