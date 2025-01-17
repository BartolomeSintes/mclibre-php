<?php
/**
 * Camisetas 2 - camisetas-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-01-09
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
  <meta charset="utf-8">
  <title>Camisetas (Resultado).
    Selección (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Camisetas 2 (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$color    = recoge("color");
$genero   = recoge("genero");
$texto    = recoge("texto");
$colorOk  = false;
$generoOk = false;
$textoOk  = false;

if ($color == "") {
  print "  <p class=\"aviso\">No ha escrito ningún color.</p>\n";
  print "\n";
} else {
  $colorOk = true;
}

if ($genero != "h" && $genero != "m") {
    print "  <p class=\"aviso\">Debe elegir su sexo: hombre o mujer.</p>\n";
    print "\n";
} else {
    $generoOk = true;
}

if ($texto == "") {
    print "  <p class=\"aviso\">No ha escrito ningún texto.</p>\n";
    print "\n";
}elseif (strlen($texto) > 9) {
    print "  <p class=\"aviso\">El texto es demasiado largo.</p>\n";
    print "\n";
} else {
    $textoOk = true;
}

if ($colorOk && $generoOk && $textoOk) {
    if ($genero == "m") {
        print "  <p>\n";
        print "    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"244\" height=\"328\" viewBox=\"0 0 121.793 163.392\">\n";
        print "      <g>\n";
        print "        <path fill=\"$color\" stroke=\"black\" fill-rule=\"evenodd\" d=\"M41.14 0s-14.1 4.16-20.57 6.7C14.1 9.24 5.32 15.7 3
            20.1c-2.3 4.4-3 6.5-3 6.5s4.62 3 8.78 9.24c4.16 6.24 11.56 10.4 11.56 10.4s.15 16.9 5.3 28.9c7 16.2-.9 35.8-4.38
            45.75-3.47 9.9-6 42.5-6 42.5h94.05s-1.32-24.77-7.6-40c-6.2-15.27-9.7-36.77-4.4-47.86 5.3-11.1 4.9-29.12 4.9-29.12s6.7-3.7
            9-8.1c2.3-4.38 5.8-7.6 7.4-9.7 1.6-2.07 3.24-2.3 3.24-2.3s-4.16-8.8-6.24-11.56c-2.1-2.8-8.1-5.33-14.1-8.1C95.45 3.92 80.9
            0 80.9 0s-5.56 3.7-18.04 3.7S41.14 0 41.14 0z\" clip-rule=\"evenodd\"/>\n";
        print "      </g>\n";
        print "      <defs><path id=\"camino\" d=\"M20 40 Q 60 70 100 40\" /></defs>\n";
//        print "      <use xlink:href=\"#camino\" fill=\"none\" stroke=\"red\" />\n";
        print "      <text font-family=\"sans-serif\" font-size=\"20\"><textPath xlink:href=\"#camino\">$texto</textPath></text>\n";
        print "    </svg>\n";
        print "  </p>\n";
        print "\n";
    } else {
        print "  <p>\n";
        print "    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"266\" height=\"332\" viewBox=\"0 0 138.37401 171.27\">\n";
        print "      <g>\n";
        print "        <path fill=\"$color\" stroke=\"black\" fill-rule=\"evenodd\" d=\"M48.72.25s-24.6 12.56-30.4 15.82C12.57 19.34 8.3 23.35 6.3 32.9
            4.28 42.44 0 72.83 0 72.83s13.3 4.52 18.83 4.52c5.53 0 8.8-1.5 8.8-1.5l.24 95.42H113v-99.2s6.3 1.26 11.56.5c5.28-.75 13.8-5.27
            13.8-5.27s-7.77-35.9-9.03-42.94c-1.25-7.03-8.28-10.55-15.82-13.3C106 8.28 89.4 0 89.4 0s-5.02 4.52-17.57 5.02c-12.56.5-23.1-4.77-23.1-4.77z\"
            clip-rule=\"evenodd\"/>\n";
        print "      </g>\n";
        print "      <defs><path id=\"camino\" d=\"M20 50 Q 70 80 120 50\" /></defs>\n";
//        print "      <use xlink:href=\"#camino\" fill=\"none\" stroke=\"red\" />\n";
        print "      <text font-family=\"sans-serif\" font-size=\"22\"><textPath xlink:href=\"#camino\">$texto</textPath></text>\n";
        print "    </svg>\n";
        print "  </p>\n";
        print "\n";
    }
}
?>
  <p><a href="seleccion-1-2-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-01-09">9 de enero de 2025</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
