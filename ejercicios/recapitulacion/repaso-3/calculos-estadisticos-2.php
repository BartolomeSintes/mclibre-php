<?php
/**
 * Cálculos estadísticos 2 (Formulario) calculos-estadisticos-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2011 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-11-16
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

function cabecera($texto)
{
    print "<!DOCTYPE html>\n";
    print "<html lang=\"es\">\n";
    print "<head>\n";
    print "  <meta charset=\"utf-8\">\n";
    print "  <title>\n";
    print "    Calculos estadísticos 2 ($texto). Repaso 3.\n";
    print "    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org\n";
    print "  </title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    print "  <link rel=\"stylesheet\" href=\"mclibre-php-ejercicios.css\" title=\"Color\">\n";
    print "</head>\n";
    print "\n";
    print "<body>\n";
    print "  <h1>Calculos estadísticos 2 ($texto)</h1>\n";
    print "\n";
}

function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = is_array($m) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var]));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor));
        });
    }
    return $tmp;
}

define("FORM_METHOD",         "get");
define("NUM_VALORES_INICIAL", 4);
define("NUM_VALORES_MINIMO",  2);
define("NUM_VALORES_MAXIMO",  15);

$valores       = recoge("valor", []);
$valoresOk     = [];
$valoresTodoOk = true;
$suma          = (recoge("suma") == "on");
$media         = (recoge("media") == "on");
$maximo        = (recoge("maximo") == "on");
$minimo        = (recoge("minimo") == "on");

// Recoge el número de datos y lo valida, aumenta o reduce
$numeroValores = recoge("numeroValores");

if ($numeroValores<NUM_VALORES_MINIMO) {
    $numeroValores = NUM_VALORES_MINIMO;
} elseif ($numeroValores>NUM_VALORES_MAXIMO) {
    $numeroValores = NUM_VALORES_MAXIMO;
}

if (isset($_REQUEST["anyadir"]) && ($numeroValores<NUM_VALORES_MAXIMO)) {
    $numeroValores++;
    $valores[$numeroValores] = "";  // Al añdir se crea un nuevo valor vacío
} elseif (isset($_REQUEST["quitar"]) && ($numeroValores>NUM_VALORES_MINIMO)) {
    $numeroValores--;
}

for ($i=1; $i<=$numeroValores; $i++) {
    $valoresOk[$i] = true;
    if (!isset($valores[$i])) {  // Por si falta un valor en la matriz
        $valoresTodoOk = false;
        $valores[$i] = "";
    } elseif ($valores[$i] == "") {  // Por si un valor es vacío
        $valoresTodoOk = false;
    } elseif ($valores[$i] != "" && !is_numeric($valores[$i])) {  // Por si un valor no es numérico
        $valoresOk[$i] = false;
        $valoresTodoOk = false;
    }
}

$valoresTodoVacio = true;
for ($i=1; $i<=$numeroValores; $i++) {
    if ($valores[$i] != "") {
        $valoresTodoVacio = false;
    }
}

if ($valoresTodoOk) {
    cabecera("Resultado válido");
    $sumaTotal = 0;
    print "  <p>Ha introducido $numeroValores valores: <strong>";
    foreach ($valores as $valor) {
        print "$valor ";
        $sumaTotal += $valor;
    }
    print "</strong></p>\n";
    print "\n";

    if ($suma) {
        print "  <p>La suma de los valores es <strong>$sumaTotal</strong>.</p>\n";
        print "\n";
    }
    if ($media) {
        print "  <p>La media de los valores es <strong>"
            . round($sumaTotal/$numeroValores, 2) . "</strong>.</p>\n";
        print "\n";
    }
    if ($maximo) {
        print "  <p>El valor más grande es <strong>" . max($valores) . "</strong>.</p>\n";
        print "\n";
    }
    if ($minimo) {
        print "  <p>El valor más pequeño es <strong>" . min($valores) . "</strong>.</p>\n";
        print "\n";
    }
    print "  <p><a href=\"$_SERVER[PHP_SELF]\">Volver al principio</a></p>\n";
    print "\n";
} elseif (!$valoresTodoVacio&&(isset($_REQUEST["enviar"])||
        isset($_REQUEST["anyadir"])||isset($_REQUEST["quitar"]))) {
    cabecera("Resultado inválido");
    print"  <p>Por favor, corrija los datos incorrectos y/o complete todas las casillas:</p>\n";
    print "\n";
    print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"" . FORM_METHOD . "\">\n";
    print "    <table>\n";
    for ($i=1; $i<=$numeroValores; $i++) {
        print "      <tr>\n";
        print "        <td>Valor $i:</td>\n";
        print "        <td><input type=\"text\" name=\"valor[$i]\" size=\"5\" value=\"";
        if (isset($valores[$i])) {
            print $valores[$i];
        }
        print "\">";
        if (!$valoresOk[$i]) {
            print " <span class=\"aviso\">El valor no es correcto</span>";
        } elseif ($valores[$i] == "") {
            print " <span class=\"aviso\">Escriba un valor</span>";
        }
        print "</td>\n";
        print "      </tr>\n";
    }
    print "    </table>";
    print "\n";
    print "  <p>\n";
    print "    <input type=\"checkbox\" name=\"suma\" ";
    if ($suma) {
        print "checked ";
    }
    print ">Suma -\n";
    print "    <input type=\"checkbox\" name=\"media\" ";
    if ($media) {
        print "checked ";
    }
    print ">Media - \n";
    print "    <input type=\"checkbox\" name=\"maximo\" ";
    if ($maximo) {
        print "checked ";
    }
    print ">Máximo - \n";
    print "    <input type=\"checkbox\" name=\"minimo\" ";
    if ($minimo) {
        print "checked ";
    }
    print ">Mínimo\n";
    print "    </p>";
    print "\n";
    print "    <p class=\"der\">\n";
    print "      <input type=\"hidden\" name=\"numeroValores\" value=\"$numeroValores\">\n";
    print "      <input type=\"submit\" name=\"enviar\" value=\"Enviar\">\n";
    print "      <input type=\"submit\" name=\"anyadir\" value=\"Añadir valor\">\n";
    print "      <input type=\"submit\" name=\"quitar\" value=\"Quitar valor\">\n";
    print "      <input type=\"reset\" value=\"Borrar\">\n";
    print "    </p>\n";
    print "  </form>\n";
} else {
    cabecera("Formulario");
    print"  <p>Escriba $numeroValores números:</p>\n";
    print "\n";
    print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"" . FORM_METHOD . "\">";
    print "    <table>\n";
    for ($i=1; $i<=$numeroValores; $i++) {
        print "      <tr>\n";
        print "        <td>Valor $i:</td>\n";
        print "        <td><input type=\"text\" name=\"valor[$i]\" size=\"5\" value=\"";
        if (isset($valores[$i])) {
            print $valores[$i];
        }
        print "\">";
        if (!$valoresOk[$i]) {
            print " <span class=\"aviso\">El valor no es correcto</span>";
        }
        print "</td>\n";
        print "      </tr>\n";
    }
    print "    </table>\n";
    print "\n";
    print "    <p>\n";
    print "      <input type=\"checkbox\" name=\"suma\" ";
    if ($suma) {
        print "checked ";
    }
    print "> Suma -\n";
    print "      <input type=\"checkbox\" name=\"media\" ";
    if ($media) {
        print "checked ";
    }
    print "> Media - \n";
    print "      <input type=\"checkbox\" name=\"maximo\" ";
    if ($maximo) {
        print "checked ";
    }
    print "> Máximo - \n";
    print "      <input type=\"checkbox\" name=\"minimo\" ";
    if ($minimo) {
        print "checked ";
    }
    print "> Mínimo\n";
    print "    </p>\n";
    print "\n";
    print "    <p class=\"der\">\n";
    print "      <input type=\"hidden\" name=\"numeroValores\" value=\"$numeroValores\">\n";
    print "      <input type=\"submit\" name=\"enviar\" value=\"Enviar\">\n";
    print "      <input type=\"submit\" name=\"anyadir\" value=\"Añadir valor\">\n";
    print "      <input type=\"submit\" name=\"quitar\" value=\"Quitar valor\">\n";
    print "      <input type=\"reset\" value=\"Borrar\">\n";
    print "    </p>\n";
    print "  </form>\n";
    print "\n";
}

print "  <footer>\n";
print "    <p class=\"ultmod\">\n";
print "      Última modificación de esta página:\n";
print "      <time datetime=\"2011-11-16\">16 de noviembre de 2011</time>\n";
print "    </p>\n";
print "\n";
print "    <p class=\"licencia\">\n";
print "      Este programa forma parte del curso <strong><a href=\"https://www.mclibre.org/consultar/php/\">Programación \n";
print "      web en PHP</a></strong> de <a href=\"https://www.mclibre.org/\" rel=\"author\">Bartolomé Sintes Marco</a>.<br>\n";
print "      El programa PHP que genera esta página se distribuye bajo \n";
print "      <a rel=\"license\" href=\"http://www.gnu.org/licenses/agpl.txt\">licencia AGPL 3 o posterior</a>.\n";
print "    </p>\n";
print "  </footer>\n";
print "</body>\n";
print "</html>\n";
?>
