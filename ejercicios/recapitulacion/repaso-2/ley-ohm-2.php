<?php
/**
 * Ley de Ohm - ley-ohm-2.php
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
  <meta charset="utf-8" />
  <title>Ley de Ohm (Formulario). Repaso (2)
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Ley de Ohm (Resultado)</h1>

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
$tension       = recoge("tension");
$intensidad    = recoge("intensidad");
$resistencia   = recoge("resistencia");
$tensionOk     = false;
$intensidadOk  = false;
$resistenciaOk = false;

// Comprobación de que hay al menos dos datos
if (($tension == "" && $intensidad == "") || ($tension == "" && $resistencia == "")
   || ($intensidad == "" && $resistencia == "")) {
    print "  <p class=\"aviso\">Se necesitan al menos rellenar dos datos.</p>\n";
    print "\n";
} else {
// Comprobación de $tension
if ($tension == "") {
        $tensionOk = true;
    } elseif (!is_numeric($tension)) {
        print "  <p class=\"aviso\">No ha escrito la tensión como número.</p>\n";
        print "\n";
    } else {
        $tensionOk = true;
    }

// Comprobación de $intensidad
    if ($intensidad == "") {
        $intensidadOk = true;
    } elseif (!is_numeric($intensidad)) {
        print "  <p class=\"aviso\">No ha escrito la intensidad como número.</p>\n";
        print "\n";
    } else {
        $intensidadOk = true;
    }

// Comprobación de $resistencia
    if ($resistencia == "") {
        $resistenciaOk = true;
    } elseif (!is_numeric($resistencia)) {
        print "  <p class=\"aviso\">No ha escrito la resistencia como número.</p>\n";
        print "\n";
    } elseif ($resistencia<0) {
        print "  <p class=\"aviso\">La resistencia no puede ser negativa.</p>\n";
        print "\n";
    } else {
        $resistenciaOk = true;
    }
}

// Si los valores recibidos son correctos ...
if ($tensionOk && $intensidadOk && $resistenciaOk) {
    if ($tension != "" && $intensidad != "" && $resistencia != "") {
        if ($tension == $intensidad * $resistencia) {
            print "  <p>Los valores introducidos son correctos:</p>\n";
            print "\n";
        } else {
            print "  <p>Los valores introducidos <span class=\"aviso\">no</span> son posibles:</p>\n";
            print "\n";
        }
        print "  <ul>\n";
        print "    <li>Tensión: $tension V</li>\n";
        print "    <li>Intensidad: $intensidad A</li>\n";
        print "    <li>Resistencia: $resistencia &Omega;</li>\n";
        print "  </ul>\n";
        print "\n";
    } elseif ($tension * $intensidad < 0) {
        print "  <p class=\"aviso\">Tensión e intensidad no pueden tener signos distintos.</p>\n";
        print "\n";
    } elseif ($tension != "" && $intensidad != "" && $tension == 0 && $intensidad == 0) {
        print "  <p class=\"aviso\">Si la tensión y la intensidad son nulas, la resistencia puede tomar cualquier valor.</p>\n";
        print "\n";
    } elseif ($tension != "" && $resistencia != "" && $tension == 0 && $resistencia == 0) {
        print "  <p class=\"aviso\">Si la tensión y la resistencia son nulas, la intensidad puede tomar cualquier valor.</p>\n";
        print "\n";
    } elseif ($resistencia != "" && $tension != 0 && $resistencia == 0) {
        print "  <p class=\"aviso\">Si la resistencia es nula, la tensión no puede ser no nula.</p>\n";
        print "\n";
    } elseif ($intensidad != "" && $tension != 0 && $intensidad == 0) {
        print "  <p class=\"aviso\">Si la intensidad es nula, la tensión no puede ser no nula.</p>\n";
        print "\n";
    } else {
        print "  <p>Valores calculados:</p>\n";
        print "\n";
        if ($tension == "") {
            $tension = $resistencia * $intensidad;
        } elseif ($intensidad == "") {
            $intensidad = $tension / $resistencia;
        } else {
            $resistencia = $tension / $intensidad;
        }
        print "  <ul>\n";
        print "    <li>Tensión: $tension V</li>\n";
        print "    <li>Intensidad: $intensidad A</li>\n";
        print "    <li>Resistencia: $resistencia &Omega;</li>\n";
        print "  </ul>\n";
        print "\n";
    }
}
?>
  <p><a href="ley-ohm-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2015-11-18">18 de noviembre de 2015</time>
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
