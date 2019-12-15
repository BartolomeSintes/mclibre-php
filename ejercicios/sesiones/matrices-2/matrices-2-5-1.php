<?php
/**
 * Tabla con casillas de verificación (Formulario) - matrices-2-5-1.php
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Tabla cuadrada con casillas de verificación (Formulario).
    Matrices (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Tabla cuadrada con casillas de verificación (Formulario)</h1>

  <p>Marque las casillas de verificación que quiera y contaré cuántas ha marcado.</p>

  <form action="matrices-2-5-2.php" method="get">
    <table class="conborde">
      <tbody>
<?php
// Recogida de datos
$numero = rand(2, 20);

// Guarda en la sesión el número de casillas
$_SESSION["numero"] = $numero;

// Bucle anidado para generar la tabla cuadrada con casillas de verificación
// Creamos un contador para generar el índice de la casilla de verificación
$contador = 1;
for ($i = 0; $i < $numero; $i++) {
    print "        <tr>\n";
    for ($j = 1; $j <= $numero; $j++) {
        // El nombre del control es una matriz (c[])
        print "          <td><label><input type=\"checkbox\" name=\"c[$contador]\"> $contador</label></td>\n";
        $contador++;
    }
    print "        </tr>\n";
}
?>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Contar">
      <input type="reset" value="Borrar">
    </p>
  </form>

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
