<?php
/**
 * Elimine dibujos en orden - foreach-1-03-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-11-30
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

session_name("foreach-1-03");
session_start();

$caracterMinimo = 127789;
$caracterMaximo = 127871;
$_SESSION["numeroDibujos"] = 7;

if (!isset($_SESSION["dibujos"]) || count($_SESSION["dibujos"]) == 0) {
    for ($i = 0; $i < $_SESSION["numeroDibujos"]; $i++) {
        $_SESSION["dibujos"][$i] = mt_rand($caracterMinimo, $caracterMaximo);
    }
    $_SESSION["deseado"] = $_SESSION["dibujos"][array_rand($_SESSION["dibujos"])];
}

if (isset($_SESSION["dibujos"]) && !isset($_SESSION["deseado"])) {
    $_SESSION["deseado"] = $_SESSION["dibujos"][array_rand($_SESSION["dibujos"])];
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Elimine dibujos. foreach (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
  <style>
  button { background-color: hsl(240, 100%, 98%); padding: 0; border: none;}
  </style>
</head>

<body>
<?php
print "  <h1>$_SESSION[numeroDibujos] dibujos</h1>\n";
print "\n";
print "  <p>Haga clic en el siguiente dibujo: <span style=\"font-size: 400%\">"
     . "&#$_SESSION[deseado];</span>.</p>\n";
print "\n";
print "  <form action=\"foreach-1-03-2.php\">\n";
print "    <p>\n";
foreach ($_SESSION["dibujos"] as $indice => $valor) {
    print "      <button name=\"elimina\" value=\"$indice\" style=\"font-size: 400%\">\n";
    print "        &#$valor;\n";
    print "      </button>\n";
}
print "    </p>\n";
print "  </form>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-11-30">30 de noviembre de 2017</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br />
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
