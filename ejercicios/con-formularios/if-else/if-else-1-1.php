<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Calculadora de divisiones (Formulario).
    if ... elseif ... else ... Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Calculadora de divisiones (Formulario)</h1>

  <form action="if-else-1-2.php" method="get">
    <p>Escriba el dividendo y el divisor (0 &le; dividendo &lt; 1.000; 0 &lt; divisor &lt; 1.000)
      para calcular el cociente y el resto de la división.
    </p>

    <table>
      <tbody>
        <tr>
          <td><label for="dividendo">Dividendo:</label></td>
          <td><input type="number" name="dividendo" min="0" max="1000" step="any" id="dividendo"></td>
        </tr>
        <tr>
          <td><label for="divisor">Divisor:</label></td>
          <td><input type="number" name="divisor" min="0" max="1000" step="any" id="divisor"></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Calcular">
      <input type="reset" value="Borrar">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-10-24">24 de octubre de 2019</time>
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
