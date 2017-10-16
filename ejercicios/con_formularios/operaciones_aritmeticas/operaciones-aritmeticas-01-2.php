<?php
/**
 * Operaciones aritmeticas 1-2 - operaciones-aritmeticas-01-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-11-04
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
  <title>Índice de masa corporal (Resultado). Operaciones aritméticas.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Índice de masa corporal (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$peso   = recoge("peso");
$altura = recoge("altura");

$pesoOk   = false;
$alturaOk = false;

if ($peso == "") {
    print "  <p class=\"aviso\">No ha escrito su peso.</p>\n\n";
} elseif (!is_numeric($peso)) {
    print "  <p class=\"aviso\">No ha escrito su peso como número.</p>\n\n";
} elseif ($peso <= 0) {
    print "  <p class=\"aviso\">El peso no puede ser negativo o cero.</p>\n\n";
} else {
    $pesoOk = true;
}

if ($altura == "") {
    print "  <p class=\"aviso\">No ha escrito su altura.</p>\n\n";
} elseif (!ctype_digit($altura)) {
    print "  <p class=\"aviso\">No ha escrito su altura como número entero positivo.</p>\n\n";
} elseif ($altura == 0) {
    print "  <p class=\"aviso\">La altura no puede ser cero.</p>\n\n";
} else {
    $alturaOk = true;
}

if ($pesoOk && $alturaOk) {
    $imc = round($peso / pow($altura / 100, 2));
    print "  <p>Con un peso de <strong>$peso kg</strong> y una altura de <strong>"
        . "$altura cm</strong>, su índice de masa corporal es <strong>$imc</strong>.</p>\n";
    print "\n";
    print "  <p>Un imc muy alto indica obesidad. Los valores \"normales\" de imc "
        . "están entre 20 y 25, pero esos límites dependen de la edad, del "
        . "sexo, de la constitución física, etc.</p>\n";
    print "\n";
}
?>
  <p><a href="operaciones-aritmeticas-01-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-04">4 de noviembre de 2016</time></p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
