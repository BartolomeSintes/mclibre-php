<?php
/**
 * Formulario 5-1 - cabeceras_05_1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-11-09
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
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Formulario 5 (Formulario). Cabeceras.
      Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="mclibre_php_soluciones.css" rel="stylesheet" type="text/css" title="Color" />
  </head>

  <body>
    <h1>Formulario 5 (Formulario)</h1>

    <form action="cabeceras_05_2.php" method="get">
<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

$nombre      = recoge("nombre");
$avisoNombre = recoge("avisoNombre");
$edad        = recoge("edad");
$avisoEdad   = recoge("avisoEdad");

print "      <table>\n";
print "        <tbody>\n";
print "          <tr>\n";
print "            <td>Escriba su nombre:</td>\n";
print "            <td><input type=\"text\" name=\"nombre\" value=\"$nombre\" size=\"20\" maxlength=\"20\" />";
if ($avisoNombre) {
    print " <span class=\"aviso\">$avisoNombre</span>";
}
print "</td>\n";
print "          </tr>\n";
print "          <tr>\n";
print "            <td>Escriba su edad (entre 18 y 130 años):</td>\n";
print "            <td><input type=\"text\" name=\"edad\" value=\"$edad\" size=\"5\" maxlength=\"3\" />";
if ($avisoEdad) {
    print " <span class=\"aviso\">$avisoEdad</span>";
}
print "</td>\n";
print "          </tr>\n";
print "        </tbody>\n";
print "      </table>\n";
print "\n";

?>
      <p>
        <input type="submit" value="Comprobar" />
        <input type="reset" value="Borrar" />
      </p>
    </form>

    <footer>
      <p class="ultmod">
        Última modificación de esta página:
        <time datetime="2016-11-09">9 de noviembre de 2016</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
    </footer>
  </body>
</html>
