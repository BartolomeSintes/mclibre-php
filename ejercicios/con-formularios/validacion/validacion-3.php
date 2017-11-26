<?php
/**
 *  Entrada de datos - validacion-3.php
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

function recogeMatriz($var)
{
    $tmpMatriz = [];
    if (isset($_REQUEST[$var]) && is_array($_REQUEST[$var])) {
        foreach ($_REQUEST[$var] as $indice => $valor) {
            $tmp = strip_tags(trim(htmlspecialchars($indice, ENT_QUOTES, "UTF-8")));
            if (get_magic_quotes_gpc()) {
                $tmp = stripslashes($tmp);
            }
            $indiceLimpio = $tmp;

            $tmp = strip_tags(trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8")));
            if (get_magic_quotes_gpc()) {
                $tmp = stripslashes($tmp);
            }
            $valorLimpio = $tmp;

            $tmpMatriz[$indiceLimpio] = $valorLimpio;
        }
    }
    return $tmpMatriz;
}

function cabecera($texto)
{
    print "<?xml version=\"1.0\" encoding=\"utf-8\"?>
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
  \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <title>Entrada de datos
  ($texto). Validación. Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
  <link href=\"mclibre-php-soluciones.css\" rel=\"stylesheet\" type=\"text/css\"
  title=\"Color\" />
</head>\n\n<body>\n<h1>Validación ($texto)</h1>\n";
}

function pie($conEnlace, $conBotones, $numeroValores)
{
    print "    </tbody>\n  </table>\n";
    if ($conEnlace) {
        print "  <p><a href=\"$_SERVER[PHP_SELF]\">Volver al principio</a></p>\n";
    }
    if ($conBotones) {
        print "  <p class=\"der\"><input type=\"hidden\" name=\"numeroValores\" value=\"$numeroValores\" />\n"
        ."    <input type=\"submit\" name=\"enviar\" value=\"Enviar\" />\n"
        ."    <input type=\"submit\" name=\"anyadir\" value=\"Añadir valor\" />\n"
        ."    <input type=\"submit\" name=\"quitar\" value=\"Quitar valor\" />"
        ."</p>\n</form>\n";
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
}

// Recoge el número de datos y lo valida, aumenta o reduce
define('FORM_METHOD', 'get');
define('TAM_VALOR',   5);
define('NUM_VALORES_INICIAL', 4);
define('NUM_VALORES_MINIMO',  2);
define('NUM_VALORES_MAXIMO',  10);
define('CON_ENLACE',  true);
define('SIN_ENLACE',  false);
define('CON_BOTONES', true);
define('SIN_BOTONES', false);

$valores       = recogeMatriz('valores');

$numeroValores = recoge('numeroValores');
if ($numeroValores<NUM_VALORES_MINIMO) {
    $numeroValores = NUM_VALORES_MINIMO;
} elseif ($numeroValores>NUM_VALORES_MAXIMO) {
    $numeroValores = NUM_VALORES_MAXIMO;
}
if (isset($_REQUEST['anyadir']) && ($numeroValores<NUM_VALORES_MAXIMO)) {
    $numeroValores++;
    $valores[$numeroValores] = "";  // Al añdir se crea un nuevo valor vacío
} elseif (isset($_REQUEST['quitar']) && ($numeroValores>NUM_VALORES_MINIMO)) {
    $numeroValores--;
}

$valoresOK     = [];
$valoresTodoOk = true;
for ($i=1; $i<=$numeroValores; $i++) {
    $valoresOk[$i] = true;
    if (!isset($valores[$i])) {  // Por si falta un valor en la matriz
        $valoresTodoOk = false;
        $valores[$i] = "";
    } elseif ($valores[$i]=="") {  // Por si un valor es vacío
        $valoresTodoOk = false;
    } elseif (($valores[$i]!="") && !is_numeric($valores[$i])) {  // Por si un valor no es numérico
        $valoresOk[$i] = false;
        $valoresTodoOk = false;
    }
}

$valoresTodoVacio = true;
for ($i=1; $i<=$numeroValores; $i++) {
    if ($valores[$i]!="") {
        $valoresTodoVacio = false;
    }
}

if ($valoresTodoOk) {
    cabecera("Resultado válido");
    print"<p>Los valores introducidos son correctos.</p>\n";
    for ($i=1; $i<=$numeroValores; $i++) {
        print "<p>Valor $i: <strong>$valores[$i]</strong></p>\n";
    }
    pie(CON_ENLACE, SIN_BOTONES, $numeroValores);
} elseif (!$valoresTodoVacio&&(isset($_REQUEST['enviar'])||
        isset($_REQUEST['anyadir'])||isset($_REQUEST['quitar']))) {
    cabecera("Resultado inválido");
    print"<p>Por favor, corrija los datos incorrectos y/o complete "
        ."todas las casillas:</p>\n";
    print "<form action=\"$_SERVER[PHP_SELF]\" method=\"".FORM_METHOD."\">\n".
        "  <table>\n    <tbody>\n";
    for ($i=1; $i<=$numeroValores; $i++) {
        print "      <tr>\n        <td>Valor $i:</td>
        <td><input type=\"text\" name=\"valores[$i]\" size=\"".TAM_VALOR."\"
              maxlength=\"".TAM_VALOR."\" value=\"".$valores[$i]."\" />";
        if (!$valoresOk[$i]) {
            print " <span class=\"aviso\">El valor no es correcto</span>";
        } elseif ($valores[$i]=="") {
            print " <span class=\"aviso\">Escriba un valor</span>";
        }
        print "</td>\n      </tr>\n";
    }
    pie(CON_ENLACE, CON_BOTONES, $numeroValores);
} else {
    cabecera("Formulario");
    print"<p>Escriba $numeroValores números:</p>\n";
    print "<form action=\"$_SERVER[PHP_SELF]\" method=\"".FORM_METHOD."\">\n"
        ."  <table>\n    <tbody>\n";
    for ($i=1; $i<=$numeroValores; $i++) {
        print "      <tr>\n        <td>Valor $i:</td>
        <td><input type=\"text\" name=\"valores[$i]\" size=\"".TAM_VALOR."\"
        maxlength=\"".TAM_VALOR."\" />";
        print "</td>\n      </tr>\n";
    }
    pie(SIN_ENLACE, CON_BOTONES, $numeroValores);
}
?>
