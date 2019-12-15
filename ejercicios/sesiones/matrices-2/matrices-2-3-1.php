<?php
/**
 * Encuesta (Formulario) - matrices-2-3-1.php
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
session_name("cs-matrices-2-3");
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Encuesta (Formulario).
    Matrices (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Encuesta (Formulario)</h1>

<?php
// Genera el número de preguntas y respuestas a mostrar
$preguntas  = rand(1, 10);
$respuestas = rand(2, 10);

// Guarda en la sesión el número de preguntas y respuestas
$_SESSION["preguntas"]  = $preguntas;
$_SESSION["respuestas"] = $respuestas;

print "  <p>Valore de 1 a $respuestas cada uno de estos aspectos.</p>\n";
?>

  <form action="matrices-2-3-2.php" method="get">
    <table>
      <tbody>
<?php
// Primera fila
print "        <tr>\n";
print "          <th></th>\n";
// Bucle para generar la primera fila, las celdas sólo contienen números
for ($j = 1; $j <= $respuestas; $j++) {
    print "          <th>$j</th>\n";
}
print "        </tr>\n";

// Bucle para generar las siguientes filas
for ($i = 1; $i <= $preguntas; $i++) {
    print "        <tr>\n";
    // La primera celda contiene el número de pregunta
    print "          <th>Pregunta $i:</th>\n";
    // Bucle para generar las celdas con los botones radio
    for ($j = 1; $j <= $respuestas; $j++) {
        // El nombre del control es una matriz (e[])
        // En cada fila el name del control es el mismo (para que formen un botón radio)
        // pero el value va cambiando
        print "          <td><input type=\"radio\" name=\"b[$i]\" value=\"$j\"></td>\n";
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
