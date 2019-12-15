<?php
/**
 * Seleccione dibujos - matrices-1-12-1.php
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

session_name("matrices-1-12");
session_start();

$caracterMinimo = 128512;
$caracterMaximo = 128567;
$_SESSION["numeroDibujos"] = 7;

if (!isset($_SESSION["disponibles"]) || count($_SESSION["disponibles"]) == 0) {
    for ($i = 0; $i < $_SESSION["numeroDibujos"]; $i++) {
        $_SESSION["disponibles"][$i] = mt_rand($caracterMinimo, $caracterMaximo);
    }
    unset($_SESSION["seleccionados"]);
    $_SESSION["seleccionados"] = [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Seleccione dibujos.
    Matrices (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
  <style>
    button { background-color: hsl(240, 100%, 98%); padding: 0; border: none;}
  </style>
</head>

<body>
<?php
print "  <h1>$_SESSION[numeroDibujos] dibujos para seleccionar</h1>\n";
print "\n";
print "  <p>Haga clic en un dibujo para seleccionarlo.</p>\n";
print "\n";
print "  <h2>Dibujos disponibles</h2>\n";
print "\n";
print "  <form action=\"matrices-1-12-2.php\">\n";
print "    <p>\n";
foreach ($_SESSION["disponibles"] as $indice => $valor) {
    print "      <button name=\"selecciona\" value=\"$indice\" style=\"font-size: 400%\">\n";
    print "        &#$valor;\n";
    print "      </button>\n";
}
print "    </p>\n";
print "  </form>\n";
print "\n";
print "  <h2>Dibujos seleccionados</h2>\n";
print "\n";
print "  <p style=\"font-size: 400%; line-height: 25%;\">\n";
foreach ($_SESSION["seleccionados"] as $valor) {
    print "      &#$valor;\n";
}
print "  </p>\n";
?>

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
