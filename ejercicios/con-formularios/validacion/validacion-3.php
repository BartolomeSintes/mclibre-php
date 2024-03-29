<?php
/**
 *  Entrada de datos - validacion-3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2010 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2010-03-25
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

// Función de recogida de datos
function recoge($key, $type = "")
{
    if (!is_string($key) && !is_int($key) || $key == "") {
        trigger_error("Function recoge(): Argument #1 (\$key) must be a non-empty string or an integer", E_USER_ERROR);
    } elseif ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): Argument #2 (\$type) is optional, but if provided, it must be an empty array or an empty string", E_USER_ERROR);
    }
    $tmp = $type;
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

function cabecera($texto)
{
    print "<!DOCTYPE html>\n";
    print "<html lang=\"es\">\n";
    print "<head>\n";
    print "  <meta charset=\"utf-8\">\n";
    print "  <title>\n";
    print "    $texto. Validación.\n";
    print "    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org\n";
    print "  </title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    print "  <link rel=\"stylesheet\" href=\"mclibre-php-ejercicios.css\" title=\"Color\">\n";
    print "</head>\n";
    print "\n";
    print "<body>\n";
    print "  <h1>$texto</h1>\n";
    print "\n";
}

function pie($conEnlace, $conBotones, $numeroValores)
{
    print "    </table>\n";
    print "\n";

    if ($conEnlace) {
        print "    <p><a href=\"$_SERVER[PHP_SELF]\">Volver al principio</a></p>\n";
        print "\n";
    }

    if ($conBotones) {
        print "    <p class=\"der\">\n";
        print "      <input type=\"hidden\" name=\"numeroValores\" value=\"$numeroValores\">\n";
        print "      <input type=\"submit\" name=\"enviar\" value=\"Enviar\">\n";
        print "      <input type=\"submit\" name=\"anyadir\" value=\"Añadir valor\">\n";
        print "      <input type=\"submit\" name=\"quitar\" value=\"Quitar valor\">\n";
        print "    </p>\n";
        print "  </form>\n";
        print "\n";
    }

    print "  <footer>\n";
    print "    <p class=\"ultmod\">\n";
    print "      Última modificación de esta página:\n";
    print "      <time datetime=\"2010-03-25\">25 de marzo de 2010</time>\n";
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
}

// Recoge el número de datos y lo valida, aumenta o reduce
define("FORM_METHOD", "get");
define("TAM_VALOR", 5);
define("NUM_VALORES_INICIAL", 4);
define("NUM_VALORES_MINIMO", 2);
define("NUM_VALORES_MAXIMO", 10);
define("CON_ENLACE", true);
define("SIN_ENLACE", false);
define("CON_BOTONES", true);
define("SIN_BOTONES", false);

$valores = recoge("valores", []);

$numeroValores = recoge("numeroValores");
if ($numeroValores < NUM_VALORES_MINIMO) {
    $numeroValores = NUM_VALORES_MINIMO;
} elseif ($numeroValores > NUM_VALORES_MAXIMO) {
    $numeroValores = NUM_VALORES_MAXIMO;
}
if (isset($_REQUEST["anyadir"]) && ($numeroValores < NUM_VALORES_MAXIMO)) {
    $numeroValores++;
    $valores[$numeroValores] = "";  // Al añdir se crea un nuevo valor vacío
} elseif (isset($_REQUEST["quitar"]) && ($numeroValores > NUM_VALORES_MINIMO)) {
    $numeroValores--;
}

$valoresOk     = [];
$valoresTodoOk = true;
for ($i = 1; $i <= $numeroValores; $i++) {
    $valoresOk[$i] = true;
    if (!isset($valores[$i])) {  // Por si falta un valor en la matriz
        $valoresTodoOk = false;
        $valores[$i]   = "";
    } elseif ($valores[$i] == "") {  // Por si un valor es vacío
        $valoresTodoOk = false;
    } elseif ($valores[$i] != "" && !is_numeric($valores[$i])) {  // Por si un valor no es numérico
        $valoresOk[$i] = false;
        $valoresTodoOk = false;
    }
}

$valoresTodoVacio = true;
for ($i = 1; $i <= $numeroValores; $i++) {
    if ($valores[$i] != "") {
        $valoresTodoVacio = false;
    }
}

if ($valoresTodoOk) {
    cabecera("Resultado válido");
    print"  <p>Los valores introducidos son correctos.</p>\n";
    print "\n";
    for ($i = 1; $i <= $numeroValores; $i++) {
        print "  <p>Valor $i: <strong>$valores[$i]</strong></p>\n";
        print "\n";
    }
    pie(CON_ENLACE, SIN_BOTONES, $numeroValores);
} elseif (!$valoresTodoVacio && (isset($_REQUEST["enviar"]) || isset($_REQUEST["anyadir"]) || isset($_REQUEST["quitar"]))) {
    cabecera("Resultado inválido");
    print"  <p>Por favor, corrija los datos incorrectos y/o complete todas las casillas:</p>\n";
    print "\n";
    print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"" . FORM_METHOD . "\">\n";
    print "    <table>\n";
    for ($i = 1; $i <= $numeroValores; $i++) {
        print "      <tr>\n";
        print "        <td>Valor $i:</td>\n";
        print "        <td><input type=\"text\" name=\"valores[$i]\" size=\""
            . TAM_VALOR . "\" maxlength=\"" . TAM_VALOR . "\" value=\"" . $valores[$i] . "\">";
        if (!$valoresOk[$i]) {
            print " <span class=\"aviso\">El valor no es correcto</span>";
        } elseif ($valores[$i] == "") {
            print " <span class=\"aviso\">Escriba un valor</span>";
        }
        print "</td>\n";
        print "      </tr>\n";
    }
    pie(CON_ENLACE, CON_BOTONES, $numeroValores);
} else {
    cabecera("Formulario");
    print"  <p>Escriba $numeroValores números:</p>\n";
    print "\n";
    print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"" . FORM_METHOD . "\">\n";
    print "    <table>\n";
    for ($i = 1; $i <= $numeroValores; $i++) {
        print "      <tr>\n";
        print "        <td>Valor $i:</td>\n";
        print "        <td><input type=\"text\" name=\"valores[$i]\" size=\""
            . TAM_VALOR . "\" maxlength=\"" . TAM_VALOR . "\">";
        print "</td>\n";
        print "      </tr>\n";
    }
    pie(SIN_ENLACE, CON_BOTONES, $numeroValores);
}
