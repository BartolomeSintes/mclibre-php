<?php
/**
 * Contador de días (Resultado 1) - contador-dias-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2015 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2015-11-18
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
    Contador de días (Resultado 1). Repaso (1).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Contador de días (Resultado 1)</h1>

<?php
// Funciones auxiliares
// Función de recogida de datos
function recoge($key, $type = "")
{
    if ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): argument #2 (\$type) must be an empty array or an empty string.", E_USER_ERROR);
    }
    $tmp = is_array($type) ? [] : "";
    if (isset($_REQUEST[$key])) {
        if (!is_array($_REQUEST[$key]) && !is_array($type)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$key]));
        } elseif (is_array($_REQUEST[$key]) && is_array($type)) {
            $tmp = $_REQUEST[$key];
            array_walk_recursive($tmp, function (&$value) {
                $value = trim(htmlspecialchars($value));
            });
        }
    }
    return $tmp;
}

// Recogida de datos
$numero   = recoge("numero");
$numeroOk = false;
$minimo   = 1;
$maximo   = 20;

// Comprobación de $numero
if ($numero == "") {
    print "  <p class=\"aviso\">No ha escrito el número de semanas.</p>\n";
    print "\n";
} elseif (!is_numeric($numero)) {
    print "  <p class=\"aviso\">No ha escrito un número.</p>\n";
    print "\n";
} elseif (!ctype_digit($numero)) {
    print "  <p class=\"aviso\">No ha escrito el número de semanas "
         . "como número entero positivo.</p>\n";
    print "\n";
} elseif ($numero < $minimo || $numero > $maximo) {
    print "  <p class=\"aviso\">El número de semanas debe estar entre $minimo "
        . " y $maximo.</p>\n";
    print "\n";
} else {
    $numeroOk = true;
}

// Si el valor recibido es correcto ...
if ($numeroOk) {
    print "  <form action=\"contador-dias-3.php\" method=\"get\">\n";
    print "    <p>Marque las casillas de verificación que quiera y contaré cuántas ha marcado.</p>\n";
    print "\n";
    print "    <table class=\"conborde\" style=\"text-align: center\">\n";
    print "      <tr>\n";
    print "        <th>Semana</th>\n";
    print "        <th>Lunes</th>\n";
    print "        <th>Martes</th>\n";
    print "        <th>Miércoles</th>\n";
    print "        <th>Jueves</th>\n";
    print "        <th>Viernes</th>\n";
    print "        <th>Sábado</th>\n";
    print "        <th>Domingo</th>\n";
    print "      </tr>\n";
    for ($i = 1; $i <= $numero; $i++) {
        print "      <tr>\n";
        print "        <th>$i</th>\n";
        for ($j = 1; $j <= 7; $j++) {
            print "        <td><input type=\"checkbox\" name=\"c[$i][$j]\"></td>\n";
        }
        print "      </tr>\n";
    }
    print "    </table>\n";
    print "\n";
    print "    <p>\n";
    print "      <input type=\"submit\" value=\"Contar\">\n";
    print "      <input type=\"reset\" value=\"Borrar\">\n";
    print "    </p>\n";
    print "\n";
    print "    <p><input type=\"hidden\" name=\"numero\" value=\"$numero\"></p>\n";
    print "  </form>\n";
    print "\n";
}

?>
  <p><a href="contador-dias-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2015-11-18">18 de noviembre de 2015</time>
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
