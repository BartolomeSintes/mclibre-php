<?php
/**
 * Palabras repetidas (Resultado) - foreach-1-12-2.php
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
// Se accede a la sesión
session_name("cs-foreach-1-12");
session_start();

// Si el número de cajas de texto no está guardado en la sesión, vuelve al formulario
if (!isset($_SESSION["numero"])) {
    header("Location: foreach-1-12-1.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Palabras repetidas (Resultado). foreach (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Palabras repetidas (Resultado)</h1>

<?php
// Funciones auxiliares
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

// Recogida de datos
$c            = recogeMatriz("c");
$cOk          = false;

// Se cuenta el número de elementos en la matriz $c
$cajasRecibidas = count($c);

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
        print "  <p class=\"aviso\">La matriz recibida no es correcta.</p>\n";
        print "\n";
    }
}

// Si las cajas de texto recibidas con correctas ...
if ($cOk) {
    // Bucle para contar las cajas que no son vacías
    $cajasRellenas = 0;
    foreach ($c as $indice => $valor) {
        if ($c[$indice] != "") {
            $cajasRellenas++;
        }
    }
    print "  <p>Ha rellenado <strong>$cajasRellenas</strong> caja";
    if ($cajasRellenas != 1) {
        print "s";
    }
    print " de un total de <strong>$_SESSION[numero]</strong>.</p>\n";
    print "\n";

    if ($cajasRellenas > 1) {
        // Bucle anidado para comprobar si hay repeticiones
        $repeticion = false;
        // Toma los valores de las cajas ...
        foreach ($c as $indice1 => $valor1) {
            // ... y los compara con todos los valores de las cajas
            foreach ($c as $indice2 => $valor2) {
                // Si los valores son iguales (pero distintos de la cadena vacía) hay repeticiones
                if ($valor1 == $valor2 && $valor1 != ""
                // pero como compara todos con todos también comparará cada elemento consigo mismo
                // así que hay que comprobar que los índices sean distintos
                    && $indice1 != $indice2) {
                    $repeticion = true;
                }
            }
        }
        if ($repeticion) {
            print "  <p>El texto de alguna caja está repetido.</p>\n";
            print "\n";
        } else {
            print "  <p>El texto de cada caja es diferente.</p>\n";
            print "\n";
        }
    }
}
?>

  <p><a href="foreach-1-12-1.php">Volver al formulario.</a></p>

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
