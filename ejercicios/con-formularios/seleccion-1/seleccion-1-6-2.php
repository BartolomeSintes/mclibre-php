<?php
/**
 * Cuenta palos - cuenta-palos-2.php
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
  <title>
    Cuenta palos (Resultado).
    Selección (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Cuenta palos (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$cantidad = recoge("cantidad");
$palo1    = recoge("palo1");
$palo2    = recoge("palo2");

$cantidadOk = false;
$palo1Ok  = false;
$palo2Ok  = false;

if ($cantidad == "") {
    print "  <p class=\"aviso\">No ha escrito el número de cartas.</p>\n";
    print "\n";
} elseif (!is_numeric($cantidad)) {
    print "  <p class=\"aviso\">No ha escrito el número de cartas como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($cantidad)) {
    print "  <p class=\"aviso\">No ha escrito el número de cartas como número entero.</p>\n";
    print "\n";
} elseif ($cantidad < 2 || $cantidad > 10) {
    print "  <p class=\"aviso\">El número de cartas indicado no está en el rango permitido.</p>\n";
    print "\n";
} else {
    $cantidadOk = true;
}

if ($palo1 == "") {
    print "  <p class=\"aviso\">No ha elegido el primer palo.</p>\n";
    print "\n";
} elseif ($palo1 != "c" && $palo1 != "d" && $palo1 != "p" && $palo1 != "t") {
    print "  <p class=\"aviso\">El primer palo indicado no es uno de los permitidos.</p>\n";
    print "\n";
} else {
    $palo1Ok = true;
}

if ($palo2 == "") {
    print "  <p class=\"aviso\">No ha elegido el segundo palo.</p>\n";
    print "\n";
} elseif ($palo2 != "c" && $palo2 != "d" && $palo2 != "p" && $palo2 != "t") {
    print "  <p class=\"aviso\">El segundo palo indicado no es uno de los permitidos.</p>\n";
    print "\n";
} else {
    $palo2Ok = true;
}

if ($palo1 == $palo2 && $palo1 !=  "") {
    print "  <p class=\"aviso\">Los palos deben ser distintos.</p>\n";
    print "\n";
    $palo1Ok = $palo2Ok = false;
}

if ($cantidadOk && $palo1Ok && $palo2Ok) {
    $cartas = [];
    $palos = [];
    $cuenta1 = 0;
    $cuenta2 = 0;
    for ($i = 0; $i < $cantidad; $i++) {
        $cartas[$i] = rand(1, 10);
        $palo = rand(1, 4);
        if ($palo == 1) {
            $palos[$i] = "c";
        } elseif ($palo == 2) {
            $palos[$i] = "d";
        } elseif ($palo == 3) {
            $palos[$i] = "p";
        } elseif ($palo == 4) {
            $palos[$i] = "t";
        }
        if ($palos[$i] == $palo1) {
            $cuenta1 += 1;
        } elseif ($palos[$i] == $palo2) {
            $cuenta2 += 1;
        }
    }

    print "  <h2>$cantidad cartas";
    print "</h2>\n";
    print "\n";

    print "  <p>\n";
    for ($i = 0; $i < $cantidad; $i++) {
        print "    <img src=\"img/$palos[$i]$cartas[$i].svg\" alt=\"$cartas[$i]\" width=\"100\">\n";
    }
    print "  </p>\n";
    print "\n";

    if ($palo1 == "c") {
        $palo1 = "corazones";
    } elseif ($palo1 == "d") {
        $palo1 = "rombos";
    } elseif ($palo1 == "p") {
        $palo1 = "picas";
    } elseif ($palo1 == "t") {
        $palo1 = "tréboles";
    }
    if ($palo2 == "c") {
        $palo2 = "corazones";
    } elseif ($palo2 == "d") {
        $palo2 = "rombos";
    } elseif ($palo2 == "p") {
        $palo2 = "picas";
    } elseif ($palo2 == "t") {
        $palo2 = "tréboles";
    }

    print "  <h2>Resultado</h2>\n";
    print "\n";
    print "  <p>Hay {$cuenta1} cartas de {$palo1} y {$cuenta2} cartas de {$palo2}.</p>\n";
    print "\n";
}
?>
  <p><a href="seleccion-1-6-1.php">Volver al formulario.</a></p>

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
