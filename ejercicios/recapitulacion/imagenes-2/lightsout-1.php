<?php
/**
 * Lights Out de una fila - lightsout-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2014 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2014-10-28
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
    Lights Out de una fila. Imágenes.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Lights Out de una fila</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

function recogeMatriz($var)
{
    $tmpMatriz = [];
    if (isset($_REQUEST[$var]) && is_array($_REQUEST[$var])) {
        foreach ($_REQUEST[$var] as $indice => $valor) {
            $indiceLimpio = trim(htmlspecialchars($indice, ENT_QUOTES, "UTF-8"));
            $valorLimpio  = trim(htmlspecialchars($valor,  ENT_QUOTES, "UTF-8"));
            $tmpMatriz[$indiceLimpio] = $valorLimpio;
        }
    }
    return $tmpMatriz;
}

$juega   = recoge("juega");
$partida = recogeMatriz("partida");
$juegaOk = false;
$total   = 7;

if ($juega == "") {
    $partida = [];
    $partida[0] = 0;
    for ($i = 1; $i <= $total; $i++) {
        $partida[$i] = rand(0, 1);
    }
    $partida[$total + 1] = 0;
    $juegaOk = true;
} elseif (!ctype_digit($juega)) {
    print "  <p class=\"aviso\">No ha indicado su jugada correctamente.</p>\n";
    print "\n";
} elseif ($juega < 1 || $juega > $total) {
    print "  <p class=\"aviso\">No ha indicado su jugada correctamente.</p>\n";
    print "\n";
} else {
    $juegaOk = true;
    $partida[0] = 0;
    $partida[$total + 1] = 0;
}

if ($juegaOk) {
    if ($juega != "") {
        $partida[$juega - 1] = (int)!(bool)$partida[$juega - 1];
        $partida[$juega    ] = (int)!(bool)$partida[$juega    ];
        $partida[$juega + 1] = (int)!(bool)$partida[$juega + 1];
    }
    $todasBlancas = true;
    $todasNegras = true;
    for ($i = 1; $i <= $total; $i++) {
        if ($partida[$i] == 0) {
            $todasBlancas = false;
        } else {
            $todasNegras = false;
        }
    }
    if ($todasBlancas || $todasNegras) {
        print "  <p style=\"font-size: 200%\">¡Felicidades! Ha conseguido el objetivo.</p>\n";
        print "\n";
    } else {
        print "  <p>Haga clic en una ficha para cambiar su color y el de las fichas vecinas. ";
        print "El objetivo del juego es dejar todas las fichas del mismo color.</p>\n";
        print "\n";
    }
    print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
    print "    <table>\n";
    print "      <tbody>\n";
    print "        <tr>\n";
    for ($i = 1; $i <= $total; $i++) {
        print "          <td><button type=\"submit\" name=\"juega\" value=\"$i\">";
        if ($partida[$i] == 0) {
            print "<img src=\"img/lightsout/circulo-negro.svg\" height=\"120\" alt=\"Ficha\"></button></td>\n";
        } else {
            print "<img src=\"img/lightsout/circulo-blanco.svg\" height=\"120\" alt=\"Ficha\"></button></td>\n";
        }
    }
    print "        </tr>\n";
    print "      </tbody>\n";
    print "    </table>\n";
    print "\n";

    print "    <p>\n";
    for ($i = 1; $i <= $total; $i++) {
        print "      <input type=\"hidden\" name=\"partida[$i]\" value=\"$partida[$i]\">\n";
    }
    print "    </p>\n";
    print "\n";

    print "    <p><input type=\"submit\" value=\"Reiniciar partida\"></p>\n";
    print "  </form>\n";
} else {
    print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
    print "    <p><input type=\"submit\" value=\"Reiniciar partida\"></p>\n";
    print "  </form>\n";
}
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2014-10-28">28 de octubre de 2014</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
