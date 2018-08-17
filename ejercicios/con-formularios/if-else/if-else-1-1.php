<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Calculadora de divisiones (Formulario). if ... elseif ... else ...
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-soluciones.css" title="Color" />
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
          <td><strong>Dividendo:</strong></td>
          <td><input type="number" name="dividendo" min="0" max="1000" step="any" /></td>
        </tr>
        <tr>
          <td><strong>Divisor:</strong></td>
          <td><input type="number" name="divisor" min="0" max="1000" step="any" /></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Calcular" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-04">4 de noviembre de 2016</time>
    </p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>
