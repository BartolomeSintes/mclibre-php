<?php
/**
 * Retrato Robot - retrato-robot.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-10-31
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
session_name("retrato-robot");
session_start();

// Variables auxiliares
$valorMinimo = 1;
$valorMaximo = 7;

// Valores iniciales
if (!isset($_SESSION["a"]) || !isset($_SESSION["b"]) || !isset($_SESSION["c"])) {
    $_SESSION["a"] = rand($valorMinimo, $valorMaximo);
    $_SESSION["b"] = rand($valorMinimo, $valorMaximo);
    $_SESSION["c"] = rand($valorMinimo, $valorMaximo);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Retato Robot.
    Minijuegos (1).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
  <style>
    table { border-collapse: collapse; ; margin-left: auto; margin-right: auto; }
    td { padding: 0; }
    img { vertical-align: bottom; }
  </style>
</head>

<body>
  <h1>Retrato Robot</h1>

  <form action="retrato-robot.php" method="get">
    <table>
      <tbody>
<?php
// Funciones auxiliares
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

// Recogida de datos
$mod = recoge("mod");

// Se renueva la imagen solicitada
if ($mod == 1) {
    $_SESSION["a"] = rand($valorMinimo, $valorMaximo);
} elseif ($mod == 2) {
    $_SESSION["b"] = rand($valorMinimo, $valorMaximo);
} elseif ($mod == 3) {
    $_SESSION["c"] = rand($valorMinimo, $valorMaximo);
}

// Se genera el formulario

print "        <tr>\n";
print "          <td><img src=\"img/retratos/retratos-$_SESSION[c]-3.jpg\" alt=\"ojos\"></td>\n";
print "          <td><button type=\"submit\" name=\"mod\" value=\"3\">"
    . "<img src=\"img/refresh.svg\" height=\"60\" alt=\"cambiar\"></button></td>\n";
print "        </tr>\n";
print "        <tr>\n";
print "          <td><img src=\"img/retratos/retratos-$_SESSION[b]-2.jpg\" alt=\"nariz\"></td>\n";
print "          <td><button type=\"submit\" name=\"mod\" value=\"2\">"
    . "<img src=\"img/refresh.svg\" height=\"60\" alt=\"cambiar\"></button></td>\n";
print "        </tr>\n";
print "        <tr>\n";
print "          <td><img src=\"img/retratos/retratos-$_SESSION[a]-1.jpg\" alt=\"boca\"></td>\n";
print "          <td><button type=\"submit\" name=\"mod\" value=\"1\">"
    . "<img src=\"img/refresh.svg\" height=\"60\" alt=\"cambiar\"></button></td>\n";
print "        </tr>\n";

?>
      </tbody>
    </table>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-10-31">31 de octubre de 2018</time>
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
