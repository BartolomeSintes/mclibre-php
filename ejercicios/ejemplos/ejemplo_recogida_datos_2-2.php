<?php
/**
 * Ejemplo de recogida y comprobación de datos - ejemplo_recogida_datos_2-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-10-26
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
    <title>Ejemplo de recogida y comprobación de datos (Resultado). Ejemplo de ejercicio.
      Ejercicios. PHP. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="mclibre_php_soluciones.css" rel="stylesheet" type="text/css" title="Color" />
  </head>

  <body>
    <h1>Ejemplo de recogida y comprobación de datos (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$nombre = recoge("nombre");
$edad   = recoge("edad");
$acepto = recoge("acepto");

$nombreOk = false;
$edadOk   = false;
$aceptoOk = false;

if ($nombre == "") {
    print "    <p class=\"aviso\">No ha escrito su nombre.</p>\n";
    print "\n";
} else {
    $nombreOk = true;
}

if ($edad == "") {
    print "    <p class=\"aviso\">No ha escrito su edad.</p>\n";
    print "\n";
} elseif (!is_numeric($edad)) {
    print "    <p class=\"aviso\">No ha escrito la edad como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($edad)) {
    print "    <p class=\"aviso\">No ha escrito la edad como número entero.</p>\n";
    print "\n";
} elseif ($edad < 1 || $edad > 120) {
    print "    <p class=\"aviso\">La edad no está entre 1 y 120 años.</p>\n";
    print "\n";
} else {
    $edadOk = true;
}

if ($acepto == "") {
    print "    <p class=\"aviso\">No ha indicado si acepta las condiciones.</p>\n";
    print "\n";
} elseif ($acepto != "Sí" && $acepto != "No") {
    print "    <p class=\"aviso\">Por favor, utilice el formulario.</p>\n";
    print "\n";
} else {
    $aceptoOk = true;
}

if ($nombreOk && $edadOk && $aceptoOk) {
    print "    <p>Su nombre es <strong>$nombre</strong>.</p>\n";
    print "\n";
    print "    <p>Su edad es <strong>$edad</strong> años.</p>\n";
    print "\n";
    print "    <p><strong>$acepto</strong> acepta las condiciones.</p>\n";
    print "\n";
}

?>
    <p><a href="ejemplo_recogida_datos_2-1.php">Volver al formulario.</a></p>

    <footer>
      <p class="ultmod">
        Última modificación de esta página:
        <time datetime="2016-10-26">26 de octubre de 2016</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
    </footer>
  </body>
</html>
