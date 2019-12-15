<?php
/**
 * Palabras repetidas (Formulario) - matrices-2-2-1.php
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
session_name("cs-matrices-2-2");
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Palabras repetidas (Formulario).
    Matrices (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Palabras repetidas (Formulario)</h1>

  <p>Escriba una palabra en cada caja de texto y le diré si ha repetido alguna.</p>

  <form action="matrices-2-2-2.php" method="get">
    <table>
      <tbody>
<?php
// Genera el número de cajas de texto a mostrar
$numero = rand(1, 10);

// Guarda en la sesión el número de cajas de texto
$_SESSION["numero"] = $numero;

// Bucle para generar las cajas de texto
for ($i = 1; $i <= $numero; $i++) {
    print "        <tr>\n";
    print "          <td>$i</td>\n";
    // El nombre del control es una matriz (c[])
    print "          <td><input type=\"text\" name=\"c[$i]\" size=\"30\"></td>\n";
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
