<?php
/**
 * Tabla con casillas de verificación (Resultado) - matrices-2-5-2.php
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
session_name("cs-matrices-2-5");
session_start();

// Si el tamaño de la tabla no está guardado en la sesión, vuelve al formulario
if (!isset($_SESSION["numero"])) {
    header("Location: matrices-2-5-1.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Tabla cuadrada con casillas de verificación (Resultado).
    Matrices (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Tabla cuadrada con casillas de verificación (Resultado)</h1>

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
$c      = recoge("c", []);
$cOk    = false;
$cValor = "on";

// Se cuenta el número de elementos en la matriz $c
$casillasMarcadas = count($c);

// Comprobación de $c (casillas de verificación)

// Si se han recibido demasiadas casillas
if ($casillasMarcadas > $_SESSION["numero"] * $_SESSION["numero"]) {
    print "  <p class=\"aviso\">La matriz recibida es demasiado grande.</p>\n";
    print "\n";
} else {
    // Bucle para comprobar si todos los índices y valores son correctos
    $cOk = true;
    foreach ($c as $indice => $valor) {
        // Si el índice es numérico (como es de tipo int hay que convertirlo a string
        if (!ctype_digit((string)$indice)
            // o si el índice está fuera de rango
            || $indice < 1 || $indice > $_SESSION["numero"] * $_SESSION["numero"]
        // o si el valor no es "on"
            || $valor != $cValor) {
            $cOk = false;
        }
    }
    if (!$cOk) {
        print "  <p class=\"aviso\">La matriz recibida no es correcta.</p>\n";
        print "\n";
    }
}

// Si las casillas recibidas con correctas ...
if ($cOk) {
    // Si no se ha recibido ninguna casilla
    if ($casillasMarcadas == 0) {
        print "  <p>No ha marcado ninguna casilla.</p>\n";
        print "\n";
    } else {
        print "  <p>Ha marcado <strong>$casillasMarcadas</strong> casilla";
        if ($casillasMarcadas > 1) {
            print "s";
        }
        print " de un total de <strong>" . ($_SESSION["numero"] * $_SESSION["numero"])
            . "</strong>: <strong>";
        // Bucle para escribir los índices de las casillas recibidas
        foreach ($c as $indice => $valor) {
            print "$indice ";
        }
        print "</strong></p>\n";
        print "\n";
    }
}
?>
  <p><a href="matrices-2-5-1.php">Volver al formulario.</a></p>

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
