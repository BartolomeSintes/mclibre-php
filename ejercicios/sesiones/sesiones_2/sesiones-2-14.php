<?php
/**
 * Sesiones (2) 4-1 - sesiones-2-14_1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2015 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2015-11-16
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
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

function recogeMatriz($var)
{
    $tmpMatriz = array();
    if (isset($_REQUEST[$var]) && is_array($_REQUEST[$var])) {
        foreach ($_REQUEST[$var] as $indice => $valor) {
            $indiceLimpio = trim(htmlspecialchars($indice, ENT_QUOTES, "UTF-8"));
            $valorLimpio  = trim(htmlspecialchars($valor,  ENT_QUOTES, "UTF-8"));
            $tmpMatriz[$indiceLimpio] = $valorLimpio;
        }
    }
    return $tmpMatriz;
}

session_name("sesiones_2_12");
session_start();

$accion       = recoge("accion");
$nombre       = recoge("nombre");
$casillas     = recogeMatriz("c");
$nombreOk     = false;
$accionOk     = false;

if ($accion=="Cerrar") {
    session_destroy();
    header("Location:" . $_SERVER["PHP_SELF"]);
    exit();
} elseif ($accion = "Eliminar") {
    foreach($casillas as $indice => $valor) {
        unset($_SESSION["c"][$indice]);
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Almacenamiento y borrado de datos en sesión. Sesiones (2).
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
<h1>Almacenamiento y borrado de datos en sesión</h1>

<?php

if ($nombre == "") {
    print "<p class=\"aviso\">No ha escrito el nombre.</p>\n";
} else {
    $nombreOk = true;
}

$accionOk   = ($accion == "Añadir" || $accion == "Cerrar" || $accion == "Eliminar" || $accion == "");
if (!$accionOk) {
    print "<p class=\"aviso\">Error en la opción elegida. Elija de nuevo, por favor.</p>";
}

print "<form action=\"$_SERVER[PHP_SELF]\" method=\"get\">
  <fieldset>
    <legend>Formulario</legend>
    <table cellspacing=\"5\" class=\"borde\">
      <tbody>
        <tr>
          <td><strong>Escriba algún nombre:</strong></td>
          <td><input type=\"text\" name=\"nombre\" size=\"30\" maxlength=\"30\" /></td>
        </tr>
      </tbody>
    </table>

    <p class=\"der\">
    <input type=\"submit\" value=\"Añadir\" name=\"accion\" />
    <input type=\"reset\" value=\"Borrar\" /></p>
  </fieldset>
</form>\n";

if ($nombreOk) {
    $_SESSION[] = $nombre;
}

if (!count($_SESSION)) {
    print "<p>Todavía no se han introducido nombres.</p>\n";
} else {
    print "<p></p>\n";
    print "<form action=\"$_SERVER[PHP_SELF]\" method=\"get\">
  <fieldset>
    <legend>Datos introducidos</legend>
    <p>\n";
    foreach ($_SESSION as $indice => $valor) {
        print "      <input type=\"checkbox\" name=\"c[$indice]\" /> $valor<br />\n";
    }
    print "    </p>\n    <p class=\"der\">
    <input type=\"submit\" value=\"Eliminar\" name=\"Eliminar\" />
    <input type=\"reset\" value=\"Reiniciar\" /></p>
  </fieldset>
</form>\n";

    print "<p><a href=\"$_SERVER[PHP_SELF]?accion=Cerrar\">Cerrar sesión "
        . "(se perderán los datos almacenados).</a></p>\n";
}

?>

<footer>
  <p class="ultmod">
    Última modificación de esta página:
    <time datetime="2015-11-16">16 de noviembre de 2015</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
    </footer>
  </body>
</html>
