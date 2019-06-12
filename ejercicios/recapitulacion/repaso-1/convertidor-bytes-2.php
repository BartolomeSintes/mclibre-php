<?php
/**
 * Convertidor de bytes - convertidor-bytes-2-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2015 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2015-11-18
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
  <title>Convertidor de bytes (Resultado). Repaso (1).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Convertidor de bytes (Resultado)</h1>

<?php
// Funciones auxiliares
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

// Recogida de datos
$bytes   = recoge("bytes");
$bytesOk = false;

$maximo  = 1999999999;

// Comprobación de $bytes
if ($bytes == "") {
    print "  <p class=\"aviso\">No ha escrito los bytes.</p>\n";
    print "\n";
} elseif (!is_numeric($bytes)) {
    print "  <p class=\"aviso\">No ha escrito los bytes como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($bytes)) {
    print "  <p class=\"aviso\">No ha escrito los bytes como número entero positivo (sin parte decimal)</p>\n";
    print "\n";
} elseif ($bytes > $maximo) {
    print "  <p class=\"aviso\">Los bytes deben ser inferiores a "
        . number_format($maximo, 0, ",", ".") . ".</p>\n";
    print "\n";
    // Es mejor no mostrar $maximo porque si es superior a PHP_INT_MAX se muestra como float
} else {
    $bytesOk = true;
}

// Si el valor recibido es correcto ...
if ($bytesOk) {
    $bytesOriginal = $bytes;

    if ($bytes >= 1024 * 1024 * 1024) {
        $gb = floor($bytes / (1024 * 1024 * 1024));
        $bytes = $bytes % (1024 * 1024 * 1024);
    }

    if ($bytes >= 1024 * 1024) {
        $mb = floor($bytes / (1024 * 1024));
        $bytes = $bytes % (1024 * 1024);
    }

    if ($bytes >= 1024) {
        $kb = floor($bytes / 1024);
        $bytes = $bytes % 1024;
    }

    print "  <p>" . number_format($bytesOriginal, 0, ",", ".") . " bytes son ";

    if ($bytesOriginal == 0) {
        print "0 bytes.";
    }

    if (isset($gb)) {
        print number_format($gb, 0, ",", ".") . " GB";
        if ((isset($mb) && isset($kb)) || (isset($mb) && $bytes != 0) ||
            (isset($kb) && $bytes != 0)) {
            print ", ";
        } elseif (isset($mb) || isset($kb) || $bytes != 0) {
            print " y ";
        }
    }

    if (isset($mb)) {
        print number_format($mb, 0, ",", ".") . " MB";
        if (isset($kb) && $bytes != 0) {
            print ", ";
        } elseif (isset($kb) || $bytes != 0) {
            print " y ";
        }
    }

    if (isset($kb)) {
        print number_format($kb, 0, ",", ".") . " KB";
        if ($bytes != 0) {
            print " y ";
        }
    }

    if ($bytes == 1) {
        print "1 byte";
    } elseif ($bytes != 0) {
        print number_format($bytes, 0, ",", ".") . " bytes";
    }

    print ".</p>\n";
    print "\n";
}
?>
  <p><a href="convertidor-bytes-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2015-11-18">18 de noviembre de 2015</time>
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
