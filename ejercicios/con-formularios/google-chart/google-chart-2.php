<?php
/**
 * Crea gráfica de líneas - google-chart-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-02-10
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
    print "    Crea gráfica de líneas. ($texto). Google Chart.\n";
    print "    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org\n";
    print "  </title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    print "  <link rel=\"stylesheet\" href=\"mclibre-php-ejercicios.css\" title=\"Color\">\n";
    print "</head>\n";
    print "\n";
    print "<body>\n";
    print "  <h1>Crea gráfica de líneas ($texto)</h1>\n";
    print "\n";
}

function limpia($var)
{
    return trim(strip_tags($var));
}

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

function recogeNumero($var, $inicial, $minimo, $maximo) {
    $tmp = recoge($var);
    if (!is_numeric($tmp)) {
        return $inicial;
    } elseif ($tmp < $minimo) {
        return $minimo;
    } elseif ($tmp > $maximo) {
        return $maximo;
    } else {
        return $tmp;
    }
}

function recogeTexto($var, $inicial, $valores) {
    $tmp = recoge($var);
    foreach ($valores as $valor) {
        if ($tmp == $valor) {
            return $tmp;
        }
    }
    return $inicial;
}

// Recoge configuración de la gráfica
$tamanyoGraficaXInicial = 400;
$tamanyoGraficaXMinimo  = 200;
$tamanyoGraficaXMaximo  = 600;
$tamanyoGraficaX = recogeNumero("tamanyoGraficaX", $tamanyoGraficaXInicial,
    $tamanyoGraficaXMinimo, $tamanyoGraficaXMaximo);

$tamanyoGraficaYInicial = 200;
$tamanyoGraficaYMinimo  = 100;
$tamanyoGraficaYMaximo  = 300;
$tamanyoGraficaY = recogeNumero("tamanyoGraficaY", $tamanyoGraficaYInicial,
    $tamanyoGraficaYMinimo, $tamanyoGraficaYMaximo);

$tipoGrafica = "lc";
$tituloGrafica = recoge("tituloGrafica");
$unidadesEjeY = recoge("unidadesEjeY");
if (isset($_REQUEST[$unidadesEjeY])) {
    $unidadesEjeY = "on";
}

// Recoge el número de datos y lo valida, aumenta o reduce
$numeroValoresInicial = 4;
$numeroValoresMinimo  = 2;
$numeroValoresMaximo  = 15;
$numeroValores = recogeNumero("numeroValores", $numeroValoresInicial,
    $numeroValoresMinimo, $numeroValoresMaximo);
if (isset($_REQUEST["anyadir"]) && ($numeroValores<$numeroValoresMaximo)) {
    $numeroValores++;
} elseif (isset($_REQUEST["quitar"]) && ($numeroValores>$numeroValoresMinimo)) {
    $numeroValores--;
}

// Recoge valores numéricos y los valida
$valores = recoge("valores", []);
// Esto es para cuando se añaden y quiten valores, que la matriz $valores
// tengo el núemro de elementos igual que $numeroValores
if (isset($valores[$numeroValores+1])) {
    unset($valores[$numeroValores+1]);
}
if (isset($valores[$numeroValores-1])&&!isset($valores[$numeroValores])) {
    $valores[$numeroValores]="";
}
$okValores = true;
for ($i=1; $i<$numeroValores; $i++) {
    if (!isset($valores[$i])) {
        $okValores = false;
    } elseif ($valores[$i] != "" && !is_numeric($valores[$i])) {
        $okValores = false;
    }
    // Al hacer clic en Añadir el último valor todavía no existe
    if (!isset($_REQUEST["anyadir"])) {
        if (!isset($valores[$numeroValores])) {
            $okValores = false;
        } elseif ($valores[$i] != "" && !is_numeric($valores[$i])) {
            $okValores = false;
        }
    }
}

// Si no se ha hecho clic en Enviar o los valores no son correctos
if (!isset($_REQUEST["enviar"]) || !$okValores) {
    if (isset($_REQUEST["enviar"])) {
        cabecera("Resultado inválido");
        print"  <p class=\"aviso\">Por favor corrige los datos:</p>\n";
        print "\n";
    } else {
        cabecera("Formulario");
        print"  <p>Escribe los valores numéricos (puedes escribir entre "
            . "$numeroValoresMinimo y $numeroValoresMaximo valores):</p>\n";
        print "\n";
    }
} else {
// Si los valores son correctos se convierten a cadena
    cabecera("Resultado válido");
    print"  <p>Escribe los valores numéricos (puedes escribir entre "
        . "$numeroValoresMinimo y $numeroValoresMaximo valores):</p>\n";
    print "\n";
}

print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
print "    <table>\n";
print "      <tbody valign=\"top\">\n";
print "        <tr>\n";
print "          <td>\n";
print "            <table>\n";
print "              <tr>\n";
print "                <td>Tamaño gráfica (ancho, entre $tamanyoGraficaXMinimo y $tamanyoGraficaXMaximo):</td>\n";
print "                <td><input type=\"text\" name=\"tamanyoGraficaX\" "
    . "value=\"$tamanyoGraficaX\" size=\"5\"> px</td>\n";
print "              </tr>\n";
print "              <tr>\n";
print "                <td>Tamaño gráfica (alto, entre $tamanyoGraficaYMinimo y $tamanyoGraficaYMaximo):</td>\n";
print "                <td><input type=\"text\" name=\"tamanyoGraficaY\" "
    . "value=\"$tamanyoGraficaY\" size=\"5\"> px</td>\n";
print "              </tr>\n";
print "              <tr>\n";
print "                <td colspan=\"2\">Título gráfica: ";
print "<input type=\"text\" name=\"tituloGrafica\" "
    . "value=\"$tituloGrafica\" size=\"40\"></td>\n";
print "              </tr>\n";
print "              <tr>\n";
print "                <td colspan=\"2\">Números en eje Y: ";
print "<input type=\"checkbox\" name=\"unidadesEjeY\" ";
    if ($unidadesEjeY == "on") {
        print "checked";
    }
print "></td>\n";
print "              </tr>\n";
print "            </table>\n";
print "          </td>\n";
print "          <td style=\"border-left: black solid 1px\">\n";
print "            <table>\n";
for ($i=1; $i<=$numeroValores; $i++) {
    print "              <tr>\n";
    print "                <td>Número $i:</td>\n";
    print "                <td><input type=\"text\" "
        . "name=\"valores[$i]\" size=\"10\" value=\"";
    if (isset($valores[$i])) {
        print "$valores[$i]";
    }
    print "\"></td>\n";
    print "              </tr>\n";
}
print "            </table>\n";
print "          </td>\n";
print "        </tr>\n";
print "      </tbody>\n";
print "    </table>\n";
print "\n";
print "    <p class=\"der\">\n";
print "      <input type=\"hidden\" name=\"numeroValores\" value=\"$numeroValores\">\n";
print "      <input type=\"submit\" name=\"anyadir\" value=\"Añadir valor\">\n";
print "      <input type=\"submit\" name=\"quitar\" value=\"Quitar valor\">\n";
print "      <input type=\"reset\" value=\"Borrar\">\n";
print "      <input type=\"submit\" name=\"enviar\" value=\"Enviar\">\n";
print "    </p>\n";
print "  </form>\n";
print "\n";

if (!$okValores) {
    $cadena = "";
} else {
    $simpleEncoding = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    // Empiezo buscando un valor cualquiera en la lista de valores
    $minimo = $maximo = 0;
    $patronValores = "/^[+-]?[0-9]{1,6}$/"; // Este patrón NO admite la cadena vacía
    foreach ($valores as $valor) {
        if (preg_match($patronValores, $valor)) {
            $minimo = $maximo = $valor;
        }
    }
    // Después busco el máximo y el mínimo (las funciones min y max
    // no sirven porque puede haber valores vacíos
    foreach ($valores as $valor) {
        if ($valor != "") {
            if ($valor>$maximo) {
                $maximo = $valor;
            }
            if ($valor<$minimo) {
                $minimo = $valor;
            }
        }
    }

    // Por último se convierten a la cadena
    $cadena = "";
    if ($maximo == $minimo) {
        foreach ($valores as $valor) {
            if ($valor == "") {
               $cadena .= "_";
            } else {
               $cadena .= "f";
            }
        }
    } else {
        foreach ($valores as $valor) {
            if ($valor == "") {
                $cadena .= "_";
            } else {
                $letra = round(($valor-$minimo)/($maximo-$minimo)*61);
                $cadena .= $simpleEncoding[$letra];
            }
        }
    }
}

$cadenaGrafica = "http://chart.apis.google.com/chart?chs={$tamanyoGraficaX}"
    . "x{$tamanyoGraficaY}&amp;chd=s:{$cadena}&amp;cht=$tipoGrafica";
if ($tituloGrafica != "") {
    $tituloGrafica = str_replace(" ", "+", $tituloGrafica);
    $cadenaGrafica .= "&amp;chtt=$tituloGrafica";
}
if ($unidadesEjeY == "on") {
    $cadenaGrafica .= "&amp;chxt=y&amp;chxl=0:|$minimo|$maximo";
}
if (!$okValores) {
    print "  <p style=\"text-align:center\">Sin gráfica:</p>\n";
    print "\n";
} else {
    print "  <p style=\"text-align:center\">Gráfica:</p>\n";
    print "\n";
}
print "  <p style=\"text-align:center\">\n";
print "    <img style=\"padding:10px;border:black solid 2px\" "
    . "src=\"$cadenaGrafica\" alt=\"Gráfica\">\n";
print "  </p>\n";
print "\n";

print "  <footer>\n";
print "    <p class=\"ultmod\">\n";
print "      Última modificación de esta página:\n";
print "      <time datetime=\"2008-02-10\">10 de febrero de 2008</time>\n";
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
