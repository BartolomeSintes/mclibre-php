<?php
/**
 * Repaso 2-3 Buscaminas - repaso-2-3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2010 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2010-05-18
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

ini_set("session.save_handler", "files");
session_start();

$cancelar = recoge('cancelar');
if ($cancelar==1) {
    session_destroy();
    header('Location:repaso-2-3.html');
    exit();
}

print "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Buscaminas (Juego). Repaso 2.
  Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css"
  title="Color" />
</head>

<body>
<h1>Buscaminas (Juego)</h1>
<?php

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? strip_tags(trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8")))
        : "";
    if (get_magic_quotes_gpc()) {
        $tmp = stripslashes($tmp);
    }
    return $tmp;
}

function dibujaTablero()
{
    print "<table>\n";
    for ($i=0; $i<=$tamanyoTablero+1; $i++) {
        print "  <tr>\n";
        for ($j=0; $j<=$tamanyoTablero+1; $j++) {
            print "    <td>";
            if
                .$_SERVER['PHP_SELF']."?cancelar=1\">Cancelar juego.</a></p>\n";
        }
    }
}

if (!isset($_SESSION['juego'])) {
    $tamanyoTablero       = recoge('tamanyoTablero');
    $tamanyoTableroMinimo = 5;
    $tamanyoTableroMaximo = 25;
    $tamanyoTableroOk     = false;

    $numeroMinas      = recoge('numeroMinas');
    $numeroMinasMinimo = 1;
    $numeroMinasMaximo = 25;
    $numeroMinasOk    = false;

    if ($tamanyoTablero=="") {
        print "<p class=\"aviso\">No ha escrito el tamaño del tablero.</p>\n";
    } elseif (!ctype_digit($tamanyoTablero)) {
        print "<p class=\"aviso\">No ha escrito el tamaño del tablero "
            ."como número entero positivo.</p>\n";
    } elseif ($tamanyoTablero<$tamanyoTableroMinimo || $tamanyoTablero>$tamanyoTableroMaximo) {
        print "<p class=\"aviso\">El tamaño del tablero debe estar entre "
            ."$tamanyoTableroMinimo y $tamanyoTableroMaximo.</p>\n";
    } else {
        $tamanyoTableroOk = true;
    }

    if ($numeroMinas=="") {
        print "<p class=\"aviso\">No ha escrito el tamaño del tablero.</p>\n";
    } elseif (!ctype_digit($numeroMinas)) {
        print "<p class=\"aviso\">No ha escrito el tamaño del tablero "
            ."como número entero positivo.</p>\n";
    } elseif ($numeroMinas<$numeroMinasMinimo || $numeroMinas>$numeroMinasMaximo) {
        print "<p class=\"aviso\">El tamaño del tablero debe estar entre "
            ."$numeroMinasMinimo y $numeroMinasMaximo.</p>\n";
    } else {
        $numeroMinasOk = true;
    }

    if ($tamanyoTableroOk && $numeroMinasOk) {
        $_SESSION['juego'] = true;
        for ($i=0; $i<=$tamanyoTablero+1; $i++) {
            for ($j=0; $j<=$tamanyoTablero+1; $j++) {
                $_SESSION['tablero'][$i][$j] = 0;
            }
        }
        for ($i=1; $i<=$numeroMinas; $i++) {
            do {
                $tmpX = rand(1, $tamanyoTablero);
                $tmpY = rand(1, $tamanyoTablero);
                print "hola - ";
            } while ($_SESSION['tablero'][$tmpX][$tmpY]!=0);
            $_SESSION['tablero'][$tmpX][$tmpY] = 1;
        }
        dibujaTablero();
        print "<p><a href=\"".$_SERVER['PHP_SELF']."?cancelar=1\">Cancelar juego.</a></p>\n";
    }
    print "<p><a href=\"repaso-2-3.html\">Volver al formulario.</a></p>\n";
} else {
    $coordenadas       = recoge('tamanyoTablero');
    $tamanyoTableroMinimo = 5;
    $tamanyoTableroMaximo = 25;
    $tamanyoTableroOk     = false;
    print "<p><a href=\"".$_SERVER['PHP_SELF']."?cancelar=1\">Cancelar juego.</a></p>\n";
}

?>

<address>
  Este programa forma parte del curso "Páginas web con PHP" disponible en <a
  href="http://www.mclibre.org/">http://www.mclibre.org</a><br />
  Autor: Bartolomé Sintes Marco<br />
  Última modificación de esta página: 18 de mayo de 2010
</address>
<p class="licencia">El programa PHP que genera esta página está bajo
<a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o
posterior</a>.</p>
</body>
</html>
