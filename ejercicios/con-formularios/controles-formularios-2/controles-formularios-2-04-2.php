<?php
/**
 * Controles en formularios (2) 4-2 - controles-formularios-2-04-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-02-08
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Datos personales 4 (Resultado).
    Controles en formularios (2). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Datos personales 4 (Resultado)</h1>

<?php
// Función de recogida de datos
function recoge($key, $type = "")
{
    if (!is_string($key) && !is_int($key) || $key == "") {
        trigger_error("Function recoge(): Argument #1 (\$key) must be a non-empty string or an integer", E_USER_ERROR);
    } elseif ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): Argument #2 (\$type) is optional, but if provided, it must be an empty array or an empty string", E_USER_ERROR);
    }
    $tmp = $type;
    if (isset($_REQUEST[$key])) {
        if (!is_array($_REQUEST[$key]) && !is_array($type)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$key]));
        } elseif (is_array($_REQUEST[$key]) && is_array($type)) {
            $tmp = $_REQUEST[$key];
            array_walk_recursive($tmp, function (&$value) {
                $value = trim(htmlspecialchars($value));
            });
        }
    }
    return $tmp;
}

$correo  = recoge("correo");
$correo2 = recoge("correo2");
$recibir = recoge("recibir");

$correoOk  = false;
$correo2Ok = false;
$recibirOk = false;

if ($correo == "") {
    print "  <p class=\"aviso\">No ha escrito la primera dirección de correo.</p>\n";
    print "\n";
} elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    print "  <p class=\"aviso\">La primera dirección de correo no es correcta.</p>\n";
    print "\n";
} else {
    $correoOk = true;
}

if ($correo2 != $correo) {
    print "  <p class=\"aviso\">Las direcciones de correo no coinciden.</p>\n";
    print "\n";
} else {
    $correo2Ok = true;
}

if ($recibir == "-1") {
    print "  <p class=\"aviso\">No ha indicado si desea recibir correo.</p>\n";
    print "\n";
} elseif ($recibir != "0" && $recibir != "1") {
    print "  <p class=\"aviso\">Por favor, indique si quiere recibir o no correo.</p>\n";
    print "\n";
} else {
    $recibirOk = true;
}

if ($correoOk && $correo2Ok && $recibirOk) {
    print "  <p>Su dirección de correo es <strong>$correo</strong>.</p>\n";
    print "\n";
    if ($recibir == "0") {
        print "  <p><strong>No</strong> recibirá correos nuestros.</p>\n";
        print "\n";
    } else {
        print "  <p><strong>Sí</strong> recibirá correos nuestros.</p>\n";
        print "\n";
    }
}
?>
  <p><a href="controles-formularios-2-04-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-02-08">8 de febrero de 2025</time>
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
