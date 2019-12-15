<?php
/**
 * Hombres y mujeres (Resultado) - matrices-2-4-2.php
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
// Se accede a la sesión
session_name("cs-matrices-2-4");
session_start();

// Si el número de cajas de texto no está guardado en la sesión, vuelve al formulario
if (!isset($_SESSION["numero"])) {
    header("Location: matrices-2-4-1.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Hombres y mujeres (Resultado).
    Matrices (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Hombres y mujeres (Resultado)</h1>

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
$c   = recoge("c", []);
$b   = recoge("b", []);
$cOk = false;
$bOk = false;

// Se cuenta el número de elementos en la matriz $c y $b
$cajasRecibidas   = count($c);
$botonesRecibidos = count($b);

// Comprobación de $c (cajas de texto)

// Si no se han recibido todas las cajas
if ($cajasRecibidas != $_SESSION["numero"]) {
  print "  <p class=\"aviso\">La matriz recibida no es correcta.</p>\n";
  print "\n";
} else {
    // Bucle para comprobar si todos los índices y valores son correctos
    $cOk = true;
    foreach ($c as $indice => $valor) {
        // Si el índice no es numérico (como es de tipo int hay que convertirlo a string antes)
        if (!ctype_digit((string)$indice)
            // o si el índice está fuera de rango
            || $indice < 1 || $indice > $_SESSION["numero"]
            // o si el contenido no es vacío o todo letras
           || (!ctype_alpha($valor) && $valor != "")) {
                $cOk = false;
            }
    }
    if (!$cOk) {
        print "  <p class=\"aviso\">La matriz de nombres recibida no es correcta.</p>\n";
        print "\n";
    }
}

// Comprobación de $b (botones radio)

// Si se han recibido demasiados botones
if ($botonesRecibidos > $_SESSION["numero"]) {
    print "  <p class=\"aviso\">La matriz de hombre/mujer recibida es demasiado grande.</p>\n";
    print "\n";
} else {
    $bOk = true;
    foreach ($b as $indice => $valor) {
        // Si el índice no es numérico (como es de tipo int hay que convertirlo a string antes)
        if (!ctype_digit((string)$indice)
            // o si el índice está fuera de rango
            || $indice < 1 || $indice > $_SESSION["numero"]
            // o si el valor no es "m" o "h"
           || ($valor != "h" && $valor != "m")) {
            $bOk = false;
        }
    }
    if (!$bOk) {
        print "  <p class=\"aviso\">La matriz de hombre/mujer recibida no es correcta.</p>\n";
        print "\n";
    }
}

// Si las cajas de texto y los botones radio recibidos con correctos ...
if ($cOk && $bOk) {
    // Se cuentan los datos completos y el número de hombres y mujeres
    $datosCompletos = 0;
    $datosHombres = 0;
    $datosMujeres = 0;

    // Bucle para recorrer la matriz $b (botones radio)
    foreach ($b as $indice => $valor) {
        // Si además hay una palabra en la caja de texto
        if ($c[$indice] != "") {
            $datosCompletos++;
            if ($valor == "h") {
                $datosHombres++;
            } elseif ($valor == "m") {
                $datosMujeres++;
            }
        }
    }

    if ($datosCompletos == 0) {
        print "  <p>No se ha recibido ningún dato completo</p>\n";
        print "\n";
    } else {
        print "  <p>Se han recibido <strong>$datosCompletos</strong> dato(s) completo(s)";
        print " de un total de <strong>$_SESSION[numero]</strong>.</p>\n";
        print "\n";

        print "  <ul>\n";
        print "    <li><strong>$datosHombres</strong> hombre(s): ";
        // Bucle para escribir los datos de los hombres
        foreach ($b as $indice => $valor) {
            if ($valor == "h" && $c[$indice] != "") {
                print "<strong>$c[$indice]</strong>, ";
            }
        }
        print "</li>\n";
        print "    <li><strong>$datosMujeres</strong> mujer(es): ";
        // Bucle para escribir los datos de las mujeres
        foreach ($b as $indice => $valor) {
            if ($valor == "m" && $c[$indice] != "") {
                print "<strong>$c[$indice]</strong>, ";
            }
        }
        print "</li>\n";
        print "  </ul>\n";
        print "\n";
    }
}
?>
  <p><a href="matrices-2-4-1.php">Volver al formulario.</a></p>

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
