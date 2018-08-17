<?php
/**
 * Controles en formularios (2) 3-2 - controles-formularios-2-03-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-11-03
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
  <title>Datos personales 3 (Resultado). Controles en formularios (2).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-soluciones.css" title="Color" />
</head>

<body>
  <h1>Datos personales 3 (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$sexo       = recoge("genero"); // El control no se llama sexo para evitar el proxy de Conselleria
$cine       = recoge("cine");
$literatura = recoge("literatura");
$musica     = recoge("musica");

$sexoOk       = false;
$cineOk       = false;
$literaturaOk = false;
$musicaOk     = false;

if ($sexo == "") {
    print "  <p class=\"aviso\">No ha indicado su sexo.</p>\n";
    print "\n";
} elseif ($sexo != "hombre" && $sexo != "mujer") {
    print "  <p class=\"aviso\">Por favor, utilice el formulario.</p>\n";
    print "\n";
} else {
    $sexoOk = true;
}

if ($cine != "" && $cine != "on") {
    print "  <p class=\"aviso\">Por favor, utilice el formulario.</p>\n";
    print "\n";
} else {
    $cineOk = true;
}

if ($literatura != "" && $literatura != "on") {
    print "  <p class=\"aviso\">Por favor, utilice el formulario.</p>\n";
    print "\n";
} else {
    $literaturaOk = true;
}

if ($musica != "" && $musica != "on") {
    print "  <p class=\"aviso\">Por favor, utilice el formulario.</p>\n";
    print "\n";
} else {
    $musicaOk = true;
}

if ($sexoOk && $cineOk && $literaturaOk && $musicaOk) {
    if ($sexo == "hombre") {
        print "  <p>Es un <strong>hombre</strong>.</p>\n";
    } else {
        print "  <p>Es una <strong>mujer</strong>.</p>\n";
    }
    print "\n";

    if ($cine == "on") {
        print "  <p>Le gusta <strong>el cine</strong>.</p>\n";
    }
    print "\n";

    if ($literatura == "on") {
        print "  <p>Le gusta <strong>la literatura</strong>.</p>\n";
    }
    print "\n";

    if ($musica == "on") {
        print "  <p>Le gusta <strong>la música</strong>.</p>\n";
    }
    print "\n";

    if ($cine != "on" && $literatura != "on" && $musica != "on") {
        print "  <p>No ha marcado ninguna afición.</p>\n";
    }
    print "\n";
}
?>
  <p><a href="controles-formularios-2-03-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-03">3 de noviembre de 2016</time>
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
