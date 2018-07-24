<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Calculadora de divisiones (Formulario). if ... elseif ... else ...
    Escribe tu nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
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
    <p>Escribe tu nombre</p>
  </footer>
</body>
</html>
