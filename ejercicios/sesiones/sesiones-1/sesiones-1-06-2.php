<?php
/**
 * Sesiones (1) 04 - sesiones-1-04-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-07
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
session_name("sesiones-1-03");
session_start();

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

// Recogida de palabra
$palabra   = recoge("palabra");
$palabraOk = false;

unset($_SESSION["error"]);

// print $palabra; exit;
// Comprobación de palabra
if ($palabra == "") {
    // Si no se recibe palabra, se vuelve al formulario
    $_SESSION["error"] = "No ha escrito ninguna palabra";
    header("Location:sesiones-1-04-1.php");
    exit;
} elseif (!ctype_upper($palabra)) {
    // Si la palabra no está en mayúsculas, se vuelve al formulario
    $_SESSION["error"] = "No ha escrito la palabra en mayúsculas";
    header("Location:sesiones-1-04-1.php");
    exit;
} else {
    $palabraOk = true;
}

// Si la palabra es correcta ...
if ($palabraOk) {
    // se queda en la página
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Formulario Nombre 1 (Resultado).
    Sesiones (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Formulario Nombre 1 (Resultado)</h1>
  <p><a href="sesiones-1-01-1.php">Volver a la primera página.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-11-07">7 de noviembre de 2018</time>
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
