<?php
/**
 * Operaciones aritmeticas 4-2 - operaciones-aritmeticas-04-2.php
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
  <title>Convertidor de segundos a horas, minutos y segundos (Resultado). Operaciones aritméticas.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Convertidor de segundos a horas, minutos y segundos (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$segundos = recoge("segundos");

$segundosOk = false;

if ($segundos == "") {
    print "  <p class=\"aviso\">No ha escrito el número de segundos.</p>\n";
    print "\n";
} elseif (!ctype_digit($segundos)) {
    print "  <p class=\"aviso\">No ha escrito los segundos como número entero positivo.</p>\n";
    print "\n";
} else {
    $segundosOk = true;
}

if ($segundosOk) {
    $h = floor($segundos / 3600);
    $m = floor($segundos % 3600 / 60);
    $s = $segundos % 60;
    print "  <p>$segundos segundos son $h horas, $m minutos y $s segundos</p>\n";
    print "\n";
}
?>
  <p><a href="operaciones-aritmeticas-04-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-04">4 de noviembre de 2016</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
