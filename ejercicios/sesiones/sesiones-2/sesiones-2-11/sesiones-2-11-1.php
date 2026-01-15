<?php
/**
 * Quita cartas - sesiones-2-11-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-02-08
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

// Accedemos a la sesión
session_name("sesiones-2-11");
session_start();

// Si falta una de las dos variables de sesión, reiniciamos los valores
if (!isset($_SESSION["cartas"], $_SESSION["mensaje"])) {
    $_SESSION["cartas"]  = rand(3, 10);
    $_SESSION["mensaje"] = "  <p>Quedan $_SESSION[cartas] cartas. Haga clic en el dibujo para eliminar una carta.</p>\n";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Quita cartas.
    Sesiones (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Quita cartas</h1>

<?php
// Escribimos el mensaje
print $_SESSION["mensaje"];
print "\n";
?>
  <form action="sesiones-2-11-2.php">
    <p>
      <button type="submit" name="quita" value="quita" style="background-color: #eee;">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
             width="210" height="250" viewBox="-10 -10 210 250">
          <defs>
            <pattern id="patron-1" x="0" y="0" width="10" height="10" patternUnits="userSpaceOnUse" >
              <rect x="0" y="0" width="10" height="10" fill="hwb(0 60% 0%)" />
              <line x1="0" y1="10" x2="10" y2="0" stroke="hwb(0 80% 0%)" stroke-width="1" />
              <line x1="0" y1="0" x2="10" y2="10" stroke="hwb(0 80% 0%)" stroke-width="1" />
            </pattern>
          </defs>
<?php
// Hacemos un bucle para dibujar el número de cartas guardado en la sesión
for ($i = 0; $i < $_SESSION["cartas"]; $i++) {
    $pos = 10 * $i;
    print "          <rect x=\"$pos\" y=\"$pos\" width=\"100\" height=\"140\" rx=\"5\" ry=\"5\" style=\"stroke: black; fill: url(#patron-1);\" />\n";
}
?>
        </svg>
      </button>
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-02-08">8 de febrero de 2025</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
