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
        ? strip_tags(trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8")))
        : "";
    if (get_magic_quotes_gpc()) {
        $tmp = stripslashes($tmp);
    }
    return $tmp;
}

function cabecera($texto)
{ print "<?xml version=\"1.0\" encoding=\"utf-8\"?>
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
  \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <title>$texto. Validación. Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
  <link href=\"mclibre-php-soluciones.css\" rel=\"stylesheet\" type=\"text/css\"
  title=\"Color\" />
</head>\n\n<body>\n<h1>$texto</h1>\n";
}

define('FORM_METHOD',  'get');
define('TAM_NOMBRE',   40);
define('TAM_TELEFONO', 9);
define('TAM_CORREO',   40);

$nombre   = recoge("nombre");
$telefono = recoge('telefono');
$correo   = recoge('correo');
$nombrePatron   = '/^[[:alpha:]]+$/';
$telefonoPatron = '/^[0-9]{9}$/';
$correoPatron    = '/^[0-9abcdefghijklmnopqrstuvwxyz\._-]+@'
    .'[0-9abcdefghijklmnopqrstuvwxyz]+(\.[abcdefghijklmnopqrstuvwxyz]+){1,2}$/';
$nombreOk   = preg_match($nombrePatron,   $nombre);
$telefonoOk = preg_match($telefonoPatron, $telefono);
$correoOk   = preg_match($correoPatron,   $correo);

if (isset($_REQUEST['enviar']) && $nombreOk && $telefonoOk && $correoOk) {
    cabecera("Validación de formulario (Resultado válido)");
    print"  <p>Los datos introducidos son correctos.</p>
  <p>Nombre:<strong>$nombre</strong></p>
  <p>Teléfono:<strong>$telefono</strong></p>
  <p>Correo:<strong>$correo</strong></p>
  <p><a href=\"$_SERVER[PHP_SELF]\">Volver al principio</a></p>\n";
} else {
    if (isset($_REQUEST['enviar'])) {
        cabecera("Validación de formulario (Resultado inválido)");
        print"<p>Por favor, corrija los datos incorrectos:</p>\n";
    } else {
        cabecera("Validación de formulario (Formulario)");
        print"<p>Escriba los datos siguientes:</p>\n";
    }
    print "<form action=\"$_SERVER[PHP_SELF]\" method=\"".FORM_METHOD."\">
  <table>\n    <tbody>\n      <tr>\n        <td>Nombre:</td>
        <td><input type=\"text\" name=\"nombre\" size=\"".TAM_NOMBRE."\"
          maxlength=\"".TAM_NOMBRE."\" value=\"$nombre\" />";
    if (isset($_REQUEST['nombre']) && !$nombreOk) {
        print " <span class=\"aviso\">El nombre no es correcto</span>";
    }
    print "</td>\n      </tr>\n      <tr>\n        <td>Teléfono:</td>
        <td><input type=\"text\" name=\"telefono\" size=\"".TAM_TELEFONO."\"
          maxlength=\"".TAM_TELEFONO."\" value=\"$telefono\" />";
    if (isset($_REQUEST['telefono']) && !$telefonoOk) {
        print " <span class=\"aviso\">El teléfono no es correcto</span>";
    }
    print "</td>\n      </tr>\n      <tr>\n        <td>Correo:</td>
        <td><input type=\"text\" name=\"correo\" size=\"".TAM_CORREO."\"
          maxlength=\"".TAM_CORREO."\" value=\"$correo\" />";
    if (isset($_REQUEST['correo']) && !$correoOk) {
        print " <span class=\"aviso\">El correo no es correcto</span>";
    }
    print "</td>\n      </tr>\n    </tbody>\n  </table>\n";
    if (isset($_REQUEST['enviar'])) {
        print "  <p><a href=\"$_SERVER[PHP_SELF]\">Volver al principio</a></p>\n";
    }
    print "  <p class=\"der\"><input type=\"submit\" name=\"enviar\" value=\"Enviar\" /></p>\n";
    print "</form>\n";
}
print '<address>
  Esta página forma parte del curso "Páginas web con PHP" disponible en <a
  href="http://www.mclibre.org/">http://www.mclibre.org</a><br />
  Autor: Bartolomé Sintes Marco<br />
  Última modificación de esta página: 25 de marzo de 2010
</address>

<p class="licencia">El programa PHP que genera esta página está bajo
<a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o
posterior</a>.</p>
</body>
</html>';
/*
 * 2008-01-22
 * Este print está con comillas para poder buscar y sustituir el contenido
 * junto con el resto de ficheros.
 * También podría ponerlo fuera del bloque PHP, pero entonces Eclipse dice
 * que hay un error en la página.
 */
?>
