<?php
/**
 * Formulario 5-1 - cabeceras-05-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-11-10
 * @link      https://www.mclibre.org
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
  <meta charset="utf-8">
  <title>
    Formulario 5 (Formulario).
    Cabeceras. Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Formulario 5 (Formulario)</h1>

  <form action="cabeceras-05-2.php" method="get">
<?php
function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
        });
    }
    return $tmp;
}

// Recogemos la edad y el nombre y los avisos correspondientes
$nombre      = recoge("nombre");
$avisoNombre = recoge("avisoNombre");
$edad        = recoge("edad");
$avisoEdad   = recoge("avisoEdad");

print "    <table>\n";
print "      <tbody>\n";
print "        <tr>\n";
print "          <td><label for=\"nombre\">Escriba su nombre:</label></td>\n";
// Incluimos el nombre recibido (aunque sea en blanco) en el control
print "          <td><input type=\"text\" name=\"nombre\" value=\"$nombre\" size=\"20\" maxlength=\"20\" id=\"nombre\">";
// Si hemos recibido un aviso sobre el nombre, lo mostramos
if ($avisoNombre) {
    print " <span class=\"aviso\">$avisoNombre</span>";
}
print "</td>\n";
print "        </tr>\n";
print "        <tr>\n";
print "          <td><label for=\"edad\">Escriba su edad (entre 18 y 130 años):</label></td>\n";
// Incluimos la edad recibida (aunque sea en blanco) en el control
print "          <td><input type=\"text\" name=\"edad\" value=\"$edad\" size=\"5\" maxlength=\"3\" id=\"edad\">";
// Si hemos recibido un aviso sobre la edad, lo mostramos
if ($avisoEdad) {
    print " <span class=\"aviso\">$avisoEdad</span>";
}
print "</td>\n";
print "        </tr>\n";
print "      </tbody>\n";
print "    </table>\n";
print "\n";

?>
    <p>
      <input type="submit" value="Comprobar">
      <input type="reset" value="Borrar">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-11-10">10 de noviembre de 2019</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="https://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="https://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
